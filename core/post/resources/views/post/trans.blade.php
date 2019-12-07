@extends('dashboard::layouts.main')

@section('title')
    {{ $post->translate(get_default_lang_code())->the_title() }} ({{ $lang_code }})
@endsection

@section('content')
    <form action="{{ route('posts.storeTrans', ['id' => $post->id]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="lang_code" value="{{$lang_code}}">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">


                        <div class="form-group m-form__group row">
                            <label for="title" class="col-2 col-form-label">
                                Title (*):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('title') }}" id="title" name="title" required>
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
                        @include('dashboard::components.editor', ['name' => 'post_content', 'rl_value' => old('post_content')])

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

                        <div class="form-group m-form__group row">
                            <label for="seo_keywords" class="col-2 col-form-label">
                                Keywords:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_keywords" name="seo_keywords" rows="3">{{ old('seo_keywords') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_custom" class="col-2 col-form-label">
                                Canonical:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_canonical" name="seo_canonical" rows="3">{{ old('seo_canonical') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>



            </div>



            <div class="col-md-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        @if(hydrogen_authorize('posts-publish', true))
                            <div class="m-form__group form-group row">
                                <label class="col-6 col-form-label">
                                    Publish:
                                </label>
                                <div class="col-6">
                                    <span class="m-switch m-switch--icon">
                                        <label>
                                            <input type="checkbox" checked="checked" name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        @endif

                    </div>

                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
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
                                    Featured Image
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body row">
                        <input type="hidden" name="thumbnail" id="thumbnail">
                        <div class="hydrogen-page-preview m--margin-bottom-15">
                            <img src="{{ asset('backend/images/misc/placeholder.png') }}" id="thumbnail_preview">
                        </div>
                        <a href="javascript:void(0)" class="btn_gallery btn btn-link">Set featured image</a>
                        <a href="javascript:void(0)" class="btn_clear_gallery btn btn-link btn-link-remove hidden">Remove</a>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('custom_js')

    @include('dashboard::components.media')

    <script type="text/javascript">
        $(document).ready(function() {
            if (jQuery().rvMedia) {
                $('.btn_gallery').rvMedia({
                    multiple: false,
                    onSelectFiles: function (files, $el) {
                        var firstItem = _.first(files);
                        $('#thumbnail').val(firstItem.url);
                        $('#thumbnail_preview').attr("src",firstItem.url);

                        $('.btn_clear_gallery').removeClass('hidden');
                    }
                });
            }

            $('.btn_clear_gallery').click(function() {
                $('#thumbnail').val('');
                $('#thumbnail_preview').attr("src", 'backend/images/misc/placeholder.png');
                $(this).addClass('hidden');
            });


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
        });
    </script>
@endsection