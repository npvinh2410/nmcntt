@extends('dashboard::layouts.main')

@section('title')
    Edit Product "{{ $product->translate($lang_code)->the_title() }}"
@endsection

@section('content')
    <form action="{{ route('products.update', ['id' => $product->id, 'lang_code' => $lang_code]) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label for="title" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $product->translate($lang_code)->the_title() }}" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="slug" class="col-2 col-form-label">
                                Slug:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $product->translate($lang_code)->the_slug() }}" id="slug" name="slug" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>

                        @include('dashboard::components.editor', ['name' => 'description', 'old_value' => $product->translate($lang_code)->the_excerpt()])

                        <div class="form-group m-form__group row">
                            <label for="price" class="col-2 col-form-label">
                                Price:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ $product->translate($lang_code)->the_price() }}" id="price" name="price" required>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="price_on_sale" class="col-2 col-form-label">
                                Price on sale:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ $product->translate($lang_code)->the_price_on_sale() }}" id="price_on_sale" name="price_on_sale">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="price_on_sale" class="col-2 col-form-label">
                                Discount (%):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ $product->translate($lang_code)->the_discount() }}" id="discount" name="discount">
                            </div>
                        </div>

                        @if($lang_code == get_default_lang_code())
                            <div class="form-group m-form__group row">
                                <label for="price_on_sale" class="col-2 col-form-label">
                                    Sku:
                                </label>
                                <div class="col-10">
                                    <input class="form-control m-input" type="text" value="{{ $product->the_sku() }}" id="sku" name="sku" required>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label for="price_on_sale" class="col-2 col-form-label">
                                    Stock:
                                </label>
                                <div class="col-10">
                                    <input class="form-control m-input" type="number" value="{{ $product->the_stock() }}" id="stock" name="stock" required>
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <label for="tax" class="col-2 col-form-label">
                                    Tax:
                                </label>
                                <div class="col-10">
                                    <select class="form-control m-input" id="tax" name="tax">
                                        <option value="0">None</option>
                                        @foreach($taxes as $tax)
                                            <option value="{{$tax->id}}" @if($product->tax_id == $tax->id) selected @endif>{{$tax->the_name()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if(get_setting('shop') == 'on')
                            <div id="attr">
                                <div class="form-group  m-form__group row" id="attr">
                                    <label  class="col-lg-2 col-form-label">
                                        Attribute:
                                    </label>
                                    <div data-repeater-list="attr" class="col-lg-10">
                                        @foreach(get_attribute_value($product->translate($lang_code)->attributes, true) as $item)
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
                                                                    <option value="{{ $attribute->id }}" @if($attribute->id == $item['attribute']->id) selected @endif>{{ $attribute->translate(get_default_lang_code())->the_name() }}</option>
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
                                                                @foreach($item['attribute']->values as $value)
                                                                    <option value="{{ $value->id }}" @if(in_array($value->id, $item['attributeValue'])) selected @endif>{{ $value->the_value() }}</option>
                                                                @endforeach
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
                                        @endforeach

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
                                <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3">{{ $product->seos($lang_code)->the_title() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_description" class="col-2 col-form-label">
                                Description:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3">{{ $product->seos($lang_code)->the_description() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_keywords" class="col-2 col-form-label">
                                Keywords:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_keywords" name="seo_keywords" rows="3">{{ $product->seos($lang_code)->the_keywords() }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="seo_custom" class="col-2 col-form-label">
                                Canonical:
                            </label>
                            <div class="col-10">
                                <textarea class="form-control m-input m-input--air" id="seo_canonical" name="seo_canonical" rows="3">{{ $product->seos($lang_code)->the_canonical() }}</textarea>
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
                                            <input type="checkbox" @if($product->translate($lang_code)->the_status()) checked="checked" @endif name="status">
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
                                    Catalog:
                                </label>
                                <input type="hidden" value="" id="main_cat" name="main_cat" required>
                                {!! render_cat('catalog', $product) !!}
                            </div>

                            <div class="m-separator m-separator--dashed"></div>
                            <div class="form-group m-form__group">
                                <label for="tags">
                                    Tags:
                                </label>
                                <select class="form-control m-select2" id="tags" name="tags" multiple="multiple">

                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $product->tags_id())) selected @endif>{{ $tag->translate(get_default_lang_code())->the_title() }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="m-separator m-separator--dashed"></div>

                            <div class="form-group m-form__group">
                                <label for="template">
                                    Template:
                                </label>
                                <select class="form-control m-input" id="template" name="template">
                                    @foreach(get_templates('product') as $tpl => $name)
                                        <option value="{{$tpl}}" @if($product->the_template() == $tpl) selected
                                                @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>

                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>

                @if($lang_code == get_default_lang_code())
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
                            <input type="hidden" name="thumbnail" id="thumbnail" value="{{$product->the_thumbnail()}}">
                            <div class="hydrogen-page-preview m--margin-bottom-15">
                                <img src="@if($product->the_thumbnail()){{$product->the_thumbnail()}}@else{{ asset('backend/images/misc/placeholder.png') }}@endif" id="thumbnail_preview">
                            </div>
                            <a href="javascript:void(0)" class="btn_gallery btn btn-link">Set featured image</a>
                            <a href="javascript:void(0)" class="btn_clear_gallery btn btn-link btn-link-remove @if(!$product->the_thumbnail()) hidden @endif">Remove</a>
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
                                        Library Image
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body row">
                            <div class="product-meida">
                                <ul id="product_images_ul">
                                    @foreach($product->images as $image)
                                        <li id="pm-{{$image->id}}">
                                            <a class="btn btn-link" onclick="remove_item({{$image->id}})">x</a>
                                            <img src="{{ $image->the_img() }}">
                                            <input type="hidden" name="product_images[]" value="{{ $image->the_img() }}">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <a href="javascript:void(0)" class="btn_gallery_mul btn btn-link">Set image</a>
                        </div>
                    </div>
                @endif
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

            $('#tags').select2({
                placeholder: "Select tags"
            });

        });

        function remove_item(id) {
            $("#pm-" + id).remove();
        }

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