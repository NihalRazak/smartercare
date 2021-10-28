<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Company;

/**
 * Class SearchController.
 */
class SearchController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $isSubscribed = false;
        $user = auth()->user();
        if ($user) {
            if ($user->isMasterAdmin()) {
                $isSubscribed = true;
            } else {
                $subscription = $user->subscriptions()->active()->first();
                if (isset($subscription)) {
                    $isSubscribed = true;
                }
            }
        }
        return view('frontend.pages.search', ['isSubscribed' => $isSubscribed]);
    }

    public function company($company)
    {
        $isSubscribed = false;
        $user = auth()->user();
        $companies = Company::where('name', $company)->get();
        if (isset($user)) {
            if (($user->isMasterAdmin() && count($companies)) || (isset($user->company) && $user->company->name == $company)) {
                if ($user->isMasterAdmin()) {
                    $isSubscribed = true;
                } else {
                    $subscription = $user->subscriptions()->active()->first();
                    if (isset($subscription)) {
                        $isSubscribed = true;
                    }
                }
            } else {
                abort(404);
            }
        }
        return view('frontend.pages.company', ['isSubscribed' => $isSubscribed]);
    }
}
