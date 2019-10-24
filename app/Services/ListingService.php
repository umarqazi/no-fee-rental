<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\ListingForm;
use App\Repository\FeatureRepo;
use App\Repository\OpenHouseRepo;
use Illuminate\Support\Facades\DB;
use App\Repository\ListingImagesRepo;

/**
 * Class ListingService
 * @package App\Services
 */
class ListingService extends BuildingService {

    /**
     * @var ListingImagesRepo
     */
    protected $listingImagesRepo;

    /**
     * @var OpenHouseRepo
     */
    protected $openHouseRepo;

    /**
     * @var FeatureRepo
     */
    protected $featureRepo;

    /**
     * ListingService constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->featureRepo       = new FeatureRepo();
        $this->openHouseRepo     = new OpenHouseRepo();
        $this->listingImagesRepo = new ListingImagesRepo();
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create($request) {
        DB::beginTransaction();
        $listing = $this->__validateForm($request);
        $building = $this->addBuilding($listing->street_address);
        $listing->visibility = (!$building->is_verified && isAgent()) ? PENDINGLISTING : $building->is_verified;
        $listing = $this->__addList($listing);
        $this->__addOpenHouse($listing->id, $listing->user_id, $request->open_house);
        $this->__addFeatures($listing->id, $request->features);
        parent::attachApartment($building, $listing);
        DB::commit();
        return $listing->id;
    }

    /**
     * @param $address
     *
     * @return bool|mixed
     */
    public function addBuilding($address) {
        return parent::manageBuilding($address);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function insertImages($id, $request) {
        $batch = [];
        $files = uploadMultiImages($request->file('file'), 'images/listing/images');
        foreach ($files as $file) {
            $batch[] = [
                'listing_id'    => $id,
                'listing_image' => $file,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        return $this->listingImagesRepo->insert($batch);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return bool
     */
    public function update($id, $request) {
        DB::beginTransaction();
        if($this->__updateList( $id, $this->__validateForm( $request ) )) {
            $this->__updateOpenHouses($id, $request->user_id, $request->open_house);
            $this->__updateFeatures($id, $request->features);
            DB::commit();
            return true;
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function removeImage($id) {
        removeFile($this->listingImagesRepo->first($id));
        return $this->listingImagesRepo->delete($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function images($id) {
        return $this->listingImagesRepo->images($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function repost($id) {
        return $this->listingRepo->update($id, ['updated_at' => now()]);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return int
     */
    public function visibility($id, $request) {
        return $this->listingRepo->status($id, $request);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id) {
        return $this->listingRepo->edit($id)->withall();
    }

    /**
     * @param $request
     * @param $paginate
     *
     * @return array
     */
    public function search($request, $paginate) {
        $keywords = [];
        !empty($request->baths) ? $keywords['baths'] = $request->baths : null;
        !empty($request->beds) ? $keywords['bedrooms'] = $request->beds : null;
        return toObject($this->__searchCollection($keywords, $paginate));
    }

    /**
     * @return mixed
     */
    public function active() {
        return $this->listingRepo->active();
    }

    /**
     * @return mixed
     */
    public function inactive() {
        return $this->listingRepo->inactive();
    }

    /**
     * @return mixed
     */
    public function pending() {
        return $this->listingRepo->pending();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function approve($id) {
        DB::beginTransaction();
        if ($this->listingRepo->update($id, ['visibility' => 1])) {
            $list = $this->listingRepo->find(['id' => $id])->withagent()->first();
            dispatchNotification([
                'name'        => $list->agent->first_name,
                'approved_by' => mySelf()->first_name,
                'approved_on' => $list->updated_at,
                'view'        => 'approve-request',
                'subject'     => 'Request Approved for listing',
                'path'        => route('listing.detail', $list->id),
                'from'        => myId(),
                'toEmail'     => $list->agent->email,
                'fromEmail'   => mySelf()->email,
                'to'          => $list->agent->id,
                'notification'=> 'Listing has been approved',
            ]);
            DB::commit();
            return true;
        }

        return false;
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function get($paginate) {
        return toObject($this->__collection($paginate));
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function requestForFeatured($id) {
        return $this->listingRepo->sendRequest($id);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper($paginate) {
        return $this->__sortCollection($paginate, 'rent', CHEAPEST);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent($paginate) {
        return $this->__sortCollection($paginate, 'updated_at', RECENT);
    }

    /**
     * @param $request
     *
     * @return ListingForm
     */
    protected function __validateForm($request) {
        $form                  = new ListingForm();
        $form->user_id         = $request->user_id ?? myId();
        $form->unique_slug     = str_random(20);
        $form->name            = $request->name;
        $form->email           = $request->email;
        $form->phone_number    = $request->phone_number;
        $form->street_address  = $request->street_address;
        $form->display_address = $request->display_address;
        $form->availability    = $request->availability_date ?? $request->availability;
        $form->visibility      = $request->visibility;
        $form->description     = $request->description;
        $form->neighborhood    = $request->neighborhood_id;
        $form->bedrooms        = $request->bedrooms;
        $form->baths           = $request->baths;
        $form->unit            = $request->unit;
        $form->rent            = $request->rent;
        $form->square_feet     = $request->square_feet;
        $form->map_location    = $request->map_location;
        $form->building_type   = $request->building_type;
        $form->thumbnail       = $request->thumbnail ?? '';
        $form->old_thumbnail   = $request->old_thumbnail ?? null;
        $form->application_fee = $request->application_fee;
        $form->deposit         = $request->deposit;
        $form->validate();
        return $form;
    }

    /**
     * @param $form
     *
     * @return mixed
     */
    protected function __addList($form) {
        if (!empty($form->thumbnail) && strpos($form->thumbnail, 'http') === false) {
            $form->thumbnail = uploadImage( $form->thumbnail, 'images/listing/thumbnails' );
        }

        return $this->listingRepo->create($form->toArray());
    }

    /**
     * @param $id
     * @param $user_id
     * @param $data
     *
     * @return mixed
     */
    protected function __addOpenHouse($id, $user_id, $data) {
        $batch = [];
        if(is_array($data['date'][0])) {
            for ($i = 0; $i < sizeof($data['date']); $i++) {
                $batch[] = [
                    'listing_id' => $id,
                    'date' => $data['date'][$i],
                    'start_time' => $data['start_time'][$i],
                    'end_time' => $data['end_time'][$i],
                    'only_appt' => isset($data['by_appointment']) && $data['by_appointment'][$i] !== 'on' ?: true ?? false,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                addCalendarEvent([
                    'color'   => 'yellow',
                    'title'   => 'Open House (Pending)',
                    'user_id' => $user_id,
                    'url'     => route('listing.detail', $id),
                    'start'   => $data['date'][$i].' '.openHouseTimeSlot($data['start_time'][$i])->format('H:i:s'),
                    'end'     => $data['date'][$i].' '.openHouseTimeSlot($data['end_time'][$i])->format('H:i:s'),
                ]);
            }
        }
        $this->openHouseRepo->insert($batch);
        return $id;
    }

    /**
     * @param $id
     * @param $features
     *
     * @return mixed
     */
    protected function __addFeatures($id, $features) {
        $batch = [];
        if(!empty($features) && count($features) > 0) {
            foreach ( $features as $feature ) {
                $batch[] = [
                    'listing_id' => $id,
                    'value'      => $feature,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }
        return $this->featureRepo->insert($batch);
    }

    /**
     * @param $id
     * @param $listing
     *
     * @return bool
     */
    protected function __updateList($id, $listing) {
        if (!empty($listing->thumbnail)) {
            $listing->thumbnail = uploadImage(
                $listing->thumbnail,
                'images/listing/thumbnails',
                true,
                $listing->old_thumbnail);
        } else {
            $listing->thumbnail = $listing->old_thumbnail;
        }

        return $this->listingRepo->update($id, $listing->toArray());
    }

    /**
     * @param $id
     * @param $user_id
     * @param $data
     *
     * @return mixed
     */
    protected function __updateOpenHouses($id, $user_id, $data) {
        $this->openHouseRepo->deleteMultiple(['listing_id' => $id]);
        return $this->__addOpenHouse($id, $user_id, $data);
    }

    /**
     * @param $id
     * @param $data
     *
     * @return mixed
     */
    protected function __updateFeatures($id, $data) {
        $this->featureRepo->deleteMultiple(['listing_id' => $id]);
        return $this->__addFeatures($id, $data);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    protected function __collection($paginate) {
        return [
            'active'   => $this->active()
                               ->latest('updated_at')
                               ->paginate($paginate, ['*'], 'active'),
            'pending'  => $this->pending()
                               ->latest()
                               ->paginate($paginate, ['*'], 'pending'),
            'inactive' => $this->inactive()
                               ->latest()
                               ->paginate($paginate, ['*'], 'inactive'),
        ];
    }

    /**
     * @param $keywords
     * @param $paginate
     *
     * @return array
     */
    protected function __searchCollection($keywords, $paginate) {
        return [
            'pending'  => $this->listingRepo->search($keywords)
                                            ->pending()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'pending'),
            'active'   => $this->listingRepo->search($keywords)
                                            ->active()
                                            ->latest('updated_at')
                                            ->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->listingRepo->search($keywords)
                                            ->inactive()
                                            ->latest()
                                            ->paginate($paginate, ['*'], 'inactive'),
        ];
    }

    /**
     * @param $paginate
     * @param $col
     * @param $order
     *
     * @return array
     */
    protected function __sortCollection($paginate, $col, $order) {
        return [
            'active'   => $this->active()
                               ->orderBy($col, $order)
                               ->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->inactive()
                               ->orderBy($col, $order)
                               ->paginate($paginate, ['*'], 'inactive'),
            'pending'  => $this->pending()
                               ->orderBy($col, $order)
                               ->paginate($paginate, ['*'], 'pending')
        ];
    }
}
