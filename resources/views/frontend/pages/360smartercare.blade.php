@extends('frontend.layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
    @include('frontend.includes.nav')
    <div id="app" class="flex-center position-ref full-height">
        <div class="container">
            <h1 style="margin-top: 30px">360 Smarter Care</h1>
            <hr/>
            <div class="content mb-4">
                <iframe loading="lazy" title="360 Video Executive Summary" src="https://player.vimeo.com/video/562223440?dnt=1&amp;app_id=122963" width="1200" height="675" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                <div class="content-block">
                    <div style="width: 24%;">
                        <img style="width: 100%" src="/img/Customer-Lost.png" />
                    </div>
                    <div style="flex: 1; padding: 0 4%;">
                        <h2 class="text-center"><em>The Inherent Problem with Healthcare</em></h2>
                        <p style="font-size:17px">Healthcare cost is crippling businesses; driving self-funded plans to cost-shift to survive. The problem is the incestuous relationship between Insurance companies, Third-Party Administrators, and Healthcare Providers. It is a serious conflict of interest and the reason why care cost has reached obscene levels. The working men and women of the USA are paying for their sins. This article was written by our founder to define the problem and explain why the 360 Solution was created.</p>
                    </div>
                </div>
                <div class="content-block">
                    <div style="flex: 1; padding: 0 4%;">
                        <h2 class="text-center"><em>The 360 Solution</em></h2>
                        <p style="font-size:17px">360's delivers delivers disproportionate results by addressing four areas of your self-funded plan that drive the majority of controllable healthcare cost expenses. Using state-of-the-art proprietary AI technology 360 presents our clients with the ultimate in mass scalability while concurrently delivering individualized personalized communication exactly the way their employees, members, each care consumer desire. AI-driven communication delivers exceptionally high levels of participation and integration.<br>Artificial Intelligence Intelligently Applied delivers guaranteed savings on care cost with improved outcomes, with a healthier insured population. It starts with your request to speak with a 360 Smarter Care Advisor.</p>
                    </div>
                    <div style="width: 24%;">
                        <img style="width: 100%" src="/img/360-Smarter-Care-WEB.png" />
                    </div>
                </div>
                <div class="block-columns">
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/Red-Cross-WEB.png" />
                        <h3>Location, Location, Location</h3>
                        <p></p>
                        <p style="font-size:17px"><strong>Reduce Outpatient Facility Care Cost Within Your Existing Provider Network: </strong>Using an extensive database to sort out providers by a variety of criteria that also exclude high cost vertically integrated providers you outpatient care cost can be reduced 30% or more. </p>
                        <p style="font-size:17px">Using 360 Smarter Search allows your employees or members to make better informed smarter healthcare choices.</p>
                        <p style="font-size:17px">Using In-Network providers is your quality-of-care assurance. </p>
                        <p style="font-size:17px">For larger groups, 360 can implement CSI ratings specific to your insureds as our relationship and specific-to-you-database matures.</p>
                    </div>
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/Chronic-Care-Symbol-WEB-6.png" />
                        <h3>AI Chronic Care 24/7/365</h3>
                        <p></p>
                        <p style="font-size:17px"><strong>Incrementally Increase Adherence to Physician Care Plans Reducing Your Care Cost Expense.</strong><br>Mass Scalable Personalized Digital Therapeutics are the key to reducing care costs while improving the health of your insured population, including your insureds with multiple chronic conditions. </p>
                        <p style="font-size:17px">We can put a price on these services because there are quantifiable savings. <strong>How much more important are the events we prevent? </strong></p>
                        <p style="font-size:17px">Examples are a 30% reduction in use of opioids for chronic pain, a 20% reductions in readmission after cardiac procedures, or a 19% increase in adherence to physicians care plans by diabetics.</p>
                        <p style="font-size:17px"><strong>Good Health isn’t Expensive. Good Health is Priceless.</strong></p>
                    </div>
                </div>
                <div class="block-columns">
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/RPM-WEB-copy.png" />
                        <h3>Remote Patient Monitoring (RPM)</h3>
                        <p></p>
                        <p style="font-size:17px"><strong>Our AI-Personal Health Coaches monitor those that will benefit from Human Intervention as required by clinical measures.</strong></p>
                        <p style="font-size:17px">Our AI-Digital Physician’s Assistants are smart enough to know when to reach out to an insured’s physician’s office with the appropriate clinical metrics. </p>
                        <p style="font-size:17px">Your insured is invited to visit their physicians’ office, instead of the ER or hospital.</p>
                        <p style="font-size:17px">R.P.M. makes phone apps and hand written charts obsolete. </p>
                        <p style="font-size:17px"><strong>If you are not offering the benefits of R.P.M. to the insureds in your self-funded plan, you should be.</strong></p>
                    </div>
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/Red-Cross-WEB-copy-2.png" />
                        <h3>Digital Consumerism®</h3>
                        <p></p>
                        <p style="font-size:17px">The health of your insured population is directly related to their overall well being. Digital Consumerism® , Medical Consumerism are vital to improving population health. 360 will partner with you to create videos that educate and inform.</p>
                        <p style="font-size:17px">– When to Choose Urgent Care or ER<br>– How to Find an In-Network Provider<br>– The Benefits of Using Tele-Doc Service<br>– Better Manage Your Health with Your Personal Concierge</p>
                        <p style="font-size:17px">You spend a fortune on  employee healthcare and  supporting benefits. </p>
                        <p style="font-size:17px">Our informational and educational approach will increase utilization of your existing programs and serve to reinforce the behaviors necessary to implement and execute the <strong>360 Solution</strong>.</p>
                    </div>
                </div>
                <div class="block-columns">
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/Dash-WEB-copy-2.png" />
                        <h3>What Gets Measured, Gets Improved</h3>
                        <p></p>
                        <p style="font-size:17px"><strong>When you review your self-funded plan do you go to your K.P.I. Dashboard? </strong></p>
                        <p style="font-size:17px">As a 360 Client You Have Access to Your Metrics 24/7/365 with Your Dashboard. A review with 360 provides you with <strong>Granular Actionable Data. </strong>Our reporting format is as important and the data because the way it is parsed, the way it is presented leads to improvement in cost containment and insured population health.</p>
                        <p style="font-size:17px">We meet with your key stakeholders every 30 days to review the critical metrics that impact your annual healthcare cost spend.</p>
                        <p style="font-size:17px">No amount of cost shifting, no draconian reductions in benefits can be effective because they do not address population health. Incremental improvement in the 10% of your insureds that account for 80% of your care cost expense in where we will create improvement.</p>
                    </div>
                    <div class="block-column" style="width: 50%; padding-right: 1em;">
                        <img style="width: 100%" src="/img/Quadrant-2-WEB-1.png" />
                        <h3>Priceless Progress</h3>
                        <p></p>
                        <p style="font-size:17px">Every quality organization strives to improve the quality of their most valuable asset, their members of employees. Countless hours and dollars are invested in pursuit of this lofty goals.</p>
                        <p style="font-size:17px">– How do you quantify the benefit of a good night’s sleep to the productivity or your organization?</p>
                        <p style="font-size:17px">– How many sick days to your employees take to handle personal financial matters?</p>
                        <p style="font-size:17px">Our 24/7/365 curated educational content is relevant to each individual to elevate their performance. The support we deliver is impactful in the area of improved adherence to the doctor’s specific care plan.  Together they create a healthier more productive workforce.</p>
                        <p style="font-size:17px">Your use of our sophisticated AI messaging platform reinforces your culture through the most influential dissemination of in-the-moment information, at no additional cost.</p>
                    </div>
                </div>
                <div class="content-block">
                    <div style="width: 50%; padding: 0 4%;">
                        <video style="width: 100%" controls="" src="/video/Jay-Delsing-Talks-360.mp4"></video>
                    </div>
                    <div style="width: 50%; padding: 0 4%;">
                        <p>Hear what Jay Delsing, former PGA Touring Pro and <a href="https://www.podcastone.com/golf-with-jay-delsing" data-type="URL" data-id="https://www.podcastone.com/golf-with-jay-delsing" target="_blank" rel="noreferrer noopener">Host of  the Golf with Jay Desling Podcast</a>, has to say about 360 Smarter Care.</p>
                    </div>
                </div>
                <a href="/search/">
                    <img class="search-now" id="search_now_1" src="/img/Smarter-Search-Now-iPhone-12-Pro-794x1024.png" />
                </a>
            </div>
            @include('frontend.includes.footer')
        </div>
    </div><!--app-->
@endsection
