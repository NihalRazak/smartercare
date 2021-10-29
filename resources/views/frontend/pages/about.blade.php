@extends('frontend.layouts.app')

@section('title', __('About'))

@section('content')
    @include('frontend.includes.nav')
    <div id="app" class="flex-center position-ref full-height">
        <div class="container">
            <h1 style="margin-top: 30px">About</h1>
            <hr/>
            <div class="content text-left mb-4">
                <div class="content-block">
                    <div style="flex: 1; padding: 0 4%;">
                        <p style="font-size:17px">Cost Containment and Quality Healthcare are rarely used in the same sentence and that is why we created 360 Smarter Search. The disparities in pricing within the same provider network within the same Zip Code are commonly as great as 10 times. </p>
                        <p><strong>10 TIMES!</strong></p>
                        <p class="has-neve-text-color-color has-text-color">The reasons for the disparity are not driven by quality. The disparities are driven by <strong>Facility Cost</strong>, by ownership. In a very fine article on the University of Chicago Medicine’s website explaining when to use an Emergency Room or Urgent Care Facility they clearly state <strong>the cost of care at their Urgent Care centers is the same as the Cost-for-Care as their Emergency Rooms.</strong> <a href="https://www.uchicagomedicine.org/forefront/health-and-wellness-articles/when-to-go-to-the-emergency-room-vs-an-urgent-care-clinic"><strong>Link to U of C Medicine</strong> Article</a></p>
                        <p>An informed healthcare consumer should know what the cost of care will be before the service is rendered. New transparency initiatives are a step forward, but when you are ill or injured are you really going to take the time to shop for the best value in Urgent Care or an ER?</p>
                        <p>360 Smarter Search is here to help you control your Out-of-Pocket expenses for routine outpatient care. This easy-to-use tool will guide you to the nearest high-value care facility within your provider network for Bloodwork, Imaging, Outpatient Surgery, and Urgent Care.</p>
                    </div>
                    <div style="display: inline; width: 48%;">
                        <a href="https://www.uchicagomedicine.org/forefront/health-and-wellness-articles/when-to-go-to-the-emergency-room-vs-an-urgent-care-clinic" target="_blank" rel="noopener">
                            <img style="width: 100%" src="/img/Cost-of-Urgent-Care-Same-as-ER.png" />
                        </a>
                    </div>
                </div>
                <div class="content-block">
                    <div style="display: inline; width: 22%;">
                        <a href="/search/">
                            <img style="width: 100%" src="/img/Smarter-Search-Now-Note-20-570x1024.png" />
                        </a>
                    </div>
                    <div style="flex: 1; padding: 0 4%;">
                        <p style="font-size:17px">These outpatient services are also known as commodity care. They are routine procedures and do not require specialized expertise, skills, or equipment. Your quality assurance comes from your network provider (i.e. Blue Cross, United Healthcare, Aetna, etc.). The facilities would not be in your network if  your provider did not vet them.</p>
                        <p>Using 360 Smarter Search will help you reduce your personal healthcare expenses in several ways. A lower service fee reduces what you pay in co-insurance, typically 20% of the bill up to $5,000 or more. It can be the difference between 20% of $5,000 or $1,000. A difference of $1,000 or $200 out-of-pocket.</p>
                        <p>Different associations, employers, and unions will have created additional incentives to use Smarter Search. The incentives range from reduced deductibles, no deductibles, or cash incentives.  When the cost of care drops for your particular healthcare plan the amount you pay each month for health insurance can be controlled. </p>
                        <p>360 Smarter Care and 360 Smarter Search were created to help you become healthier with our Artificial intelligence Care Programs, Digital Physician’s Assistants, Remote Patient Monitoring, and more. 360 Smarter Search is here to allow you to get the care you need at the most affordable cost within your insurance network. Together they create healthier people and reduce care cost expenses.</p>
                        <p>As an informed healthcare consumer, we encourage you to work with your personal physician to get the best care at the best value. When your doctor prescribes an outpatient procedure pull out your phone and use Smarter Search. Show them your provider options and explain the cost savings. Ask your doctor which cost-effective facility is best for you.</p>
                        <p><strong><em>There will be instances based on your personal health and well-being that your physician wants to perform a procedure at</em></strong> t<strong><em>he most expensive facility. An example would be a patient with multiple comorbidities place them at higher risk and a colonoscopy should be performed in a hospital setting. If your doctor says that is best for you you should absolutely follow their advice. 360 never wants to compromise your health, safety, or care. </em></strong></p>
                    </div>
                </div>
            </div>
            @include('frontend.includes.footer')
        </div>
    </div><!--app-->
@endsection
