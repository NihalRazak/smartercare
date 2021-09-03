<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;

/**
 * Class AdditionalInfoController.
 */
class AdditionalInfoController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.additionalinfo.index');
    }
    
    /**
     * @param  Request  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $sex = $request->post('sex');
        $age = $request->post('age');
        $user = auth()->user();
        $user->age = $age;
        $user->sex = $sex;
        $user->save();
        return redirect()->route('admin.dashboard');
    }
}
