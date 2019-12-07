@extends('dashboard::layouts.main')

@section('title')
    New user permission bundle.
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('permissions.store_bundle') }}">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    {{ csrf_field() }}

                    <div class="form-group m-form__group @if ($errors->has('name')) has-danger @endif row">
                        <label for="name" class="col-2 col-form-label">
                            Group Permission Name
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


                    <div class="form-group m-form__group @if ($errors->has('description')) has-danger @endif row">
                        <label for="description" class="col-2 col-form-label">
                            Description
                        </label>
                        <div class="col-10">
                            <textarea name="description" id="description" class="_ckeditor">{!! old('description') !!}</textarea>
                            @if ($errors->has('description'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('description') }}
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
                                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
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