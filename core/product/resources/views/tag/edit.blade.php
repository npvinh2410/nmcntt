@extends('dashboard::layouts.main')

@section('title')
    Edit Tag "{{ $tag->translate($lang_code)->the_title() }}"
@endsection

@section('content')
    <form action="{{ route('tags.update', ['id' => $tag->id, 'lang_code' => $lang_code]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row {{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label for="title" class="col-2 col-form-label">
                                Title:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $tag->translate($lang_code)->the_title() }}" id="title" name="title" required>
                                @if ($errors->has('title'))
                                    <div class="form-control-feedback">
                                        <strong>Title existed</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="slug" class="col-2 col-form-label">
                                Slug:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $tag->translate($lang_code)->the_slug() }}" id="slug" name="slug" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="description">
                                Excerpt:
                            </label>
                            <div class="m--margin-bottom-15">
                                <button class="btn btn-primary btn_gallery_media" data-result="excerpt" data-multiple="true" data-action="media-insert-ckeditor">
                                    <i class="fa fa-picture-o"></i> Add media
                                </button>
                            </div>
                            <textarea name="excerpt" id="excerpt" class="_ckeditor">
                                {!! $tag->translate($lang_code)->the_excerpt() !!}
                            </textarea>
                        </div>
                    </div>
                </div>

                <div class="m-portlet m--margin-top-35">
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
                                <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3">{{ $tag->seos($lang_code)->the_title() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_description" class="col-2 col-form-label">
                                Description:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3">{{ $tag->seos($lang_code)->the_description() }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="m-portlet">
                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('custom_js')
@endsection