<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ appName() }}</title>
        <meta name="description" content="@yield('meta_description', appName())">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        @stack('after-styles')
    </head>
    <body>
        @include('frontend.includes.nav')

        <div id="app" class="flex-center position-ref full-height">
            <div class="container">
                <h1 style="margin-top: 30px">Smarter Search</h1>
                <hr/>
                <div class="header text-center mb-4">
                    <img class="block-image" id="logo" src="/img/Smarter Search Words.png" />
                </div>
                <div class="content">
                    @if ($logged_in_user)
                    <a href="/search/">
                        <img class="search-now" id="search_now_5" src="/img/Search Button.png" />
                    </a>
                    @else
                    <a href="/login/">
                        <img class="search-now" id="search_now_5" src="/img/Login Button.png" />
                    </a>
                    @endif
                    <a href="/subscribe/">
                        <img class="search-now" id="search_now_6" src="/img/Subscribe Button.png" />
                    </a>

                    <div class="iframe-container mt-5">
                        <iframe class="responsive-iframe" loading="lazy" title="Why You Should Use Smarter Search.mp4" src="https://player.vimeo.com/video/592753989?dnt=1&amp;app_id=122963&amp;h=34761efa47" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                    <p style="font-size: 18px;margin-top: 15px;">Outpatient Care Cost Containment is transactional, straightforward, simple for what we refer to as commodity care, routine procedures with predictable results.  Vertically integrated outpatient facilities for blood work, imaging, surgery, and urgent care charge more, than independently owned facilities, to provide the same level of care.  <strong>Smarter Search Users typically save 40% on the care they receive. Watch now to see you you should be using Smarter Search.</strong>  </p>
                    
                    <a href="/login/">
                        <img class="search-now" id="search_now_5" src="/img/Save Now.png" />
                    </a>
                    <div class="iframe-container mt-4">
                        <iframe class="responsive-iframe" loading="lazy" title="How to Use Smarter Search.mp4" src="https://player.vimeo.com/video/592851769?dnt=1&amp;app_id=122963&amp;h=cb5b3470cf" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                    <p style="font-size: 18px;margin-top: 15px;"><strong>360 Smarter Search is Smart. </strong>When you open your phone it knows where you are.  <strong>Using Smarter Search is Intuitive</strong>, but Jarry is here to walk you through it. </p>
                    
                    <a href="/login/">
                        <img class="search-now" id="search_now_5" src="/img/Save Now.png" />
                    </a>
                    <div class="iframe-container mt-4">
                        <iframe class="responsive-iframe" loading="lazy" title="When Should I use the Emergency Room or Urgent Care?" src="https://player.vimeo.com/video/542711011?dnt=1&amp;app_id=122963&amp;h=8bddf622de" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""></iframe>
                    </div>
                    <p style="font-size: 18px;margin-top: 15px;">Knowing when to use the Emergency Room or Urgent Care impacts your wallet, <strong>but more importantly your health. </strong>  <br>This video walks you through the decision points you need to decide <strong>which is best for your health.</strong>  </p>
                    
                    <a href="/login/">
                        <img class="search-now" id="search_now_5" src="/img/Join the Movement.png" />
                    </a>
                    <a href="/search/">
                        <img class="search-now" id="search_now_3" src="/img/Smarter-Search-Now-Note-20-570x1024.png" />
                    </a>
                    <p class="text-center mt-4"><em>As important as it is to be an educated medical care consumer, it is equally important to make your decisions in conjunction with your personal physician. Show them the results of your Smarter Search and confirm there are no comorbidities or conditions that warrant a procedure being done in a hospital setting at multiple times the cost of an outpatient facility. If in your physician’s professional opinion you are best served at a higher-priced facility that is exactly where your procedure should take place.&nbsp;</em></p>
                </div>
                <div class="footer">
                    <p class="text-center">
                        <a href="https://360smartercare.com/advisor-assets/">Advisors</a>
                        <a href="https://360smartercare.com/contact/">Contact</a>
                        <a href="https://360smartercare.com/privacy/">Privacy Policy</a>
                        <a href="https://360smartercare.com/terms-conditions/" data-type="URL" data-id="https://360smartercare.com/terms-conditions/"> Terms & Conditions</a>
                    </p>
                </div>
            </div>
        </div><!--app-->

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
