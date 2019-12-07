@extends('dashboard::layouts.main')

@section('title')
    Edit attribute "{{ $attribute->translate($lang_code)->the_name() }}"
@endsection

@section('content')
    <form action="{{ route('attributes.update', ['id' => $attribute->id, 'lang_code' => $lang_code]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="title" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ $attribute->translate($lang_code)->the_name() }}" id="title" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        <strong>Name existed</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($lang_code == get_default_lang_code())
                            <div class="form-group m-form__group row {{ $errors->has('type') ? ' has-danger' : '' }}">
                                <label for="title" class="col-2 col-form-label">
                                    Type:
                                </label>
                                <div class="col-10">
                                    <select class="form-control m-input" id="type" name="type">
                                        <option value="checkbox" @if($attribute->the_type() == 'checkbox') selected @endif>Checkbox</option>
                                        <option value="select" @if($attribute->the_type() == 'select') selected @endif>Select</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group m-form__group row">
                                <label for="title" class="col-2 col-form-label">
                                    Value:
                                </label>
                                <div class="col-10">
                                    <div class="attr_value">
                                        @foreach($attribute->values as $key => $value)
                                            <div id="attribute_value-{{$key}}" style="margin-bottom: 10px">
                                                <input class="form-control m-input custom-input" type="text" value="{{ $value->the_value() }}" name="attribute_value[]">
                                                <a href="javascript:void(0)" class="btn btn-link" onclick="delete_item({{$key}})"> Xóa</a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="btn btn-info" style="margin-top: 10px" onclick="add_new_value()"> Thêm giá trị</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-md-3">
                <div class="m-portlet">
                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('custom_js')
    <script type="text/javascript">
        function add_new_value()
        {
            var id = Date.now();

            var tpl = '<div id="attribute_value-'+id+'" style="margin-bottom: 10px">' +
                '<input class="form-control m-input custom-input" type="text" name="attribute_value[]">' +
                '<a href="javascript:void(0)" class="btn btn-link" onclick="delete_item('+id+')"> Xóa</a>' +
                '</div>';

            $('.attr_value').append(tpl);
        }

        function delete_item(id)
        {
            $('#attribute_value-'+id).remove();
        }
    </script>
@endsection