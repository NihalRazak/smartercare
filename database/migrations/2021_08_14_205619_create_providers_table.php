<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('new')->nullable();
            $table->string('remove')->nullable();
            $table->string('npi')->nullable();
            $table->string('facility_name')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('telephone')->nullable();
            $table->string('website')->nullable();
            $table->string('affiliation')->nullable();
            $table->string('Blue_Shield')->nullable();
            $table->string('United')->nullable();
            $table->string('Cigna')->nullable();
            $table->string('Aetna')->nullable();
            $table->string('Humana')->nullable();
            $table->string('Medcost')->nullable();
            $table->string('Cofinity')->nullable();
            $table->string('Kaiser')->nullable();
            $table->string('UPMC')->nullable();
            $table->string('PHCS')->nullable();
            $table->string('hca_quest')->nullable();
            $table->string('All_Providers')->nullable();
            $table->string('blood_work')->nullable();
            $table->string('surgery_center')->nullable();
            $table->string('imaging_center')->nullable();
            $table->string('type')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->integer('pratter_price_guarantee')->nullable();
            $table->string('dermatology')->nullable();
            $table->string('ear_nose_throat')->nullable();
            $table->string('gastroenterology')->nullable();
            $table->string('general_surgery')->nullable();
            $table->string('neurosurgery')->nullable();
            $table->string('obstetrics_gynecology')->nullable();
            $table->string('orthopedic_surgery')->nullable();
            $table->string('ophthalmology')->nullable();
            $table->string('pain_anesthesiology')->nullable();
            $table->string('podiatry')->nullable();
            $table->string('pulmonology')->nullable();
            $table->string('urology')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers');
    }
}
