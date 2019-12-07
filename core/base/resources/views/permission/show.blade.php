@extends('dashboard::layouts.main')

@section('title')
    {{  $permission->name }}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">

                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Name
                        </h3>
                        <div class="m-section__content">
                            {!! $permission->name !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Display name
                        </h3>
                        <div class="m-section__content">
                            {!! $permission->display_name !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Description
                        </h3>
                        <div class="m-section__content">
                            {!! $permission->description !!}
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            @if(hydrogen_authorize('permissions-index', true))
                                <a href="{{ route('permissions.index') }}" class="btn btn-brand">Back</a>
                            @endif
                            @if(hydrogen_authorize('permissions-edit', true))
                                <a href="{{ route('permissions.edit', ['id' => $permission->id]) }}" class="btn btn-success">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection