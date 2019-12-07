@include('theme::header')

<div class="page-content">
    <div>
        <div class="profile-page">
            <div class="wrapper">
                <div class="page-header page-header-small" filter-color="green">
                    <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('frontend/images/bg2.jpg') }}');"></div>
                    <div class="container">
                        <div class="content-center">
                            <div class="cc-profile-image">
                                <a href="#"><img src="{{ $page->translate(get_current_lang_code())->the_thumbnail() }}" alt="Image" /></a>
                            </div>
                            <div class="h2 title">{{ $page->translate(get_current_lang_code())->the_title() }}</div>
                            <p class="category text-white">Live a Life You’re Incredibly Proud of</p>
                        </div>
                    </div>
                    <div class="section">
                        <div class="container">
                            <div class="button-container">
                                @if(isset($page->translate(get_current_lang_code())->the_excerpt2()['Facebook']) || isset($page->translate(get_current_lang_code())->the_excerpt2()['facebook']))
                                    <a class="btn btn-default btn-round btn-lg btn-icon" href="{{isset($page->translate(get_current_lang_code())->the_excerpt2()['Facebook']) ? $page->translate(get_current_lang_code())->the_excerpt2()['Facebook'] : $page->translate(get_current_lang_code())->the_excerpt2()['facebook'] }}" rel="tooltip" title="Follow me on Facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="about">
            <div class="container">
                <div class="card" data-aos="fade-up" data-aos-offset="10">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card-body">
                                <div class="h4 mt-0 title">About</div>
                                {!! $page->translate(get_current_lang_code())->the_content() !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card-body">
                                <div class="h4 mt-0 title">Basic Information</div>
                                @foreach($page->translate(get_current_lang_code())->the_excerpt2() as $index => $item)
                                    <div class="row">
                                        <div class="col-sm-4"><strong class="text-uppercase">{{ $index }}:</strong></div>
                                        <div class="col-sm-8">{!! $item !!}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('theme::footer')