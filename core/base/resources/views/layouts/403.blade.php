@extends('dashboard::layouts.main')


@section('title')
    Permission Denied
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="m-grid__item m-grid__item--fluid m-grid hydrogen-permission-denied m-error-1" style="background-image: url('{{asset('backend/images/error/bg1.jpg')}}');">
                        <div class="m-error_container">
                            <span class="m-error_number">
                                <h1>
                                    403
                                </h1>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection