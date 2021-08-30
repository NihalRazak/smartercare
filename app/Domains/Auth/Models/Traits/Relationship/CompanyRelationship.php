<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;

/**
 * Class CompanyRelationship.
 */
trait CompanyRelationship
{
    /**
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
