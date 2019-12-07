@extends('dashboard::layouts.main')

@section('title')
    {{ $seo->url }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">

            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Menu Content
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            URL
                        </h3>
                        <div class="m-section__content">
                            {{ $seo->url }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Title
                        </h3>
                        <div class="m-section__content">
                            {{ $seo->title }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Description
                        </h3>
                        <div class="m-section__content">
                            {{ $seo->description }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Keywords
                        </h3>
                        <div class="m-section__content">
                            {{ $seo->keywords }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Canonical
                        </h3>
                        <div class="m-section__content">
                            {{ $seo->canonical }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                </div>
            </div>


        </div>

        <div class="col-md-3">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Menu Info
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('seos-edit', true))<a href="{{ route('seoUpdate.edit', $seo) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('seos-index', true))<a href="{{ route('seoUpdate.index') }}" class="btn btn-brand">Back</a>@endif
                </div>
            </div>


        </div>
    </div>
@endsection