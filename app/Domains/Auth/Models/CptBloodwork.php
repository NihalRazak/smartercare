<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CptBloodwork.
 */
class CptBloodwork extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cpt_bloodwork';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpt_code',
        'description'
    ];
}
