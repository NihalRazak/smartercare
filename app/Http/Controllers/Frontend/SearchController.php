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
}
