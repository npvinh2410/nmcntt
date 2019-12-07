@extends('dashboard::layouts.main')

@section('title')
    Edit "{{ $permission->display_name }}"
@endsection

@section('content')


<div class="row">
    <div class="col-md-12">
        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('permissions.update', ['id' => $permission->id]) }}">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">
                            Name
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" value="{{ $permission->name }}" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">
                            Display Name
                        </label>
                        <div class="col-10">
                            <input class="form-control m-input" type="text" value="{{ $permission->display_name }}" id="display_name" name="display_name">
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label for="example-text-input" class="col-2 col-form-label">
                            Description
                        </label>
                        <div class="col-10">
                            <textarea name="description" id="description" class="_ckeditor">{!! $permission->description !!}</textarea>
                        </div>
                    </div>
                </div>


                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                                <a href="{{ route('permissions.show', ['id' => $permission->id]) }}" class="btn btn-primary">
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