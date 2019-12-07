@extends('dashboard::layouts.main')


@section('title')
    Edit "{{ $role->display_name }}"
@endsection


@section('content')


    <div class="row">
        <div class="col-md-12">
            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('roles.update', ['id' => $role->id ]) }}">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group m-form__group row">
                            <label for="example-text-input" class="col-2 col-form-label">
                                Name
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $role->name }}" id="name" name="name">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="example-text-input" class="col-2 col-form-label">
                                Display Name
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $role->display_name }}" id="display_name" name="display_name">
                            </div>
                        </div>

                        @include('dashboard::components.editor', ['name' => 'description', 'old_value' => $role->description])


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
                                                                                           @if($role->hasPermission($key['name'])) checked @endif>
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


                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection