@extends('dashboard::layouts.main')


@section('title')
    Create new client user
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('clients.store') }}">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        {{ csrf_field() }}

                        <div class="form-group m-form__group @if ($errors->has('name')) has-danger @endif row">
                            <label for="name" class="col-2 col-form-label">
                                Name (*)
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('name') }}" id="name" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('email')) has-danger @endif row">
                            <label for="email" class="col-2 col-form-label">
                                Email (*)
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="email" value="{{ old('email') }}" id="email" name="email" required>
                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('phone')) has-danger @endif row">
                            <label for="phone" class="col-2 col-form-label">
                                Phone (*)
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('phone') }}" id="phone" name="phone" required>
                                @if ($errors->has('phone'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('address')) has-danger @endif row">
                            <label for="phone" class="col-2 col-form-label">
                                Address
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('address') }}" id="address" name="address">
                                @if ($errors->has('address'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('password')) has-danger @endif row">
                            <label for="password" class="col-2 col-form-label">
                                Password (*)
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="password" id="password" name="password" required>
                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group @if ($errors->has('password_confirmation')) has-danger @endif row">
                            <label for="password_confirmation" class="col-2 col-form-label">
                                Confirm Password (*)
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="password" id="password_confirmation" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password_confirmation') }}
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