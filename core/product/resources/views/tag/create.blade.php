@extends('dashboard::layouts.main')

@section('title')
    Create new tag
@endsection

@section('content')
    <form action="{{ route('tags.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label for="title" class="col-2 col-form-label">
                                Title:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('title') }}" id="title" name="title" required>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="slug" class="col-2 col-form-label">
                                Slug:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('slug') }}" id="slug" name="slug" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>

                        @include('dashboard::components.editor', ['name' => 'excerpt', 'rl_value' => old('excerpt')])

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
                                <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3">{{ old('seo_title') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_description" class="col-2 col-form-label">
                                Description:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3">{{ old('seo_description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-3">
                <div class="m-portlet">
                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('custom_js')
@endsection