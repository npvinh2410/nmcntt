@extends('dashboard::layouts.main')

@section('title')
    Create new Sliders
@endsection

@section('content')
    <form action="{{ route('sliders.update', $slider) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="name" class="col-2 col-form-label">
                        Name:
                    </label>
                    <div class="col-10">
                        <input class="form-control m-input" type="text" value="{{ $slider->name }}" id="name" name="name" required>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="position" class="col-2 col-form-label">
                        Position:
                    </label>
                    <div class="col-10">
                        <select class="form-control m-input" id="position" name="position">
                            <option value="{{$slider->position}}">{{$slider->position}}</option>
                            @foreach(get_free_position('slider') as $position)
                                <option value="{{$position}}">{{$position}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                    </label>
                    <div class="col-10">
                        <button class="btn btn-brand">Submit</button>
                    </div>
                </div>

            </div>
        </div>

    </form>



@endsection

@section('custom_js')

@endsection