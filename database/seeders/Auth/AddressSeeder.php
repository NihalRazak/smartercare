<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Address;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class AddressTableSeeder.
 */
class AddressSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        Address::create([
            'number' => '123',
            'street_name' => 'main street',
            'apt_or_unit' => '',
            'zip_code' => '90001',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'user_id' => 1
        ]);

        if (app()->environment(['local', 'testing'])) {
            Address::create([
                'number' => '234',
                'street_name' => 'test street',
                'apt_or_unit' => '',
                'zip_code' => '90001',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'user_id' => 2
            ]);
        }

        $this->enableForeignKeys();
    }
}
