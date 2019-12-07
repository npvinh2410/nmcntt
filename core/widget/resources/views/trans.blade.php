@extends('dashboard::layouts.main')

@section('title')
    {{ $widget->positions }} ({{ $lang_code }})
@endsection

@section('custom_css')
    <style>
        @media (min-width: 576px)
        {
            .modal-dialog {
                max-width: 700px;
                margin: 1.75rem auto;
            }
        }
    </style>
@endsection

@section('content')
    <form action="{{ route('widgets.storeTrans', ['id' => $widget]) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="lang_code" value="{{ $lang_code }}">
        <div class="row">
            <div class="col-md-9">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Widget Content
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">

                                <input type="hidden" id="update_widget_id">
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Title:
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control m-input" type="text" id="widget-title">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Content:
                                    </label>
                                    <div class="col-10">
                                        <div class="m--margin-bottom-15">
                                            <button class="btn btn-primary btn_gallery_media" data-result="widget-content" data-multiple="true" data-action="media-insert-ckeditor">
                                                <i class="fa fa-picture-o"></i> Add media
                                            </button>
                                        </div>
                                        <textarea id="widget-content" class="_ckeditor"></textarea>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-12" style="text-align: right">
                                        <a class="btn btn-success" onclick="update_widget()" id="add_widget">Update</a>
                                        <a class="btn btn-success" onclick="add_widget()" id="add_widget">Add</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="dd" id="nestable">
                                    <ol id="h-widget" class="dd-list">

                                    </ol>
                                </div>
                                <input type="hidden" name="w_content" id="nestable-output"/>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div class="col-md-3">
                <div class="m-portlet">
                    <div class="m-portlet__body">

                    </div>

                    <div class="m-portlet__foot">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </form>


    <!-- update catalog model -->
    <div class="modal fade" id="update_widget" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Update Widget Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="update_widget_id">

                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label for="update_widget_title" class="col-2 col-form-label">
                                        Title:
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control m-input" type="text" id="update_widget_title">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Content:
                                    </label>
                                    <div class="col-10">
                                        <div class="m--margin-bottom-15">
                                            <button class="btn btn-primary btn_gallery_media" data-result="update_widget_content" data-multiple="true" data-action="media-insert-ckeditor">
                                                <i class="fa fa-picture-o"></i> Add media
                                            </button>
                                        </div>
                                        <textarea id="update_widget_content" class="_ckeditor"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="update_widget()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')

    @include('dashboard::components.media')

    <script src="{{ asset('backend/js/jquery.nestable.js') }}"></script>

    <script>
        $(document).ready(function() {

            var updateOutput = function(e)
            {
                var list   = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 0,
                maxDepth: 3
            }).on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

        });

        function add_widget()
        {
            var id = Date.now();
            var title = $('#widget-title').val();
            var content = $('#widget-content').val();

            if (!title || !content) {
                return false;
            }

            var widget_item =  '<li class="dd-item" id="item-'+id+'"  data-id="'+id+'" data-label="'+title+'" data-content="'+content+'">\n' +
                '<div class="dd-handle">'+title+'</div>\n' +
                '<div class="dd-actions">\n' +
                '<a class="btn btn-sm btn-brand padding-3" onclick="load_data('+id+')"><i class="fa fa-pencil-square"></i></a>\n' +
                '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('+id+')"><i class="fa fa-trash"></i></a>\n'+
                '</div>\n' +
                '</li>';

            $("#h-widget").append(widget_item);
            $('#nestable').change();

            // reset value
            $('#widget-title').val('');
            $('#widget-content').val('');
        }

        function load_data(id)
        {
            var old_e = $("#item-" + id);
            var label = old_e.data('label');
            var content = old_e.data('content');

            $("#update_widget_id").val(id);
            $("#widget-title").val(label);
            $("#widget-content").val(content);
        }

        function update_widget()
        {
            var id = $("#update_widget_id").val();

            if(!id)
            {
                return false;
            }

            var element = $("#item-" + id);

            element.data('label', $("#widget-title").val());
            element.data('content', $("#widget-content").val());

            $("#item-"+id+" > .dd-handle").text($("#widget-title").val());

            $("#update_widget_id").val('');
            $("#widget-title").val('');
            $("#widget-content").val('');

            $('#nestable').change();
        }

        function delete_item(id) {
            var element_selector = "#item-" + id;
            var child_element_selector = "#item-" + id + " > ol.dd-list";

            if ($(child_element_selector).length) {
                // có con
                // ol cha
                var li_children = $(element_selector).children('ol').children('li');
                $(element_selector).parent().append(li_children);
                $(element_selector).remove();

            } else {
                // không có con

                if($(element_selector).parent().attr('id') == "h-widget") {
                    // không có cha
                    $(element_selector).remove();
                } else {
                    // có cha
                    if($(element_selector).siblings().length) {
                        // có anh em
                        $(element_selector).remove();
                    } else {
                        // không có anh em
                        $(element_selector).parent().parent().children('button').remove();
                        $(element_selector).parent().remove();
                    }
                }

            }
            $('#nestable').change();
        }
    </script>
@endsection