@extends('dashboard::layouts.main')

@section('title')
    {{ $attribute->translate(get_default_lang_code())->the_name() }} ({{ $lang_code }})
@endsection

@section('content')
    <form action="{{ route('attributes.storeTrans', ['id' => $attribute->id]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="lang_code" value="{{ $lang_code }}">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="title" class="col-2 col-form-label">
                                Name:
                            </label>
                            <div class="col-10">
                                <input class="form-control m-input" type="text" value="{{ old('name') }}" id="title" name="name" required>
                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        <strong>Name existed</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
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