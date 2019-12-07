@extends('dashboard::layouts.main')

@section('title')
    {{ $catalog->translate($lang_code)->the_title() }}
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
                                Details
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Title
                        </h3>
                        <div class="m-section__content">
                            {{ $catalog->translate($lang_code)->the_title() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Slug
                        </h3>
                        <div class="m-section__content">
                            {{ $catalog->translate($lang_code)->the_slug() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Excerpt
                        </h3>
                        <div class="m-section__content">
                            {!! $catalog->translate($lang_code)->the_excerpt() !!}
                        </div>
                    </div>

                </div>
            </div>

            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                SEO
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label for="seo_title" class="col-2 col-form-label">
                            Title:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3" disabled>{{ $catalog->seos($lang_code)->the_title() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_description" class="col-2 col-form-label">
                            Description:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3" disabled>{{ $catalog->seos($lang_code)->the_description() }}</textarea>
                        </div>
                    </div>

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
                                More Info
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Language
                        </h3>
                        <div class="m-section__content">
                            {{ get_lang_name($lang_code) }}
                        </div>
                    </div>

                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Parent
                        </h3>
                        <div class="m-section__content">
                            @if ($catalog->parent)
                                {{ $catalog->parent->translate($lang_code)->the_title() }}
                            @else
                                None
                            @endif
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('catalogs-edit',true))<a href="{{ route('catalogs.edit', ['id' => $catalog->id, 'lang_code' => $lang_code]) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('catalogs-index', true))<a href="{{ route('catalogs.index') }}" class="btn btn-brand">Back</a>@endif
                </div>
            </div>

        </div>
    </div>
@endsection