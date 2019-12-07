@extends('dashboard::layouts.main')

@section('title')
    {{ $menu->the_name() }}
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
                                Menu Content
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Name
                        </h3>
                        <div class="m-section__content">
                            {{ $menu->the_name() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Position
                        </h3>
                        <div class="m-section__content">
                            {{ $menu->the_position() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Structure
                        </h3>
                        <div class="m-section__content">
                            {!! render_show_menu($menu->data) !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

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
                                Menu Info
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot">
                    @if(hydrogen_authorize('menus-edit', true))<a href="{{ route('menus.edit', ['id' => $menu->id]) }}" class="btn btn-brand">Edit</a>@endif
                    @if(hydrogen_authorize('menus-index', true))<a href="{{ route('menus.index') }}" class="btn btn-brand">Back</a>@endif
                </div>
            </div>


        </div>
    </div>
@endsection