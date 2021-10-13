<?php

namespace App\Domains\Auth\Http\Imports;

use App\Domains\Auth\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $company_id = auth()->user()->company_id;

        foreach ($rows as $row) 
        {
            $email = $row[3];
            if ($email != 'Email') {
                $exist = User::where('email', $email)->first();
                if ($exist) {
                    $exist->first_name = $row[0];
                    $exist->middle_name = $row[1];
                    $exist->last_name = $row[2];
                    $exist->phone = $row[4];
                    $exist->age = $row[5];
                    $exist->sex = $row[6];
                    $exist->save();
                } else {
                    User::create([
                        'first_name' => $row[0],
                        'middle_name' => $row[1],
                        'last_name' => $row[2],
                        'email' => $email,
                        'phone' => $row[4],
                        'age' => $row[5],
                        'sex' => $row[6], 
                        'password' => Hash::make("secret")
                    ]);
                }
            }
        }
    }
}