<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CptUrgentcare.
 */
class CptUrgentcare extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cpt_urgentcare';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpt_code',
        'er_level'
    ];
}
