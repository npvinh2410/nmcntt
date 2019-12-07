@extends('dashboard::layouts.main')

@section('title')
    Create new Slide
@endsection

@section('content')
    <form action="{{ route('slides.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="m-portlet">
            <div class="m-portlet__body">

                <input type="hidden" name="slider_id" id="slider_id" value="{{ $slider->id }}">

                <div class="form-group m-form__group row">
                    <label for="slide_name" class="col-2 col-form-label">
                        Name:
                    </label>
                    <div class="col-10">
                        <input class="form-control m-input" type="text" value="{{ old('slide_name') }}" id="slide_name" name="slide_name" placeholder="slider 1" required>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="slide_image" class="col-2 col-form-label">
                        Image:
                    </label>
                    <div class="col-10">
                        <input type="hidden" name="slide_image" id="thumbnail">
                        <div class="img-preview">
                            <img id="thumbnail_preview" src="{{ asset('backend/images/misc/placeholder.png') }}" alt="Xem trước">
                        </div>
                        <a href="javascript:void(0)" class="btn_gallery btn btn-info" style="margin-top: 20px;">Chọn ảnh</a>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="slide_href" class="col-2 col-form-label">
                        Href:
                    </label>
                    <div class="col-10">
                        <input class="form-control m-input" type="text" value="{{ old('slide_href') }}" id="slide_href" name="slide_href"  placeholder="http://hydrogen.com/" required>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="slide_target" class="col-2 col-form-label">
                        Target:
                    </label>
                    <div class="col-10">
                        <select class="form-control m-input" id="slide_target" name="slide_target">
                            <option value="_self">_self</option>
                            <option value="_blank">_blank</option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="slide_follow" class="col-2 col-form-label">
                        Follow:
                    </label>
                    <div class="col-10">
                        <select class="form-control m-input" id="slide_follow" name="slide_follow">
                            <option value="dofollow">dofollow</option>
                            <option value="nofollow">nofollow</option>
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                    </label>
                    <div class="col-10">
                        <button class="btn btn-brand">Submit</button>
                    </div>
                </div>

            </div>
        </div>

    </form>



@endsection

@section('custom_js')
    @include('dashboard::components.media')
@endsection