@extends('dashboard::layouts.main')

@section('title')
    {{ $category->translate(get_default_lang_code())->the_title() }} ({{ $lang_code }})
@endsection

@section('content')
    <form action="{{ route('categories.storeTrans', ['id' => $category->id]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="lang_code" value="{{ $lang_code }}">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row {{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label for="title" class="col-2 col-form-label">
                                Title (*):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('title') }}" id="title" name="title" required>
                                @if ($errors->has('title'))
                                    <div class="form-control-feedback">
                                        <strong>Title existed</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="slug" class="col-2 col-form-label">
                                Slug (*):
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
                                <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_description" class="col-2 col-form-label">
                                Description:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3"></textarea>
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

    <script type="text/javascript">



        // $("#slug").blur(function() {
        //     var slug = $("#slug").val();
        //
        //     $.ajaxSetup({
        //         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
        //     });
        //
        //     console.log(slug);
        //
        //     $.ajax({
        //         type: "POST",
        //         url: "/dashboard/check_slug",
        //         data: {
        //             slug:slug
        //         },
        //
        //         success: function (data) {
        //             if(data == 0)
        //             {
        //                 $('.form-control-feedback').text('slug này đã tồn tại !!!')
        //             }
        //             else
        //             {
        //                 $('.form-control-feedback').text('slug hợp lệ !!!')
        //             }
        //         }
        //     });
        // });
    </script>
@endsection