@extends('dashboard::layouts.main')

@section('title')
    New user role.
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('roles.store') }}">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    {{ csrf_field() }}

                    <div class="form-group m-form__group  @if ($errors->has('name')) has-danger @endif row">
                        <label for="name" class="col-2 col-form-label">
                            Name
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" value="{{ old('name') }}" id="name" name="name">
                            @if ($errors->has('name'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group m-form__group @if ($errors->has('display_name')) has-danger @endif  row">
                        <label for="display_name" class="col-2 col-form-label">
                            Display Name
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" value="{{ old('display_name') }}" id="display_name" name="display_name">
                            @if ($errors->has('password_confirmation'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    @include('dashboard::components.editor', ['name' => 'description', 'rl_value' => old('description')])

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
                                                                                    <input type="checkbox" value="{{ $key['id'] }}" name="permissions[]">
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