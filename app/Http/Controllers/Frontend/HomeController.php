<?php

namespace App\Http\Controllers\Frontend;
use App\Domains\Auth\Models\CptBloodwork;
use App\Domains\Auth\Models\CptImaging;
use App\Domains\Auth\Models\CptSurgery;
use App\Domains\Auth\Models\CptUrgentcare;
use App\Domains\Auth\Models\GreenImaging;
use App\Domains\Auth\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;


/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $agent = new Agent();
        if ($agent->is('iPhone') || $agent->is('iPad')) {
            return view('frontend.pages.search', ['isSubscribed' => false]);
        } else {
            return view('frontend.index');
        }
    }

    public function get_zip_codes(Request $request)
    {
        $miles = isset($request->miles) ? $request->miles : 1;
        $postalCode = isset($request->postalCode) ? $request->postalCode : '90010';
        $url = "https://www.zipcodeapi.com/rest/yBTkdHnS73ycblojmV3i2XIU7grzydk4sx9AqFraXdJMieULDfriMXqPgEvZ37md/radius.json/$postalCode/$miles/mile";
        echo file_get_contents($url);
    }
    
    public function get_providers(Request $request)
    {
        $zipCode = isset($request->zipCode) ? $request->zipCode : NULL;
        $network = isset($request->network) ? $request->network : NULL;
        $careCategory = isset($request->careCategory) ? $request->careCategory : NULL;
        $cptCode = isset($request->cptCode) ? $request->cptCode : NULL;
        $categoryOrCPT = isset($request->categoryOrCPT) ? $request->categoryOrCPT : NULL;

        if ($categoryOrCPT == "cpt") {
            $careCategory = "None";
            $result = $this->get_cpt_bloodwork($cptCode);
            if (count($result)) {
                $careCategory = "Bloodwork";
            }
            
            $result = $this->get_cpt_imaging($cptCode);
            if (count($result)) {
                $careCategory = "Imaging";
            }
            
            $result = $this->get_cpt_surgery($cptCode);
            if (count($result)) {
                $careCategory = "Surgery";
            }
            
            $result = $this->get_cpt_urgentcare($cptCode);
            if (count($result)) {
                $careCategory = "Urgent Care";
            }
        }

        $providers = $this->filter_providers($zipCode, $network, $careCategory);
        
        echo json_encode($providers);
    }
    
    public function green_imaging(Request $request)
    {
        $CPTCode = isset($request->cptCode) ? $request->cptCode : NULL;
        $zipCode = isset($request->zipCode) ? $request->zipCode : NULL;
        $categoryOrCPT = isset($request->categoryOrCPT) ? $request->categoryOrCPT : NULL;
        if ($categoryOrCPT == "cpt" && strlen($CPTCode) == 5) {
            $cpt = GreenImaging::where('cpts', 'like', '%'.$CPTCode.'%')
                    ->whereIn('zip_code', explode(',', $zipCode))
                    ->get();
            return $cpt;
        } else if ($categoryOrCPT != "cpt") {
            $cpt = GreenImaging::whereIn('zip_code', explode(',', $zipCode))
                    ->get();
            return $cpt;
        }
        return [];
    }

    private function get_cpt_bloodwork($cpt_code)
    {
        $cpt = CptBloodwork::where('cpt_code', $cpt_code)->get();
        return $cpt;
    }

    private function get_cpt_imaging($cpt_code)
    {
        $cpt = CptImaging::where('cpt_code', $cpt_code)->get();
        return $cpt;
    }

    private function get_cpt_surgery($cpt_code)
    {
        $cpt = CptSurgery::where('cpt_code', $cpt_code)->get();
        return $cpt;
    }

    private function get_cpt_urgentcare($cpt_code)
    {
        $cpt = CptUrgentcare::where('cpt_code', $cpt_code)->get();
        return $cpt;
    }

    private function filter_providers($zipCode, $network, $careCategory)
    {
        if ($zipCode) {
            $query = Provider::whereIn('zip_code', explode(',', $zipCode));
        }
        if ($network) {
            $query = Provider::whereNotNull($network);
        }
        if ($careCategory && $careCategory != "All") {
            $query = Provider::where('type', $careCategory);
        }
        return $query->get();
    }

}
