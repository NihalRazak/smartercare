<?php

namespace App\Domains\Auth\Models;
use App\Domains\Auth\Models\Traits\Relationship\AddressRelationship;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address.
 */
class Address extends Model
{
    use AddressRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'street_name',
        'apt_or_unit',
        'zip_code',
        'city',
        'state',
        'user_id'
    ];
}
