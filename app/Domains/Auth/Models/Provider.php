<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Provider.
 */
class Provider extends Model
{

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'new',
        'remove',
        'npi',
        'facility_name',
        'street_address',
        'city',
        'state',
        'zip_code',
        'telephone',
        'website',
        'affiliation',
        'Blue_Shield',
        'United',
        'Cigna',
        'Aetna',
        'Humana',
        'Medcost',
        'Cofinity',
        'Kaiser',
        'UPMC',
        'PHCS',
        'hca_quest',
        'All_Providers',
        'blood_work',
        'surgery_center',
        'imaging_center',
        'type',
        'latitude',
        'longitude',
        'pratter_price_guarantee',
        'dermatology',
        'ear_nose_throat',
        'gastroenterology',
        'general_surgery',
        'neurosurgery',
        'obstetrics_gynecology',
        'orthopedic_surgery',
        'ophthalmology',
        'pain_anesthesiology',
        'podiatry',
        'pulmonology',
        'urology'
    ];
}
