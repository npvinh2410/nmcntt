@extends('dashboard::layouts.main')


@section('title')
    Edit user "{{ $user->name }}"
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('admins.update', ['id' =>$user->id]) }}">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group m-form__group @if ($errors->has('name')) has-danger @endif row">
                            <label for="name" class="col-2 col-form-label">
                                Name
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $user->admin->name }}" id="name" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('email')) has-danger @endif row">
                            <label for="email" class="col-2 col-form-label">
                                Email
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="email" value="{{ $user->email }}" id="email" name="email" required>
                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if(hydrogen_authorize('admins-edit', true))
                            <div class="form-group m-form__group row">
                                <label for="role" class="col-2 col-form-label">
                                    Role
                                </label>
                                <div class="col-10">
                                    <select class="form-control m-input m-input--air" id="role" name="role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @if($user->roles[0]->id == $role->id) selected @endif>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="m-form__seperator m-form__seperator--dashed"></div>
                        <div class="form-group m-form__group row">
                            <span class="m-form__help">
                                Enter only if you want to change the password
                            </span>
                        </div>
                        <div class="form-group m-form__group @if ($errors->has('password')) has-danger @endif row">
                            <label for="password" class="col-2 col-form-label">
                                Password
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="password" id="password" name="password">
                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('password_confirmation')) has-danger @endif row">
                            <label for="password_confirmation" class="col-2 col-form-label">
                                Confirm Password
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="password" id="password_confirmation" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if(hydrogen_authorize('admins-edit', true))
                            <div class="m-form__seperator m-form__seperator--dashed"></div>
                            <div class="m-form__group form-group row">
                                <div class="col-2 col-form-label" style="text-align: right">
                                    Disable
                                </div>
                                <div class="col-10">
                                    <div class="m-checkbox-list">
                                        <label class="m-checkbox m-checkbox--state-brand">
                                            <input type="checkbox" name="deactivate" id="deactivate" @unless($user->status) checked @endunless >
                                            Tick this box to deactivate this account and prevent login
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="m-form__seperator m-form__seperator--dashed"></div>
                        <div class="form-group m-form__group row">
                            <span class="m-form__help">
                                Please confirm your admin password to add or make changes to administrator account details
                            </span>
                        </div>
                        <div class="form-group m-form__group @if ($errors->has('current_password')) has-danger @endif row">
                            <label for="password_confirmation" class="col-2 col-form-label">
                                Current Password
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="password" id="current_password" name="current_password" required>
                                @if ($errors->has('current_password'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('current_password') }}
                                    </div>
                                @endif
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
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
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