@extends('dashboard::layouts.main')

@section('title')
    {{ $product->translate(get_default_lang_code())->the_title() }} ({{ $lang_code }})
@endsection

@section('content')
    <form action="{{ route('products.storeTrans', ['id' => $product->id]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="lang_code" value="{{$lang_code}}">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label for="title" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('name') }}" id="name" name="name" required>
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

                        @include('dashboard::components.editor', ['name' => 'description', 'rl_value' => old('description')])

                        <div class="form-group m-form__group row">
                            <label for="price" class="col-2 col-form-label">
                                Price:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ old('price') }}" id="price" name="price" required>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="price_on_sale" class="col-2 col-form-label">
                                Price on sale:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ old('price_on_sale') }}" id="price_on_sale" name="price_on_sale">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="price_on_sale" class="col-2 col-form-label">
                                Discount (%):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ old('discount') }}" id="discount" name="discount">
                            </div>
                        </div>

                        @if(get_setting('shop') == 'on')
                            <div id="attr">
                                <div class="form-group  m-form__group row" id="attr">
                                    <label  class="col-lg-2 col-form-label">
                                        Attribute:
                                    </label>
                                    <div data-repeater-list="attr" class="col-lg-10">
                                        <div data-repeater-item class="form-group m-form__group row align-items-center">
                                            <div class="col-md-4">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label>
                                                            Name:
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-select2 attr-name" name="attr_name" onchange="loadAttributeValue($(this).attr('name'))">
                                                            <option disabled selected>Select a attribute</option>
                                                            @foreach($attributes as $attribute)
                                                                <option value="{{ $attribute->id }}">{{ $attribute->translate(get_default_lang_code())->the_name() }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            Value:
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-select2 attr-value" name="attr_value" multiple="multiple">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill">
                                                    <span>
                                                        <i class="la la-trash-o"></i>
                                                        <span>
                                                            Delete
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-lg-2 col-form-label"></label>
                                    <div class="col-lg-4">
                                        <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
                        @if(hydrogen_authorize('products-publish', true))
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
            </div>
        </div>

    </form>
@endsection

@section('custom_js')

    @include('dashboard::components.media')

    <script type="text/javascript" src="{{ asset('backend/js/jquery.repeater.min.js') }}"></script>



    <script type="text/javascript">

        var FormRepeater = function() {

            var attr = function() {
                $('#attr').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                        $(this).find('.attr-name').select2({
                            placeholder: "Select a attribute"
                        });

                        $(this).find('.attr-value').select2({
                            placeholder: "Select values"
                        });
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            };

            var attr_choose = function() {
                $('.attr-name').select2({
                    placeholder: "Select a attribute"
                });

                $('.attr-value').select2({
                    placeholder: "Select values",
                });
            };

            return {

                init: function() {
                    attr();
                    attr_choose();
                }
            };
        }();

        $(document).ready(function() {

            FormRepeater.init();


        });

        function loadAttributeValue(name)
        {
            var attr_id = $('select[name="'+name+'"]').val();

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $.ajax({
                type: "POST",
                url: "/dashboard/attributesValue",
                data: {
                    attr_id:attr_id
                },

                success: function (data)
                {
                    var html = '';

                    data.forEach(function (element) {
                        html = html + '<option value="'+element['id']+'">'+element['value']+'</option>';
                    });

                    $('select[name="'+name.replace('attr_name', 'attr_value')+'[]"]').html(html);
                }
            });
        }
    </script>
@endsection