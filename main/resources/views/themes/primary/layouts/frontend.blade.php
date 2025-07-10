@extends("{$activeTheme}layouts.app")

@if ($setting->language)
    @php $languages = App\Models\Language::active()->get() @endphp
@endif

@section('content')
    <header class="header" id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ getImage(getFilePath('logoFavicon') . '/logo_light.png') }}" alt="logo">
                </a>
                <button type="button" class="navbar-toggler header-button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span id="hiddenNav"><i class="ti ti-menu-2 fz-1 transform-1"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav nav-menu ms-auto align-items-lg-center">
                        <li class="nav-item d-block d-lg-none">
                            <div class="top-button d-flex flex-wrap justify-content-between align-items-center">
                                @isset($languages)
                                    <div class="language-box">
                                        <select class="select form--control langSel" data-home_url="{{ route('home') }}">
                                            @foreach($languages as $language)
                                                <option value="{{ $language->code }}" @selected(session('lang') == $language->code)>
                                                    {{ __($language->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset

                                <ul class="login-registration-list d-flex flex-wrap align-items-center">
                                    <li class="login-registration-list__item">
                                        @guest('web')
                                            <a href="{{ route('user.login.form') }}" class="btn btn--sm btn--base">@lang('Log In')</a>
                                        @endguest

                                        @auth('web')
                                            <a href="{{ route('user.home') }}" class="btn btn--sm btn--base">@lang('Dashboard')</a>
                                        @endauth
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">@lang('Home')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about.us') }}" class="nav-link">@lang('About Us')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('faq') }}" class="nav-link">@lang('FAQ')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">@lang('Contact')</a>
                        </li>
                        <li class="nav-item d-lg-block d-none">
                            <div class="d-flex gap-2">
                                @isset($languages)
                                    <div class="language-box language-box-web">
                                        <select class="select form--control langSel" data-home_url="{{ route('home') }}">
                                            @foreach($languages as $language)
                                                <option value="{{ $language->code }}" @selected(session('lang') == $language->code)>
                                                    {{ __($language->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset

                                @guest('web')
                                    <a href="{{ route('user.login.form') }}" class="btn btn--sm btn--base">@lang('Log In')</a>
                                @endguest

                                @auth('web')
                                    <a href="{{ route('user.home') }}" class="btn btn--sm btn--base">@lang('Dashboard')</a>
                                @endauth
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    @if (!request()->routeIs('home'))
        <section class="breadcrumb">
            <div class="breadcrumb__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/breadcrumb/' . $breadcrumbContent?->data_info->background_image, '1920x1065') }}"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumb__wrapper">
                            <span class="breadcrumb__vector">{{ __(strtoupper($pageTitle)) }}</span>
                            <h1 class="breadcrumb__title">{{ __($pageTitle) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @yield('frontend')

    @php
        $footerContent         = getSiteData('footer.content', true);
        $footerElements        = getSiteData('footer.element', false, null, true);
        $footerContactElements = getSiteData('contact_us.element', false, null, true);
        $policyPages           = getSiteData('policy_pages.element', false, null, true);
    @endphp

    <footer class="footer-area">
        <div class="footer-area__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/footer/' . $footerContent?->data_info->background_image, '1920x700') }}"></div>
        <div class="py-60">
            <div class="container">
                <div class="row justify-content-center gy-5">
                    <div class="col-xl-4 col-sm-6 col-xsm-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="footer-item">
                            <div class="footer-item__logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ getImage(getFilePath('logoFavicon') . '/logo_light.png') }}" alt="footer logo">
                                </a>
                            </div>
                            <p class="footer-item__desc">{{ __($footerContent?->data_info->footer_text) }}</p>
                            <ul class="social-list">
                                @foreach($footerElements as $socialInfo)
                                    <li class="social-list__item">
                                        <a href="{{ $socialInfo->data_info->url }}" class="social-list__link flex-center">
                                            @php echo $socialInfo->data_info->social_icon @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-6 col-xsm-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="footer-item">
                            <h5 class="footer-item__title">@lang('Useful Links')</h5>
                            <ul class="footer-menu">
                                <li class="footer-menu__item">
                                    <a href="{{ route('our.branches') }}" class="footer-menu__link">@lang('Our Branches')</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="{{ route('about.us') }}" class="footer-menu__link">@lang('About Us')</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="{{ route('faq') }}" class="footer-menu__link">@lang('FAQ')</a>
                                </li>
                                <li class="footer-menu__item">
                                    <a href="{{ route('contact') }}" class="footer-menu__link">@lang('Contact Us')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-xsm-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="footer-item">
                            <h5 class="footer-item__title">@lang('Company Policies')</h5>
                            <ul class="footer-menu">
                                <li class="footer-menu__item">
                                    <a href="{{ route('cookie.policy') }}" class="footer-menu__link">
                                        @lang('Cookie Policy')
                                    </a>
                                </li>

                                @foreach($policyPages as $policyPage)
                                    <li class="footer-menu__item">
                                        <a href="{{ route('policy.pages', [$policyPage->id, slug($policyPage->data_info->title)]) }}" class="footer-menu__link">
                                            {{ __($policyPage->data_info->title) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-xsm-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="footer-item">
                            <h5 class="footer-item__title">@lang('Contact With Us')</h5>
                            <ul class="footer-contact-menu">
                                @foreach($footerContactElements as $footerContact)
                                    <li class="footer-contact-menu__item">
                                        <div class="footer-contact-menu__item-content">
                                            <p>{{ __($footerContact->data_info->data) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer py-3">
            <div class="container">
                <div class="text-center">
                    <p class="bottom-footer__text">{{ __($footerContent?->data_info->copyright_text) }}</p>
                </div>
            </div>
        </div>
    </footer>

    @php $cookie = App\Models\SiteData::where('data_key', 'cookie.data')->first() @endphp

    @if ($cookie->data_info->status == ManageStatus::ACTIVE && !\Cookie::get('gdpr_cookie'))
        <div class="cookies-card text-center hide">
            <div class="cookies-card__icon">
                <img src="{{ getImage('assets/universal/images/cookie.png') }}" alt="cookies">
            </div>
            <p class="mt-4 cookies-card__content">{{ $cookie->data_info->short_details }}</p>
            <div class="cookies-card__btn mt-4">
                <button type="button" class="btn btn--base px-5 policy">
                    @lang('Allow')
                </button>
                <a href="{{ route('cookie.policy') }}" type="button" class="text--dark px-5 pt-3">
                    @lang('Learn More')
                </a>
            </div>
        </div>
    @endif
@endsection

@push('page-script')
    <script>
        (function($) {
            "use strict"

            $(".langSel").on("change", function() {
                let homeURL = $(this).data('home_url')
                let langCode = $(this).val()

                window.location.href = `${homeURL}/change-language/${langCode}`
            })

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function() {
                    $('.cookies-card').addClass('d-none')
                })
            })

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000)
        })(jQuery)
    </script>
@endpush
