@extends('dashboard::layouts.main')

@section('title')
    {{ $attribute->translate($lang_code)->the_name() }}
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
                                Details
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Name:
                        </h3>
                        <div class="m-section__content">
                            {{ $attribute->translate($lang_code)->the_name() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Type:
                        </h3>
                        <div class="m-section__content">
                            {{ $attribute->the_type() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Value:
                        </h3>
                        <div class="m-section__content">
                            <ul>
                                @foreach($attribute->values as $value)
                                    <li>{{ $value->the_value() }}</li>
                                @endforeach
                            </ul>
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
                                More Info
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
                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('attributes-edit',true))<a href="{{ route('attributes.edit', ['id' => $attribute->id, 'lang_code' => $lang_code]) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('attributes-index', true))<a href="{{ route('attributes.index') }}" class="btn btn-brand">Back</a>@endif
                </div>
            </div>

        </div>
    </div>
@endsection