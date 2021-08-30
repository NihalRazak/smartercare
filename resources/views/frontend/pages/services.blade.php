@extends('frontend.layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
    @include('frontend.includes.nav')
    <div id="app" class="flex-center position-ref full-height">
        <div class="container">
            <h1 style="margin-top: 30px">Services</h1>
            <hr/>
            <div class="content">
                <h2>Associations, Employers, & Unions</h2>
                <div class="content-block">
                    <div style="width: 19%;">
                        <img style="width: 100%" src="/img/Ounce-of-Prevention.png" />
                    </div>
                    <div style="flex: 1; padding: 0 4%;">
                        <p style="font-size:17px">Plan sponsors see trend increases year after year. One key reason is, insureds use hospitals for routine services life bloodwork, imaging surgeries and urgent care, resulting in inflated healthcare expense. 360 Smarter Search tool guides insureds to lower cost, in-network facilities for routine care.&nbsp;Deploy 360 Smarter Search within the frame work of <a href="https://360smartercare.com/"><strong>Smarter Care</strong></a> or <a href="https://360smartercare.com/smart-sized/"><strong>Smart Sized</strong></a> to reduce your Healthcare Cost Expenses in Self Funded Plans or to improve your Experience Rating in fully funded traditional healthcare insurance coverage. Both Smarter Care and Smart Sized are Revenue Neutral and are effective cost containment measures.</p>
                        <p class="text-center">
                            <a rel="noreferrer noopener" href="information@360smartercare.com" target="_blank"><strong>information@360smartercare.com</strong></a>
                        </p>
                    </div>
                </div>
                
                <h2>Insurance Companies & Third Party Administrators</h2>
                <div class="content-block">
                    <div style="flex: 1; padding: 0 4%;">
                        <p style="font-size:17px">Plan sponsors and fiduciaries work diligently to healthcare costs and budgets. At the same time, they seek to deliver greater value to their insureds. No matter what they try healthcare costs continue to soar.</p>
                        <p style="font-size:17px">360’s insured-centric approach enables those with chronic conditions to increase adherence to their physician’s care plan. Clinical studies show increased adherence leads to better health and lower care cost expenses.</p>
                        <p style="font-size:17px">Simultaneously, 360 guides insureds to their most cost-effective in-network providers for commodity care in these categories: bloodwork, imaging, outpatient surgery, and urgent care delivering lower-cost, outpatient care without compromising quality.</p>
                        <p style="font-size:17px">360 Smarter Search can accommodate your Direct Contract Providers with full custom mapping for your specific In-Network providers.</p>
                        <p class="text-center">
                            <a rel="noreferrer noopener" href="information@360smartercare.com" target="_blank"><strong>information@360smartercare.com</strong></a>
                        </p>
                    </div>
                    <div style="width: 19%;">
                        <img style="width: 100%" src="/img/Dead-24-Hours-a-Day-1024x990.png" />
                    </div>
                </div>
            </div>
            @include('frontend.includes.footer')
        </div>
    </div><!--app-->
@endsection
