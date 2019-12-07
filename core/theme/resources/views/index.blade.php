@include('theme::header')

<div class="page-content">
    <div>
        <div class="profile-page">
            <div class="wrapper">
                <div class="page-header page-header-small" filter-color="green">
                    <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('frontend/images/bg.jpg') }}');"></div>
                    <div class="container">
                        <div class="content-center">
                            <div class="cc-profile-team-image">
                                <a href="{{ route('root') }}"><img src="{{ asset('frontend/images/team.jpg') }}" alt="Image" /></a>
                            </div>
                            <div class="h2 title">Real Value of Life</div>
                            <p class="category text-white">Đồ Án Môn Học - Nhập Môn Công Nghệ Thông Tin</p>
                            <a class="btn btn-primary smooth-scroll mr-2" href="#about" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Thông Tin</a>
                            <a class="btn btn-primary smooth-scroll mr-2" href="#member" data-aos="zoom-in" data-aos-anchor="data-aos-anchor">Thành viên</a>
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
                                <div class="h4 mt-0 title">Giới Thiệu</div>
                                <p>Nhóm VNV được thành lập vào ngày 19/11/2019 nhằm thực hiện đồ án môn học của môn Nhập Môn Công Nghệ Thông Tin.</p>
                                <p>Nhóm thành lập bao gồm 3 thành viên, thực hiện đề tài "Real Value of Life" </p>
                                <p>Câu slogan của nhóm là <strong>"Live a Life You’re Incredibly Proud of"</strong></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="card-body">
                                <div class="h4 mt-0 title">Thông tin nhóm:</div>
                                <div class="row">
                                    <div class="col-sm-4"><strong class="text-uppercase">Ngày thành lập:</strong></div>
                                    <div class="col-sm-8">19/11/2019</div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4"><strong class="text-uppercase">Nhóm trưởng:</strong></div>
                                    <div class="col-sm-8"><a href="{{ route('view', ['slug' => 'ho-dang-minh']) }}">Hồ Đăng Minh</a></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4"><strong class="text-uppercase">Thành viên:</strong></div>
                                    <div class="col-sm-8"><a href="{{ route('view', ['slug' => 'ngo-huynh-hai-vy']) }}">Ngô Huỳnh Hải Vy</a></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4"><strong class="text-uppercase">Thành viên:</strong></div>
                                    <div class="col-sm-8"><a href="{{ route('view', ['slug' => 'nguyen-phuoc-vinh']) }}">Nguyễn Phước Vinh</a></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-4"><strong class="text-uppercase">Thông tin liên lạc:</strong></div>
                                    <div class="col-sm-8"><a href="mailto:hdminh2511@gmail.com">hdminh2511@gmail.com</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section" id="logo">
            <div class="container cc-reference">
                <div class="h4 mb-4 text-center title">Logo Nhóm</div>
                <div class="card" data-aos="zoom-in">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('frontend/images/logo.png') }}" style="width: 250px; height: auto">
                        </div>
                        <div class="col-md-9">
                            Logo nhóm lấy ý tưởng từ chữ cái đầu tiên của các thành viên trong nhóm cộng với đề tài thực hiện đồ án.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section" id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="h4 text-center mb-4 title">Hình ảnh nhóm</div>
                        <div class="nav-align-center">
                            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                {{--<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#web-development" role="tablist"><i class="fa fa-laptop" aria-hidden="true"></i></a></li>--}}
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#graphic-design" role="tablist"><i class="fa fa-picture-o" aria-hidden="true"></i></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Photography" role="tablist"><i class="fa fa-camera" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content gallery mt-5">
                    {{--<div class="tab-pane active" id="web-development">--}}
                        {{--<div class="ml-auto mr-auto">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">--}}
                                        {{--<a href="#web-development">--}}
                                            {{--<figure class="cc-effect"><img src="images/project-1.jpg" alt="Image" />--}}
                                                {{--<figcaption>--}}
                                                    {{--<div class="h4">Recent Project</div>--}}
                                                    {{--<p>Web Development</p>--}}
                                                {{--</figcaption>--}}
                                            {{--</figure>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">--}}
                                        {{--<a href="#web-development">--}}
                                            {{--<figure class="cc-effect"><img src="images/project-2.jpg" alt="Image" />--}}
                                                {{--<figcaption>--}}
                                                    {{--<div class="h4">Startup Project</div>--}}
                                                    {{--<p>Web Development</p>--}}
                                                {{--</figcaption>--}}
                                            {{--</figure>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">--}}
                                        {{--<a href="#web-development">--}}
                                            {{--<figure class="cc-effect"><img src="images/project-3.jpg" alt="Image" />--}}
                                                {{--<figcaption>--}}
                                                    {{--<div class="h4">Food Order Project</div>--}}
                                                    {{--<p>Web Development</p>--}}
                                                {{--</figcaption>--}}
                                            {{--</figure>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">--}}
                                        {{--<a href="#web-development">--}}
                                            {{--<figure class="cc-effect"><img src="images/project-4.jpg" alt="Image" />--}}
                                                {{--<figcaption>--}}
                                                    {{--<div class="h4">Web Advertising Project</div>--}}
                                                    {{--<p>Web Development</p>--}}
                                                {{--</figcaption>--}}
                                            {{--</figure>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="tab-pane active" id="graphic-design" role="tabpanel">
                        <div class="ml-auto mr-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#graphic-design">
                                            <figure class="cc-effect"><img src="{{ asset('frontend/images/g-img-1.jpg') }}" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Triangle Pattern</div>
                                                    <p>Graphic Design</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#graphic-design">
                                            <figure class="cc-effect"><img src="{{ asset('frontend/images/g-img-2.jpg') }}" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Abstract Umbrella</div>
                                                    <p>Graphic Design</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#graphic-design">
                                            <figure class="cc-effect"><img src="{{ asset('frontend/images/g-img-3.jpg') }}" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Cube Surface Texture</div>
                                                    <p>Graphic Design</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#graphic-design">
                                            <figure class="cc-effect"><img src="{{ asset('frontend/images/g-img-4.jpg') }}" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Abstract Line</div>
                                                    <p>Graphic Design</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="Photography" role="tabpanel">
                        <div class="ml-auto mr-auto">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#Photography">
                                            <figure class="cc-effect"><img src="images/photography-1.jpg" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Photoshoot</div>
                                                    <p>Photography</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#Photography">
                                            <figure class="cc-effect"><img src="images/photography-3.jpg" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Wedding Photoshoot</div>
                                                    <p>Photography</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#Photography">
                                            <figure class="cc-effect"><img src="images/photography-2.jpg" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Beach Photoshoot</div>
                                                    <p>Photography</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="cc-porfolio-image img-raised" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                                        <a href="#Photography">
                                            <figure class="cc-effect"><img src="images/photography-4.jpg" alt="Image" />
                                                <figcaption>
                                                    <div class="h4">Nature Photoshoot</div>
                                                    <p>Photography</p>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="member">
            <div class="container cc-experience">
                <div class="heading-title text-center">
                    <h3 class="text-uppercase">Thành Viên Nhóm </h3>
                    <p class="p-top-30 half-txt">Giữa những nhịp sống vội vã của thời gian bạn đã có bao giờ đứng lại ngấm nghĩ giá trị đích thực của cuộc sống.</p>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="team-member">
                            <div class="team-img">
                                <img src="{{ asset('frontend/images/mem-1.jpg') }}" alt="team member" class="img-responsive">
                            </div>
                        </div>
                        <div class="team-title">
                            <h5><a href="{{ route('view', ['slug' => 'ho-dang-minh']) }}">Hồ Đăng Minh</a></h5>
                            <span>Nhóm trưởng</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="team-member">
                            <div class="team-img">
                                <img src="https://image.freepik.com/free-photo/elegant-man-with-thumbs-up_1149-1595.jpg" alt="team member" class="img-responsive">
                            </div>
                        </div>
                        <div class="team-title">
                            <h5><a href="{{ route('view', ['slug' => 'ngo-huynh-hai-vy']) }}">Ngô Huỳnh Hải Vy</a></h5>
                            <span>Thành viên</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="team-member">
                            <div class="team-img">
                                <img src="https://image.freepik.com/free-photo/well-dressed-executive-with-crossed-arms_1098-3930.jpg" alt="team member" class="img-responsive">
                            </div>
                        </div>
                        <div class="team-title">
                            <h5><a href="{{ route('view', ['slug' => 'nguyen-phuoc-vinh']) }}">Nguyễn Phước Vinh</a></h5>
                            <span>Thành Viên</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('theme::footer')