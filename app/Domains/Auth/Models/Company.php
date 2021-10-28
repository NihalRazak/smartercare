<?php

namespace App\Domains\Auth\Models;
use App\Domains\Auth\Models\Traits\Relationship\CompanyRelationship;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company.
 */
class Company extends Model
{
    use CompanyRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'status',
        'isPaid',
        'default_provider'
    ];
}
