<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PetPolicy
 * @package App
 */
class PetPolicy extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function listings() {
        return $this->belongsToMany(
            Listing::class,
            'listing_pet_policies',
            'listing_id',
            'pet_policy_id'
        );
    }
}
