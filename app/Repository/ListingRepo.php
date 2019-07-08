<?php

namespace App\Repository;

class ListingRepo {

	public $paginate = 20;

	public $sortBy = 'updated_at';

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

	public function create($model, $data) {
		return $this->{$model}->create($data);
	}

	public function insert($model, $data) {
		return $this->{$model}->insert($data);
	}

	public function get($model, $params) {
		return $this->{$model}
			->where($params)
			->latest($this->sortBy)
			->paginate($this->paginate);
	}

	public function get_with($model, $params, $relation) {
		return $this->{$model}
			->where($params)
			->with($relation)
			->latest($this->sortBy)
			->paginate($this->paginate);
	}

	public function first($model, $params) {
		return $this->{$model}
			->where($params)
			->first();
	}

	public function first_with($params, $relation) {
		return $this->listing
			->where($params)
			->with($relation)
			->first();
	}

	public function delete($model, $id) {
		return $this->{$model}
			->whereId($id)
			->delete();
	}

	public function update($model, $id, $data) {
		return $this->{$model}
			->whereId($id)
			->update($data);
	}

	public function active_deactive($id, $column) {
		$query = $this->listing->whereId((int) $id);
		$status = $query->select($column)->first();
		$updateStatus = ($status->{$column}) ? 0 : 1;
		$query->update([$column => $updateStatus]);
		return $updateStatus;
	}
}