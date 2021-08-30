<?php

namespace App\Http\Controllers\Frontend;

/**
 * Class AboutController.
 */
class AboutController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.pages.about');
    }
}
