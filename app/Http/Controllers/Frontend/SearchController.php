<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Auth\Models\User;

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
            $company_id = $user->company_id;
            $company_admin = User::where('company_id', $company_id)->where('type', 2)->first();
            if ($user->isMasterAdmin()) {
                $isSubscribed = true;
            } else if (isset($company_admin)) {
                $subscription = $company_admin->subscriptions()->active()->first();
                if (isset($subscription)) {
                    $isSubscribed = true;
                }
            }
        }
        return view('frontend.pages.search', ['isSubscribed' => $isSubscribed]);
    }
}
