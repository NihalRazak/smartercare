<?php

namespace App\Http\Controllers\Backend;
use App\Domains\Auth\Models\Visitor;
use App\Domains\Auth\Models\Through;
use App\Domains\Auth\Models\Method;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

    public function get_methods()
    {
        $start_date = date("Y-m-d", strtotime("-6 days"));
        $result = Method::where('search_date', '>', $start_date)->get();
        echo json_encode($result);
    }

    public function get_throughs()
    {
        $start_date = date("Y-m-d", strtotime("-6 days"));
        $result = Through::where('search_date', '>', $start_date)->get();
        echo json_encode($result);
    }

    public function get_visitors()
    {
        $start_date = date("Y-m-d", strtotime("-6 days"));
        $result = Visitor::where('visit_date', '>', $start_date)->get();
        echo json_encode($result);
    }
}
