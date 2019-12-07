@extends('dashboard::layouts.main')

@section('title')
    Create new Tax
@endsection

@section('content')
    <form action="{{ route('taxes.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row {{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label for="name" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('name') }}" id="name" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        <strong>Tax name existed</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="value" class="col-2 col-form-label">
                                Value (%):
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="number" value="{{ old('value') }}" id="value" name="value" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>


                        <div class="form-group m-form__group row">
                            <label for="slug" class="col-2 col-form-label">
                            </label>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </form>
@endsection

@section('custom_js')
@endsection