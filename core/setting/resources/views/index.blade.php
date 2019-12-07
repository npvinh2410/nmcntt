@extends('dashboard::layouts.main')

@section('title')
    Settings
@endsection


@section('content')
    <div class="m-portlet m-portlet--tabs">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#general" role="tab">
                            <i class="flaticon-settings"></i>
                            General
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#languages" role="tab">
                            <i class="flaticon-comment"></i>
                            Languages
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#posts" role="tab">
                            <i class="flaticon-book"></i>
                            Posts
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#products" role="tab">
                            <i class="flaticon-confetti"></i>
                            Products
                        </a>
                    </li>

                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#script" role="tab">
                            <i class="flaticon-more-v4"></i>
                            Script
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="general" role="tabpanel">

                    <div class="form-group m-form__group row">
                        <label for="site_name" class="col-2 col-form-label">
                            Site Name:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" @if(isset($settings['site_name'])) value="{{ $settings['site_name'] }}" @endif id="site_name" name="site_name">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="page_title" class="col-2 col-form-label">
                            HomePage Title:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" @if(isset($settings['page_title'])) value="{{ $settings['page_title'] }}" @endif id="page_title" name="page_title">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="page_description" class="col-2 col-form-label">
                            HomePage Description:
                        </label>
                        <div class="col-10">
                            <textarea name="page_description" id="page_description" class="form-control m-input" rows="3">@if(isset($settings['page_description'])){{ $settings['page_description'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="page_keyword" class="col-2 col-form-label">
                            HomePage Keyword:
                        </label>
                        <div class="col-10">
                            <textarea name="page_keyword" id="page_keyword" class="form-control m-input" rows="3">@if(isset($settings['page_keyword'])){{ $settings['page_keyword'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="email" class="col-2 col-form-label">
                            Main Email:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="email" @if(isset($settings['email'])) value="{{ $settings['email'] }}" @endif id="email" name="email">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="hotline" class="col-2 col-form-label">
                            Main Hotline:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" @if(isset($settings['hotline'])) value="{{ $settings['hotline'] }}" @endif id="hotline" name="hotline">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="bank_info" class="col-2 col-form-label">
                            Bank Info:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input" rows="3" name="bank_info" id="bank_info" >@if(isset($settings['bank_info'])){{ $settings['bank_info'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-brand" onclick="updateGeneral()">
                            Submit
                        </button>
                    </div>

                </div>

                <div class="tab-pane" id="languages" role="tabpanel">
                    <div class="m-form__group form-group row">
                        <label class="col-2 col-form-label">
                            Multi Language :
                        </label>
                        <div class="col-10">
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" @if(isset($settings['multi_lang']) && $settings['multi_lang'] == "on") checked="checked" @endif id="multi_lang" name="multi_lang">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-brand" onclick="updateLang()">
                            Submit
                        </button>
                    </div>
                </div>

                <div class="tab-pane" id="posts" role="tabpanel">

                    <div class="form-group m-form__group row">
                        <label for="post_per_page" class="col-2 col-form-label">
                            Post per page:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="number" @if(isset($settings['post_per_page'])) value="{{ $settings['post_per_page'] }}" @endif id="post_per_page" name="post_per_page">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="post_character" class="col-2 col-form-label">
                            Number character of post description:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="number" @if(isset($settings['post_character'])) value="{{ $settings['post_character'] }}" @endif id="post_character" name="post_character">
                        </div>
                    </div>

                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-brand" onclick="updatePost()">
                            Submit
                        </button>
                    </div>

                </div>

                <div class="tab-pane" id="products" role="tabpanel">

                    <div class="form-group m-form__group row">
                        <label for="product_per_page" class="col-2 col-form-label">
                            Product per page:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="number" @if(isset($settings['product_per_page'])) value="{{ $settings['product_per_page'] }}" @endif id="product_per_page" name="product_per_page">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="product_character" class="col-2 col-form-label">
                            Number character of Product description:
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="number" @if(isset($settings['product_character'])) value="{{ $settings['product_character'] }}" @endif id="product_character" name="product_character">
                        </div>
                    </div>

                    <div class="m-form__group form-group row">
                        <label class="col-2 col-form-label">
                            Red Bill:
                        </label>
                        <div class="col-10">
                            <span class="m-switch m-switch--icon">
                                <label>
                                    <input type="checkbox" @if(isset($settings['red_bill']) && $settings['red_bill'] == "on") checked="checked" @endif id="red_bill" name="red_bill">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>

                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-brand" onclick="updateProduct()">
                            Submit
                        </button>
                    </div>

                </div>

                <div class="tab-pane" id="script" role="tabpanel">

                    <div class="form-group m-form__group row">
                        <label for="end_of_head" class="col-2 col-form-label">
                            End of tag "Head":
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input" rows="3" name="end_of_head" id="end_of_head" >@if(isset($settings['end_of_head'])){{ $settings['end_of_head'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="begin_of_body" class="col-2 col-form-label">
                            Begin of tag "body":
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input" rows="3" name="begin_of_body" id="begin_of_body" >@if(isset($settings['begin_of_body'])){{ $settings['begin_of_body'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="end_of_body" class="col-2 col-form-label">
                            End of tag "body":
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input" rows="3" name="end_of_body" id="end_of_body" >@if(isset($settings['end_of_body'])){{ $settings['end_of_body'] }}@endif</textarea>
                        </div>
                    </div>

                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-brand" onclick="updateScript()">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script>
        var url = '{{ route('settings.update') }}';
        var csrf = '{{ csrf_token() }}';

        function updateGeneral()
        {
            var site_name = {
                "key": "site_name",
                "value": $("#site_name").val(),
                "_token": csrf
            };

            var page_title = {
                "key": "page_title",
                "value": $("#page_title").val(),
                "_token": csrf
            };

            var page_description = {
                "key": "page_description",
                "value": $("#page_description").val(),
                "_token": csrf
            };

            var page_keyword = {
                "key": "page_keyword",
                "value": $("#page_keyword").val(),
                "_token": csrf
            };

            var email = {
                "key": "email",
                "value": $("#email").val(),
                "_token": csrf
            };

            var hotline = {
                "key": "hotline",
                "value": $("#hotline").val(),
                "_token": csrf
            };

            var bank_info = {
                "key": "bank_info",
                "value": $("#bank_info").val(),
                "_token": csrf
            };

            $.post(url, site_name).fail(function() {
                console.log( "error" );
            });

            $.post(url, page_title).fail(function() {
                console.log( "error" );
            });

            $.post(url, page_description).fail(function() {
                console.log( "error" );
            });

            $.post(url, page_keyword).fail(function() {
                console.log( "error" );
            });

            $.post(url, email).fail(function() {
                console.log( "error" );
            });

            $.post(url, hotline).fail(function() {
                console.log( "error" );
            });

            $.post(url, bank_info).fail(function() {
                console.log( "error" );
            });

            alert('cập nhập thành công');
        }


        function updatePost()
        {
            var post_per_page = {
                "key": "post_per_page",
                "value": $("#post_per_page").val(),
                "_token": csrf
            };

            var post_character = {
                "key": "post_character",
                "value": $("#post_character").val(),
                "_token": csrf
            };


            $.post(url, post_per_page).fail(function() {
                console.log( "error" );
            });

            $.post(url, post_character).fail(function() {
                console.log( "error" );
            });


            alert('cập nhập thành công');
        }

        function updateProduct()
        {
            var product_character = {
                "key": "product_character",
                "value": $("#product_character").val(),
                "_token": csrf
            };

            $.post(url, product_character).fail(function() {
                console.log( "error" );
            });

            var product_per_page = {
                "key": "product_per_page",
                "value": $("#product_per_page").val(),
                "_token": csrf
            };

            if($("#red_bill").is(':checked'))
            {
                var red_bill = {
                    "key": "red_bill",
                    "value": 'on',
                    "_token": csrf
                };
            }
            else
            {
                var red_bill = {
                    "key": "red_bill",
                    "value": 'off',
                    "_token": csrf
                };
            }

            $.post(url, product_per_page).fail(function() {
                console.log( "error" );
            });

            $.post(url, red_bill).fail(function() {
                console.log( "error" );
            });


            alert('cập nhập thành công');
        }

        function updateScript()
        {
            var end_of_head = {
                "key": "end_of_head",
                "value": $("#end_of_head").val(),
                "_token": csrf
            };

            var begin_of_body = {
                "key": "begin_of_body",
                "value": $("#begin_of_body").val(),
                "_token": csrf
            };

            var end_of_body = {
                "key": "end_of_body",
                "value": $("#end_of_body").val(),
                "_token": csrf
            };

            $.post(url, end_of_head).fail(function() {
                console.log( "error" );
            });

            $.post(url, begin_of_body).fail(function() {
                console.log( "error" );
            });

            $.post(url, end_of_body).fail(function() {
                console.log( "error" );
            });


            alert('cập nhập thành công');
        }

        function updateLang()
        {

            if($("#multi_lang").is(':checked'))
            {
                var multi_lang = {
                    "key": "multi_lang",
                    "value": 'on',
                    "_token": csrf
                };
            }
            else
            {
                var multi_lang = {
                    "key": "multi_lang",
                    "value": 'off',
                    "_token": csrf
                };
            }

            $.post(url, multi_lang).fail(function() {
                console.log( "error" );
            });


            alert('cập nhập thành công');
        }
    </script>
@endsection
