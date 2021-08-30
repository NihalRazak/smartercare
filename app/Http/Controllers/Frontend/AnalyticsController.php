<?php

namespace App\Http\Controllers\Frontend;
use App\Domains\Auth\Models\Visitor;
use App\Domains\Auth\Models\Through;
use App\Domains\Auth\Models\Method;
use Illuminate\Http\Request;

/**
 * Class AnalyticsController.
 */
class AnalyticsController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function count_visitor(Request $request)
    {
        $user = auth()->user();
        $company = isset($user) ? $user->company->name : "search";
        $today = date("Y-m-d");
        $count = Visitor::where('company', $company)
                        ->where('visit_date', $today)
                        ->count();
        if ($count) {
            Visitor::where('company', $company)->where('visit_date', $today)->increment('count', 1);
        } else {
            Visitor::insert([
                'company' => $company,
                'visit_date' => $today,
                'count' => 1
            ]);
        }
        echo json_encode("success");
    }

    public function count_through(Request $request)
    {
        $user = auth()->user();
        $company = isset($user) ? $user->company->name : "search";
        $through = isset($request->through) ? $request->through : NULL;
        $today = date("Y-m-d");
        $count = Through::where('company', $company)
                        ->where('through', $through)
                        ->where('search_date', $today)
                        ->count();
        if ($count) {
            Through::where('company', $company)
                    ->where('through', $through)
                    ->where('search_date', $today)
                    ->increment('count', 1);
        } else {
            Through::insert([
                'company' => $company,
                'through' => $through,
                'search_date' => $today,
                'count' => 1
            ]);
        }
        echo json_encode("success");
    }

    public function count_method(Request $request)
    {
        $user = auth()->user();
        $company = isset($user) ? $user->company->name : "search";
        $network = isset($request->network) ? $request->network : NULL;
        $method = isset($request->method) ? $request->method : NULL;
        $today = date("Y-m-d");
        $count = Method::where('company', $company)
                        ->where('network', $network)
                        ->where('method', $method)
                        ->where('search_date', $today)
                        ->count();
        if ($count) {
            Method::where('company', $company)
                    ->where('network', $network)
                    ->where('method', $method)
                    ->where('search_date', $today)
                    ->increment('count', 1);
        } else {
            Method::insert([
                'company' => $company,
                'network' => $network,
                'method' => $method,
                'search_date' => $today,
                'count' => 1
            ]);
        }
        echo json_encode("success");
    }
}
