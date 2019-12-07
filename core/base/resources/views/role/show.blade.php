@extends('dashboard::layouts.main')

@section('title')
    Role "{{ $role->display_name }}"
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
                            {!! $role->name !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Display Name
                        </h3>
                        <div class="m-section__content">
                            {!! $role->display_name !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Description
                        </h3>
                        <div class="m-section__content">
                            {!! $role->description !!}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>


                    <div class="m-section">
                        <span class="m-section__sub">Permissions:</span>
                        <div class="m-section__content">
                            <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                <div class="m-demo__preview">
                                    <div class="m-form__group form-group m-checkbox-list row">
                                        @foreach($permissions as $permission => $keys)

                                            <div class="col-6">
                                                <div class="m-section">
                                                    <span class="m-section__sub">
                                                        {{ $permission }}
                                                    </span>
                                                    <div class="m-section__content">
                                                        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
                                                            <div class="m-demo__preview">
                                                                @foreach($keys as $key)
                                                                    <div class="form-group row">
                                                                        <label class="col-6 col-form-label">
                                                                            {{ $key['display-name'] }}
                                                                        </label>
                                                                        <div class="col-3">
                                                                            <span class="m-switch">
                                                                                <label>
                                                                                    <input type="checkbox" value="{{ $key['id'] }}" name="permissions[]"
                                                                                           @if($role->hasPermission($key['name'])) checked @endif disabled>
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            @permission('roles-index')<a href="{{ route('roles.index') }}" class="btn btn-brand">Back</a>@endpermission
                            @permission('roles-edit')<a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-success">Edit</a>@endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection