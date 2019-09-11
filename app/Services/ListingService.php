<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services;

use App\Forms\Listing\CreateListingForm;
use App\Repository\Listing\ListingImageRepo;
use App\Repository\Listing\ListingRepo;
use App\Repository\Listing\ListingTypeRepo;
use Illuminate\Support\Facades\DB;

/**
 * Class ListingService
 * @package App\Services
 */
class ListingService {

    /**
     * @var ListingRepo
     */
    protected $repo;

    /**
     * BaseListingService constructor.
     *
     * @param $repo
     */
    public function __construct(ListingRepo $repo) {
        $this->repo = $repo;
    }

    /**
     * @param $request
     *
     * @return CreateListingForm
     */
    private function form($request) {
        $form = new CreateListingForm();
        $form->user_id = myId();
        $form->realty_id = $request->realty_id ?? null;
        $form->realty_url = $request->realty_url ?? null;
        $form->name = $request->name ?? null;
        $form->availability = $request->availability;
        $form->visibility = !isAdmin() ? 2 : 1;
        $form->email = $request->email ?? null;
        $form->description = $request->description ?? null;
        $form->phone_number = $request->phone_number ?? null;
        $form->street_address = $request->street_address ?? null;
        $form->display_address = $request->display_address ?? null;
        $form->open_house = $request->open_house ?? null;
        $form->city_state_zip = $request->city_state_zip ?? null;
        $form->neighborhood = $request->neighborhood ?? null;
        $form->bedrooms = $request->bedrooms ?? null;
        $form->baths = $request->baths ?? null;
        $form->unit = $request->unit ?? null;
        $form->rent = $request->rent ?? null;
        $form->square_feet = $request->square_feet ?? null;
        $form->listing_type = $request->listing_type ?? null;
        $form->amenities = $request->amenities ?? null;
        $form->unit_feature = $request->unit_feature ?? null;
        $form->building_feature = $request->building_feature ?? null;
        $form->pet_policy = $request->pet_policy ?? null;
        $form->status = $request->status ?? null;
        $form->map_location = $request->map_location ?? null;
        $form->old_thumbnail = !empty($request->hasFile('thumbnail')) ? false : $request->old_thumbnail;
        $form->thumbnail = empty($request->hasFile('thumbnail')) ? '' : $request->thumbnail ?? null;
		$form->validate();
        return $form;
    }

