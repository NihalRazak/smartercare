<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CptImaging.
 */
class CptImaging extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cpt_imaging';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpt_code',
        'procedure'
    ];
}
