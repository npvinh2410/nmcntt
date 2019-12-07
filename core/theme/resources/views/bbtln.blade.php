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
                            <div class="h2 title">Biên bản thành lập nhóm</div>
                            <p class="category text-white">Đồ Án Môn Học - Nhập Môn Công Nghệ Thông Tin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section" id="about">
            <div class="container">
                <div class="card" data-aos="fade-up" data-aos-offset="10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div id="bbtln"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let pdf_url = '{{ asset('frontend/bbtln.pdf') }}';
</script>

@include('theme::footer')