    /**
     * @param $data
     *
     * @return bool
     */
    private function createList($data) {
        DB::beginTransaction();
        if (!empty($data->thumbnail))
            $data->thumbnail = uploadImage($data->thumbnail, 'data/' . myId() . '/listing/thumbnails');
        $list = $this->repo->create($data->toArray());
        if (!empty($list)) {
            return $this->createType($list->id, $data);
        } else if(!empty($list) && $data->realty) {
            DB::commit();
        }

        DB::rollback();
        return false;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    private function createType($id, $data) {
        $batch = [];
        $this->repo = new ListingTypeRepo;
        foreach ($data as $key => $type) {
            if (is_array($data->{$key})) {
                $type = sprintf("%s", config("features.listing_types.{$key}"));
                foreach ($data->{$key} as $value) {
                    $batch[] = [
                        'listing_id'    => $id,
                        'property_type' => $type,
                        'value'         => $value,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];
                }
            }
        }
        if ($this->repo->insert($batch)) {
            DB::commit();
            return $id;
        }
        DB::rollback();
        return false;
    }

    /**
     * @param $id
     * @param $listing
     *
     * @return bool
     */
    private function updateList($id, $listing) {
        DB::beginTransaction();
        if (!empty($listing->thumbnail)) {
            $listing->thumbnail = uploadImage($listing->thumbnail, 'data/' . myId() . '/listing/thumbnails', true, $listing->old_thumbnail);
        } else {
            $listing->thumbnail = $listing->old_thumbnail;
        }

        $data = [
            'name'            => $listing->name,
            'email'           => $listing->email,
            'open_house'      => $listing->open_house,
            'visibility'      => $listing->visibility,
            'description'     => $listing->description,
            'map_location'    => $listing->map_location,
            'phone_number'    => $listing->phone_number,
            'street_address'  => $listing->street_address,
            'display_address' => $listing->display_address,
            'availability'    => $listing->availability,
            'city_state_zip'  => $listing->city_state_zip,
            'neighborhood'    => $listing->neighborhood,
            'bedrooms'        => $listing->bedrooms,
            'baths'           => $listing->baths,
            'unit'            => $listing->unit,
            'rent'            => $listing->rent,
            'thumbnail'       => $listing->thumbnail,
            'square_feet'     => $listing->square_feet,
        ];

        if ($update = $this->repo->update($id, $data)) {
            return $this->updateType($id, $listing);
        }

        DB::rollBack();
        return false;
    }

    /**
     * @param $id
     * @param $data
     *
     * @return bool
     */
    private function updateType($id, $data) {
        $this->repo = new ListingTypeRepo();
        $this->repo->deleteMultiple(['listing_id' => $id]);
        return $this->createType($id, $data);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    private function collection($paginate) {
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
    private function searchCollection($keywords, $paginate) {
        return [
            'pending'  => $this->repo->search($keywords)
                                     ->pending()
                                     ->latest()
                                     ->paginate($paginate, ['*'], 'pending'),
            'active'   => $this->repo->search($keywords)
                                     ->active()
                                     ->latest('updated_at')
                                     ->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->repo->search($keywords)
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
    private function sortCollection($paginate, $col, $order) {
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

    /**
     * @param $paginate
     *
     * @return array
     */
    public function petPolicy($paginate) {
        return [
            'active'   => $this->active()
                               ->policy()
                               ->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->inactive()
                               ->policy()
                               ->paginate($paginate, ['*'], 'inactive'),
            'pending'  => $this->pending()
                               ->policy()
                               ->paginate($paginate, ['*'], 'pending'),
        ];
    }

    /**
     * @param $request
     *
     * @return bool
     */
    public function create($request) {
        return $this->createList($this->form($request));
    }

    /**
     * @param $id
     * @param $request
     *
     * @return mixed
     */
    public function insertImages($id, $request) {
        $batch = [];
        $this->repo = new ListingImageRepo;
        $files = uploadMultiImages($request->file('file'), 'data/' . myId() . '/listing/images');
        foreach ($files as $file) {
            $batch[] = [
                'listing_id'    => $id,
                'listing_image' => $file,
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }
        return $this->repo->insert($batch);
    }

    /**
     * @param $id
     * @param $request
     *
     * @return bool
     */
    public function update($id, $request) {
        return $this->updateList( $id, $this->form( $request ) );
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function removeImage($id) {
        $this->repo = new ListingImageRepo;
        removeFile($this->repo->first($id));
        return $this->repo->delete($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function images($id) {
        $this->repo = new ListingImageRepo;
        return $this->repo->get($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function repost($id) {
        return $this->repo->update($id, ['updated_at' => now()]);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function visibility($id) {
        return $this->repo->status($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function edit($id) {
        return $this->repo->edit($id)->withtypes();
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
        return $this->searchCollection($keywords, $paginate);
    }

    /**
     * @return mixed
     */
    public function active() {
        return $this->repo->active();
    }

    /**
     * @return mixed
     */
    public function inactive() {
        return $this->repo->inactive();
    }

    /**
     * @return mixed
     */
    public function pending() {
        return $this->repo->pending();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function approve($id) {
        DB::beginTransaction();
        if ($this->repo->update($id, ['visibility' => 1])) {
            $list = $this->repo->find(['id' => $id])->withagent()->first();
            $data = [
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
            ];
            notificationService($data);
            DB::commit();
            return true;
        }
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function get($paginate) {
        return $this->collection($paginate);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function requestForFeatured($id) {
        return $this->repo->sendRequest($id);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function cheaper($paginate) {
        return $this->sortCollection($paginate, 'rent', CHEAPER);
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function recent($paginate) {
        return $this->sortCollection($paginate, 'updated_at', RECENT);
    }
}
