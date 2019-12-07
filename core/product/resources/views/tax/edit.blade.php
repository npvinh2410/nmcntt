@extends('dashboard::layouts.main')

@section('title')
    Edit Tax "{{ $tax->the_name() }}"
@endsection

@section('content')
    <form action="{{ route('taxes.update', ['id' => $tax->id]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-12">
                <div class="m-portlet">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="name" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $tax->the_name() }}" id="name" name="name" required>
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
                                <input class="form-control m-input" type="text" value="{{ $tax->the_value() }}" id="value" name="value" required>
                                <div class="form-control-feedback" style="color: red"></div>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label for="value" class="col-2 col-form-label">
                            </label>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">
                                    Update
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