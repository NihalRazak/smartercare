<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CptSurgery.
 */
class CptSurgery extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cpt_surgery';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpt_code',
        'owcp_asc_modifier',
        'description'
    ];
}
