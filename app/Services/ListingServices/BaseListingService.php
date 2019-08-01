<?php
/**
 * @author yousaf
 * @package
 * @copyright 2019 Techverx.com
 * @project no-fee-rental
 */

namespace App\Services\ListingServices;

use App\Forms\Listing\CreateListingForm;
use App\Repository\Listing\ListingImageRepo;
use App\Repository\Listing\ListingTypeRepo;
use Illuminate\Support\Facades\DB;

class BaseListingService {

	/**
	 * @var Repo Instance
	 */
	protected $repo;

	/**
	 * BaseListingService constructor.
	 *
	 * @param $repo
	 */
	public function __construct($repo) {
		$this->repo = $repo;
	}

	/**
	 * @param $request
	 *
	 * @return CreateListingForm
	 */
	private function buildForm($request) {
		$form = new CreateListingForm();
		$form->user_id = myId();
		$form->name = $request->name;
		$form->email = $request->email;
		$form->description = $request->description;
		$form->phone_number = $request->phone_number;
		$form->website = $request->website;
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
		$form->listing_type = $request->listing_type;
		$form->amenities = $request->amenities;
		$form->unit_feature = $request->unit_feature;
		$form->building_feature = $request->building_feature;
		$form->pet_policy = $request->pet_policy;
		$form->status = $request->status;
		$form->map_location = $request->map_location;
		$form->old = ($request->hasFile('thumbnail')) ? $request->old_thumbnail : true;
		$form->thumbnail = ($request->hasFile('thumbnail')) ? $request->file('thumbnail') : $request->old_thumbnail;
		$form->validate();
		return $form;
	}

	/**
	 * @param $request
	 *
	 * @return bool
	 */
	public function create($request) {
		return $this->createList($this->buildForm($request));
	}

	/**
	 * @param $data
	 *
	 * @return bool
	 */
	private function createList($data) {
		DB::beginTransaction();
		if ($data->thumbnail) {
			$data->thumbnail = uploadImage($data->thumbnail, 'data/' . myId() . '/listing/thumbnails');
		}

		if (!empty($list = $this->repo->create($data->toArray()))) {
			return $this->createType($list->id, $data);
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
				$type = sprintf("%s", config("constants.listing_types.{$key}"));
				foreach ($data->{$key} as $key => $value) {
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
	 * @param $files
	 *
	 * @return mixed
	 */
	public function insertImages($id, $files) {
		$batch = [];
		$this->repo = new ListingImageRepo;
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
		return $this->updateList($id, $this->buildForm($request));
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
	public function active_deactive($id) {
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
		return $this->searchedCollection($keywords, $paginate);
	}

	/**
	 * @param $listing
	 * @param $paginate
	 *
	 * @return array
	 */
	public function collection($listing, $paginate) {
		return [
			'active' => $listing->active()->paginate($paginate, ['*'], 'active'),
			'pending' => $listing->pending()->paginate($paginate, ['*'], 'pending'),
			'inactive' => $listing->inactive()->paginate($paginate, ['*'], 'inactive'),
			'totalActive' => $listing->active()->count(),
			'totalPending' => $listing->pending()->count(),
			'totalInactive' => $listing->inactive()->count(),
		];
	}

	/**
	 * @param $keywords
	 * @param $paginate
	 *
	 * @return array
	 */
	public function searchedCollection($keywords, $paginate) {
		return [
			'totalActive' => $this->repo->search($keywords)->active()->count(),
			'totalPending' => $this->repo->search($keywords)->pending()->count(),
			'totalInactive' => $this->repo->search($keywords)->inactive()->count(),
			'pending' => $this->repo->search($keywords)->pending()->paginate($paginate, ['*'], 'pending'),
			'active' => $this->repo->search($keywords)->active()->paginate($paginate, ['*'], 'active'),
			'inactive' => $this->repo->search($keywords)->inactive()->paginate($paginate, ['*'], 'inactive'),
		];
	}
	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public function status($id) {
		return $this->repo->status($id);
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
}