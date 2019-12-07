@extends('dashboard::layouts.main')

@section('title')
    Edit post "{{ $post->translate($lang_code)->the_title() }}"
@endsection

@section('content')
    <form action="{{ route('posts.update', ['id' => $post->id, 'lang_code' => $lang_code]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label for="title" class="col-2 col-form-label">
                                Title (*):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $post->translate($lang_code)->the_title() }}" id="title" name="title" required>
                            </div>
                        </div>

                        <div class="form-group m-form__group row ">
                            <label for="slug" class="col-2 col-form-label">
                                Slug (*):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $post->translate($lang_code)->the_slug() }}" id="slug" name="slug" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="excerpt">
                                Excerpt:
                            </label>
                            <div class="m--margin-bottom-15">
                                <button class="btn btn-primary btn_gallery_media" data-result="excerpt" data-multiple="true" data-action="media-insert-ckeditor">
                                    <i class="fa fa-picture-o"></i> Add media
                                </button>
                            </div>
                            <textarea name="excerpt" id="excerpt" class="_ckeditor">{!! $post->translate($lang_code)->the_excerpt() !!}</textarea>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="post_content">
                                Post Content (*):
                            </label>
                            <div class="m--margin-bottom-15">
                                <button class="btn btn-primary btn_gallery_media" data-result="post_content" data-multiple="true" data-action="media-insert-ckeditor">
                                    <i class="fa fa-picture-o"></i> Add media
                                </button>
                            </div>
                            <textarea name="post_content" id="post_content" class="_ckeditor">{!! $post->translate($lang_code)->the_content() !!}</textarea>
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
                                <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3">{{ $post->seos($lang_code)->the_title() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_description" class="col-2 col-form-label">
                                Description:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3">{{ $post->seos($lang_code)->the_description() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_keywords" class="col-2 col-form-label">
                                Keywords:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_keywords" name="seo_keywords" rows="3">{{ $post->seos($lang_code)->the_keywords() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_custom" class="col-2 col-form-label">
                                Canonical:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_canonical" name="seo_canonical" rows="3">{{ $post->seos($lang_code)->the_canonical() }}</textarea>
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
                                            <input type="checkbox" @if($post->translate($lang_code)->the_status()) checked="checked" @endif name="status">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        @endif



                        @if($lang_code == get_default_lang_code())
                            <div class="form-group m-form__group">
                                <label for="categories">
                                    Categories:
                                </label>
                                <input type="hidden" value="{{ $post->main_cat }}" id="main_cat" name="main_cat">
                                {!! render_cat('category', $post) !!}
                            </div>

                            <div class="m-separator m-separator--dashed"></div>

                            <div class="form-group m-form__group">
                                <label for="template">
                                    Template:
                                </label>
                                <select class="form-control m-input" id="template" name="template">
                                    @foreach(get_templates('post') as $tpl => $name)
                                        <option value="{{$tpl}}" @if($post->template == $tpl) selected
                                                @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                    </div>

                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Update
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
                        <input type="hidden" name="thumbnail" id="thumbnail" value="{{$post->translate($lang_code)->the_thumbnail()}}">
                        <div class="hydrogen-page-preview m--margin-bottom-15">
                            <img src="@if($post->translate($lang_code)->the_thumbnail()){{$post->translate($lang_code)->the_thumbnail()}}@else{{ asset('backend/images/misc/placeholder.png') }}@endif" id="thumbnail_preview">
                        </div>
                        <a href="javascript:void(0)" class="btn_gallery btn btn-link">Set featured image</a>
                        <a href="javascript:void(0)" class="btn_clear_gallery btn btn-link btn-link-remove @if(!$post->translate($lang_code)->the_thumbnail()) hidden @endif">Remove</a>
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