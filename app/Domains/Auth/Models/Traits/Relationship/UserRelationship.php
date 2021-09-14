<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\PasswordHistory;
use App\Domains\Auth\Models\Company;
use App\Domains\Auth\Models\Address;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }
    
    /**
     * @return mixed
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
