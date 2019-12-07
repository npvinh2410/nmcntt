@extends('dashboard::layouts.main')

@section('title')
    {{ $slider->the_name() }}
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('backend/css/flickity.min.css') }}">
@endsection

@section('content')
<div class="m-form">
    <div class="m-portlet">
        <div class="m-portlet__body">

            @if(count($slider->slides))
                <div class="carousel" >
                    @foreach($slider->slides as $slide)
                        <div class="carousel-cell">
                            <img src="{{ $slide->image }}">
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions">
                @if(hydrogen_authorize('sliders-edit', true))
                    <a href="{{ route('sliders.edit', $slider) }}" class="btn btn-primary">Cập nhập</a>
                @endif
                @if(hydrogen_authorize('slides-create', true))
                    <a href="{{ route('sliders.slides', $slider) }}" class="btn btn-brand">Slides</a>
                @endif
                @if(hydrogen_authorize('sliders-index', true))
                    <a href="{{ route('sliders.index') }}" class="btn btn-success">Hủy</a>
                @endif
            </div>
        </div>
    </div>
</div>




@endsection

@section('custom_js')
    <script type="text/javascript" src="{{ asset('backend/js/flickity.pkgd.min.js') }}"></script>
    <style>

        .carousel {
            background: #EEE;
            margin-bottom: 35px;
        }

        .carousel-cell {
            width: 100%; /* full width */
        }

        /* position dots up a bit */
        .flickity-page-dots {
            bottom: -22px;
        }
        /* dots are lines */
        .flickity-page-dots .dot {
            height: 4px;
            width: 40px;
            margin: 0;
            border-radius: 0;
        }

        img
        {
            width: 100%;
        }

    </style>
    <script type="text/javascript">
        $('.carousel').flickity();
    </script>
@endsection