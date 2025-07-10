@extends("{$activeTheme}layouts.frontend")

@php $bannerContent = getSiteData('banner.content', true) @endphp

@section('frontend')
<section class="banner-section">
    <div class="banner-section__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/banner/' . $bannerContent->data_info->background_image, '1920x1080') }}"></div>
    <div class="container">
        <div class="banner-content-wrap">
            <div class="row align-items-center justify-content-lg-between justify-content-center">
                <div class="col-md-6">
                    <div class="banner-content" data-aos="fade-right" data-aos-duration="1000" data-aos-offset="50">
                        <h4 class="banner-content__subtitle">{{ __($bannerContent->data_info->subtitle) }}</h4>
                        <h1 class="banner-content__title">{{ __($bannerContent->data_info->title) }} <span class="styled-title" data-mask-image="{{ asset($activeThemeTrue . 'images/title-vector.png') }}">{{ __($bannerContent->data_info->highlighted_part) }}</span></h1>
                        <p class="banner-content__desc">{{ __($bannerContent->data_info->description) }}</p>
                        <div class="banner-content__btn-box">
                            @auth('web')
                                <a href="{{ route('user.home') }}" class="btn btn--base">@lang('Explore Dashboard') <i class="ti ti-arrow-up-right"></i></a>
                            @endauth

                            @guest('web')
                                <a href="{{ route('user.register.form') }}" class="btn btn--base">@lang('Create Account') <i class="ti ti-arrow-up-right"></i></a>
                            @endguest

                            <a href="#" class="video-btn" data-video-id="{{ __($bannerContent->data_info->youtube_video_id) }}">
                                <span class="video-btn__img">
                                    <span class="video-btn__shadow bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/banner/' . $bannerContent->data_info->video_button_background_image, '200x200') }}"></span>
                                    <i class="ti ti-player-play-filled transform-0"></i>
                                </span>
                                <span class="video-btn__txt">Watch Video</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-8 col-xsm-8 col-10">
                    <div class="banner-thumb d-flex justify-content-end" data-aos="fade-left" data-aos-duration="1000"  data-aos-offset="50">
                        <img src="{{ getImage($activeThemeTrue . 'images/site/banner/' . $bannerContent->data_info->image, '601x602') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @include("{$activeTheme}sections.aboutUs")
    @include("{$activeTheme}sections.services")
    @include("{$activeTheme}sections.whyChooseUs")
    @include("{$activeTheme}sections.process")
    @include("{$activeTheme}sections.features")
    @include("{$activeTheme}sections.dps")
    @include("{$activeTheme}sections.fds")
    @include("{$activeTheme}sections.loan")
    @include("{$activeTheme}sections.faq")
    @include("{$activeTheme}sections.testimonials")
    @include("{$activeTheme}sections.counters")
    @include("{$activeTheme}sections.subscribe")
    @include("{$activeTheme}sections.partners")
@endsection

@push('page-style-lib')
    <link rel="stylesheet" href="{{ asset("{$activeThemeTrue}css/modal-video.min.css") }}">
    <link rel="stylesheet" href="{{ asset("{$activeThemeTrue}css/slick.css") }}">
@endpush

@push('page-script-lib')
    <script src="{{ asset("{$activeThemeTrue}js/modal-video.min.js") }}"></script>
    <script src="{{ asset("{$activeThemeTrue}js/slick.min.js") }}"></script>
@endpush
