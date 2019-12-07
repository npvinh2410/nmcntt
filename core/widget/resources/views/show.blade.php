@extends('dashboard::layouts.main')

@section('title')
    {{  $widget->positions }}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">

                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Positions
                        </h3>
                        <div class="m-section__content">
                            {!! $widget->positions !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Languages
                        </h3>
                        <div class="m-section__content" >
                            {!! get_lang_name($lang_code) !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Content
                        </h3>
                        <div class="m-section__content" style="padding-bottom: 200px;">
                            {!! render_show_menu($widget->translate($lang_code)->content) !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                </div>
         </div>
        </div>
    </div>

@endsection