@extends('dashboard::layouts.main')

@section('title')
    {{ $post->translate($lang_code)->the_title() }}
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
                                Post Content
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
                            {{ $post->translate($lang_code)->the_title() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Slug
                        </h3>
                        <div class="m-section__content">
                            {{ $post->translate($lang_code)->the_slug() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Preview
                        </h3>
                        <div class="m-section__content">
                            <a href="{{ $post->translate($lang_code)->the_slug() }}" target="_blank">{{ $post->translate($lang_code)->the_title() }}</a>
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Categories
                        </h3>
                        <div class="m-section__content">
                            @foreach($post->categories as $category)
                                <p>{{ $category->translate(get_default_lang_code())->title }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>


                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Content
                        </h3>
                        <div class="m-section__content">
                            {!! $post->translate($lang_code)->the_content() !!}
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
                            <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3" disabled>{{ $post->seos($lang_code)->the_title() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_description" class="col-2 col-form-label">
                            Description:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3" disabled>{{ $post->seos($lang_code)->the_description() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_keywords" class="col-2 col-form-label">
                            Keywords:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_keywords" name="seo_keywords" rows="3" disabled>{{ $post->seos($lang_code)->the_keywords() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_custom" class="col-2 col-form-label">
                            Canonical:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_canonical" name="seo_canonical" rows="3" disabled>{{ $post->seos($lang_code)->the_canonical() }}</textarea>
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
                                Post Info
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
                            Template:
                        </h3>
                        <div class="m-section__content">
                            {{ get_template_name($post->template, 'post') }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Status
                        </h3>
                        <div class="m-section__content">
                            @if($post->translate($lang_code)->the_status())
                                <span style="width: 132px;"><span class="m-badge  m-badge--info m-badge--wide">Publish</span></span>
                            @else
                                <span style="width: 132px;"><span class="m-badge  m-badge--danger m-badge--wide">Draft</span></span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('posts-edit', true))<a href="{{ route('posts.edit', ['id' => $post->id, 'lang_code' => $lang_code]) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('posts-index', true))<a href="{{ route('posts.index') }}" class="btn btn-brand">Back</a>@endif
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
                                Featured Image
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body hydrogen-page-preview">
                    @if($post->translate($lang_code)->the_thumbnail())
                        <img src="{{ $post->translate($lang_code)->the_thumbnail() }}" alt="featured image">
                    @else
                        <img src="{{ asset('backend/images/misc/placeholder.png') }}" alt="featured image">
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection