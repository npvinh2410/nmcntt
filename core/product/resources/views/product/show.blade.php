@extends('dashboard::layouts.main')

@section('title')
    {{ $product->translate($lang_code)->the_title() }}
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
                                Product Info
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Name
                                </h3>
                                <div class="m-section__content">
                                    {{ $product->translate($lang_code)->the_title() }}
                                </div>
                            </div>

                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Slug
                                </h3>
                                <div class="m-section__content">
                                    {{ $product->translate($lang_code)->the_slug() }}
                                </div>
                            </div>

                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Preview
                                </h3>
                                <div class="m-section__content">
                                    <a href="{{ url('/') }}/{{$product->translate($lang_code)->the_slug()}}" target="_blank">{{ $product->translate($lang_code)->the_title() }}</a>
                                </div>
                            </div>

                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Description
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->translate($lang_code)->the_excerpt() !!}
                                </div>
                            </div>

                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Sku
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->the_sku() !!}
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Stock
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->the_stock() !!}
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Price
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->translate($lang_code)->the_price() !!}
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Price on sale
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->translate($lang_code)->the_price_on_sale() !!}
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    Discount
                                </h3>
                                <div class="m-section__content">
                                    {!! $product->translate($lang_code)->the_discount() !!}
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="m-section">
                                <h3 class="m-section__heading">
                                    VAT
                                </h3>
                                <div class="m-section__content">
                                    @if($product->tax)
                                        {!! $product->tax->the_value() !!}%
                                    @endif
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed"></div>
                        </div>

                        @if(get_setting('shop') == 'on')
                            <div class="col-md-6">
                                <div class="m-section">
                                    <h3 class="m-section__heading">
                                        Attributes
                                    </h3>
                                    <div class="m-section__content">
                                        <div class="row">
                                            @foreach(get_attribute_value($product->translate($lang_code)->attributes) as $item)
                                                <div class="attr-item col-md-6">
                                                    <div><strong>Name:</strong> {{ $item['attribute']->translate($lang_code)->the_name() }}</div>
                                                    <div><strong>Type:</strong> {{ $item['attribute']->the_type() }}</div>
                                                    <div>
                                                        <strong>Value:</strong>
                                                        <ul>
                                                            @foreach($item['attributeValue'] as $value)
                                                                <li>{{ $value->the_value() }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="m-separator m-separator--dashed"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="m-separator m-separator--dashed"></div>
                            </div>
                        @endif
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
                            <textarea class="form-control m-input m-input--air" id="seo_title" name="seo_title" rows="3" disabled>{{ $product->seos($lang_code)->the_title() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_description" class="col-2 col-form-label">
                            Description:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_description" name="seo_description" rows="3" disabled>{{ $product->seos($lang_code)->the_description() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_keywords" class="col-2 col-form-label">
                            Keywords:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_keywords" name="seo_keywords" rows="3" disabled>{{ $product->seos($lang_code)->the_keywords() }}</textarea>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="seo_custom" class="col-2 col-form-label">
                            Canonical:
                        </label>
                        <div class="col-10">
                            <textarea class="form-control m-input m-input--air" id="seo_canonical" name="seo_canonical" rows="3" disabled>{{ $product->seos($lang_code)->the_canonical() }}</textarea>
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
                                Page Info
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
                            {{ get_template_name($product->the_template(), 'product') }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Status
                        </h3>
                        <div class="m-section__content">
                            @if($product->translate($lang_code)->the_status())
                                <span style="width: 132px;"><span class="m-badge  m-badge--info m-badge--wide">Publish</span></span>
                            @else
                                <span style="width: 132px;"><span class="m-badge  m-badge--danger m-badge--wide">Draft</span></span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('products-edit', true))<a href="{{ route('products.edit', ['id' => $product->id, 'lang_code' => $lang_code]) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('products-index', true))<a href="{{ route('products.index') }}" class="btn btn-brand">Back</a>@endif
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
                    @if($product->the_thumbnail())
                        <img src="{{ $product->the_thumbnail() }}" alt="featured image">
                    @else
                        <img src="{{ asset('backend/images/misc/placeholder.png') }}" alt="featured image">
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
                                Library Image
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body row">
                    <div class="product-meida">
                        <ul id="product_images_ul">
                            @foreach($product->images as $image)
                                <li>
                                    <img src="{{ $image->the_img() }}">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection