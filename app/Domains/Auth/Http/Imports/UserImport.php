<?php

namespace App\Domains\Auth\Http\Imports;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserNotification;

class UserImport implements ToCollection
{
    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    public function collection(Collection $rows)
    {
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
                    $company = Company::where('id', $this->company_id)->first()->name;
                    User::create([
                        'first_name' => $row[0],
                        'middle_name' => $row[1],
                        'last_name' => $row[2],
                        'company_id' => $this->company_id,
                        'email' => $email,
                        'phone' => $row[4],
                        'age' => $row[5],
                        'sex' => $row[6], 
                        'password' => Hash::make("Welcome#1")
                    ]);
                    
                    // Send welcome email notification
                    $name = $row[0];
                    Mail::to($email)->send(new NewUserNotification($name, $email, $company));
                }
            }
        }
    }
}