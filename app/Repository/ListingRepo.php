<?php

namespace App\Repository;

class ListingRepo {

	public $paginate;

	private $listing;

	private $listing_type;

	public function __construct(
		\App\Listing $listing,
		\App\ListingTypes $listing_type,
		\App\ListingImages $listing_images) {
		$this->listing = $listing;
		$this->listing_type = $listing_type;
		$this->listing_images = $listing_images;
	}

	public function create_listing($data) {
		return $this->listing->create($data);
	}

	public function create_listing_type($data) {
		return $this->listing_type->insert($data);
	}

	public function create_listing_images($data) {
		return $this->listing_images->insert($data);
	}

	public function get_active_listing() {
		return $this->listing
			->whereuser_id(auth()->id())
			->whereStatus(true)
			->latest('updated_at')
			->paginate($this->paginate, ['*'], 'active-listing');
	}

	public function get_inactive_listing() {
		return $this->listing
			->whereuser_id(auth()->id())
			->whereStatus(false)
			->latest('updated_at')
			->paginate($this->paginate, ['*'], 'inactive-listing');
	}

	public function get_pending_listing() {
		return $this->listing
			->whereuser_id(auth()->id())
			->whereStatus(2)
			->latest('updated_at')
			->paginate($this->paginate, ['*'], 'pending-listing');
	}

	public function update_listing($id, $data) {
		return $this->listing->whereId($id)->update($data);
	}

	public function update_listing_type($id, $data) {
		$this->listing_type->wherelisting_id($id)->delete();
		return $this->create_listing_type($data);
	}

	public function update_listing_images($id, $data) {
		return $this->listing_images->whereId($id)->update($data);
	}

	public function search_active_listing($keywords) {
		return $this->listing
			->whereuser_id(auth()->id())
			->whereStatus(true)
			->where($keywords)
			->latest('updated_at')
			->paginate($this->paginate, ['*'], 'active-searched-listing');
	}

	public function search_inactive_listing($keywords) {
		return $this->listing
			->whereuser_id(auth()->id())
			->whereStatus(false)
			->where($keywords)
			->latest('updated_at')
			->paginate($this->paginate, ['*'], 'inactive-searched-listing');
	}

	public function active_deactive_listing($id) {
		$query = $this->listing->whereId((int) $id);
		$status = $query->select('status')->first();
		$updateStatus = ($status->status) ? 0 : 1;
		$query->update(['status' => $updateStatus]);
		return $updateStatus;
	}

	public function edit_listing($id) {
		return $this->listing->with('listingTypes')->whereId($id)->first();
	}

	public function get_listing_images($id) {
		return $this->listing_images->wherelisting_id($id)->get();
	}

	public function get_single_image($id) {
		return $this->listing_images->whereId($id)->first();
	}

	public function delete_image($id) {
		return $this->listing_images->whereId($id)->delete();
	}
}