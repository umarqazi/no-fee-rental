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
        $form->realty = $request->realty ?? false;
        $form->name = $request->name;
        $form->email = $request->email;
        $form->description = $request->description;
        $form->phone_number = $request->phone_number;
        $form->url = $request->url;
        $form->street_address = $request->street_address;
        $form->display_address = $request->display_address;
        $form->available = $request->available;
        $form->city_state_zip = $request->city_state_zip;
        $form->neighborhood = $request->neighborhood;
        $form->bedrooms = $request->bedrooms;
        $form->baths = $request->baths;
        $form->unit = $request->unit;
        $form->rent = $request->rent;
        $form->square_feet = $request->square_feet;
        $form->listing_type = $request->listing_type ?? null;
        $form->amenities = $request->amenities ?? null;
        $form->unit_feature = $request->unit_feature ?? null;
        $form->building_feature = $request->building_feature ?? null;
        $form->pet_policy = $request->pet_policy ?? null;
        $form->status = $request->status;
        $form->map_location = $request->map_location;
        $form->old = ($request->thumbnail) ? $request->old_thumbnail ?? null : true;
        $form->thumbnail = ($request->thumbnail) ? $request->thumbnail ?? null : $request->old_thumbnail;
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
        if ($data->thumbnail && !$data->realty) {
            $data->thumbnail = uploadImage($data->thumbnail, 'data/' . myId() . '/listing/thumbnails');
        }
        $list = $this->repo->create($data->toArray());
        if (!empty($list) && !$data->realty) {
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
                        'listing_id' => $id,
                        'property_type' => $type,
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
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
        if ($listing->old != 'true') {
            $listing->thumbnail = uploadImage($listing->thumbnail, 'data/' . myId() . '/listing/thumbnails', true, $listing->old);
        }

        $data = [
            'name' => $listing->name,
            'email' => $listing->email,
            'description' => $listing->description,
            'phone_number' => $listing->phone_number,
            'website' => $listing->website,
            'street_address' => $listing->street_address,
            'display_address' => $listing->display_address,
            'available' => $listing->available,
            'city_state_zip' => $listing->city_state_zip,
            'neighborhood' => $listing->neighborhood,
            'bedrooms' => $listing->bedrooms,
            'baths' => $listing->baths,
            'unit' => $listing->unit,
            'rent' => $listing->rent,
            'thumbnail' => $listing->thumbnail,
            'square_feet' => $listing->square_feet,
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
     * @param $listing
     * @param $paginate
     *
     * @return array
     */
    private function collection($listing, $paginate) {
        return [
            'active' => $listing->active()->latest('updated_at')->paginate($paginate, ['*'], 'active'),
            'pending' => $listing->pending()->latest()->paginate($paginate, ['*'], 'pending'),
            'inactive' => $listing->inactive()->latest()->paginate($paginate, ['*'], 'inactive'),
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
            'pending' => $this->repo->search($keywords)->pending()->latest()->paginate($paginate, ['*'], 'pending'),
            'active' => $this->repo->search($keywords)->active()->latest('updated_at')->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->repo->search($keywords)->inactive()->latest()->paginate($paginate, ['*'], 'inactive'),
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
            'active' => $this->active()->orderBy($col, $order)->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->inactive()->orderBy($col, $order)->paginate($paginate, ['*'], 'inactive'),
            'pending' => $this->pending()->orderBy($col, $order)->paginate($paginate, ['*'], 'pending')
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
                'listing_id' => $id,
                'listing_image' => $file,
                'created_at' => now(),
                'updated_at' => now(),
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
        if ($this->repo->update($id, ['status' => 1])) {
            $list = $this->repo->find(['id' => $id])->withagent()->first();
            $data = [
                'name' => $list->agent->first_name,
                'approved_by' => mySelf()->first_name,
                'approved_on' => $list->updated_at,
                'view' => 'approve-request',
                'subject' => 'Request Approved for listing',
            ];
            mailService($list->agent->email, toObject($data));
            return true;
        }
    }

    /**
     * @param $paginate
     *
     * @return array
     */
    public function get($paginate) {
        return $this->collection($this->repo, $paginate);
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

    /**
     * @param $paginate
     *
     * @return array
     */
    public function petPolicy($paginate) {
        return [
            'active' => $this->repo->active()->policy()->paginate($paginate, ['*'], 'active'),
            'inactive' => $this->repo->inactive()->policy()->paginate($paginate, ['*'], 'inactive'),
            'pending' => $this->repo->pending()->policy()->paginate($paginate, ['*'], 'pending'),
        ];
    }
}
