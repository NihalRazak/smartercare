<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GreenImaging.
 */
class GreenImaging extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'green_imaging';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NPI',
        'facility_name',
        'street_address',
        'city',
        'state',
        'zip_code',
        'telephone',
        'website',
        'affiliation',
        'cpts'
    ];
}
