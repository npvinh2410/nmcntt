@extends('dashboard::layouts.main')

@section('title')
    Create new Seo
@endsection

@section('content')
    <form action="{{ route('seoUpdate.update', ['id' => $seo->id]) }}" method="POST">
        {{ csrf_field() }}
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="url" class="col-2 col-form-label">
                        Url:
                    </label>
                    <div class="col-10">
                        <input class="form-control m-input" type="text" value="{{ $seo->url }}" id="url" name="url" required>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="title" class="col-2 col-form-label">
                        Title:
                    </label>
                    <div class="col-10">
                        <textarea class="form-control m-input m-input--air" id="title" name="title" rows="3">{{ $seo->title }}</textarea>
                        <p id="counter_seo_title">
                            Words: <span id="title_w">0</span>, Characters: <span id="title_c">0</span>
                        </p>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="name" class="col-2 col-form-label">
                        Description:
                    </label>
                    <div class="col-10">
                        <textarea class="form-control m-input m-input--air" id="description" name="description" rows="3">{{ $seo->description }}</textarea>
                        <p id="counter_seo_description">
                            Words: <span id="description_w">0</span>, Characters: <span id="description_c">0</span>
                        </p>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="name" class="col-2 col-form-label">
                        Keywords:
                    </label>
                    <div class="col-10">
                        <textarea class="form-control m-input m-input--air" id="keywords" name="keywords" rows="3">{{ $seo->keywords }}</textarea>
                        <p id="counter_seo_keywords">
                            Words: <span id="keywords_w">0</span>, Characters: <span id="keywords_c">0</span>
                        </p>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="canonical" class="col-2 col-form-label">
                        Canonical:
                    </label>
                    <div class="col-10">
                        <textarea class="form-control m-input m-input--air" id="canonical" name="canonical" rows="3">{{ $seo->canonical }}</textarea>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                    </label>
                    <div class="col-10">
                        <button class="btn btn-brand">Submit</button>
                    </div>
                </div>

            </div>
        </div>

    </form>



@endsection

@section('custom_js')
    <script type="text/javascript">
        $(document).ready(function() {

            function countc(str) {
                return str.length;
            }

            function countw(str) {
                if (str === '') {
                    return 0;
                }
                var words = str.split(' ');
                return words.length;
            }

            function counter(id) {
                var inp = "#" + id;
                var out_c = "#" + id + "_c";
                var out_w = "#" + id + "_w";

                var content = $(inp).val().trim()
                var c = countc(content);
                var w = countw(content);

                $(out_c).text(c);
                $(out_w).text(w);

            }
            counter('title');
            counter('description');
            counter('keywords');
            $( "#title" ).keyup(function() {
                counter('title');
            });
            $( "#description" ).keyup(function() {
                counter('description');
            });
            $( "#keywords" ).keyup(function() {
                counter('keywords');
            });

        });

    </script>
@endsection