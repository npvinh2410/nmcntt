@extends('dashboard::layouts.main')

@section('title')
    Create new Menu
@endsection

@section('content')
    <form action="{{ route('menus.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="m-portlet">
            <div class="m-portlet__body">
                <div class="form-group m-form__group row">
                    <label for="name" class="col-2 col-form-label">
                        Name:
                    </label>
                    <div class="col-10">
                        <input class="form-control m-input" type="text" value="{{ old('name') }}" id="name" name="name" required>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label for="position" class="col-2 col-form-label">
                        Position:
                    </label>
                    <div class="col-10">
                        <select class="form-control m-input" id="position" name="position">
                            @foreach(get_free_position('menu') as $position)
                                <option value="{{$position}}">{{$position}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="m-portlet m--margin-top-35">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Menu Config
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="form-group m-form__group row">

                    <div class="col-md-6">

                        <div class="m-accordion m-accordion--bordered" id="menu_items" role="tablist">

                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head" role="tab" id="link" data-toggle="collapse" href="#link_info" aria-expanded="false">
                                    <span class="m-accordion__item-icon">
                                        <i class="fa fa-unlink"></i>
                                    </span>
                                    <span class="m-accordion__item-title">
                                        Link
                                    </span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                <div class="m-accordion__item-body collapse show" id="link_info" role="tabpanel" aria-labelledby="" data-parent="#menu_items">
                                    <div class="m-accordion__item-content">

                                        <div class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">

                                                    <div class="form-group m-form__group row">
                                                        <label for="link_title" class="col-2 col-form-label">
                                                            Title:
                                                        </label>
                                                        <div class="col-10">
                                                            <input class="form-control m-input" type="text" id="link_title">
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label for="link_url" class="col-2 col-form-label">
                                                            URL:
                                                        </label>
                                                        <div class="col-10">
                                                            <input class="form-control m-input" type="text" id="link_url">
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label for="link_target" class="col-2 col-form-label">
                                                            Open in:
                                                        </label>
                                                        <div class="col-10">
                                                            <select class="form-control m-input" id="link_target">
                                                                <option value="_self">Current Page</option>
                                                                <option value="_blank">New Page</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group m-form__group row">
                                                        <label for="link_follow" class="col-2 col-form-label">
                                                            Follow:
                                                        </label>
                                                        <div class="col-10">
                                                            <select class="form-control m-input" id="link_follow">
                                                                <option value="nofollow">Nofollow</option>
                                                                <option value="dofollow">Dofollow</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <a href="javascript:void(0)" onclick="add_link()" class="btn btn-primary">
                                                        Save
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="categories" data-toggle="collapse" href="#category_items" aria-expanded="false">
                                    <span class="m-accordion__item-icon">
                                        <i class="fa fa-newspaper-o"></i>
                                    </span>
                                    <span class="m-accordion__item-title">
                                        Categories
                                    </span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                <div class="m-accordion__item-body collapse" id="category_items" role="tabpanel" aria-labelledby="" data-parent="#menu_items">
                                    <div class="m-accordion__item-content">

                                        <div class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label for="category" class="col-2 col-form-label">
                                                            Categories:
                                                        </label>
                                                        <div class="col-10">
                                                            <select class="form-control m-input" id="category">
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->translate(get_default_lang_code())->the_title() }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <a href="javascript:void(0)" onclick="add_category()" class="btn btn-primary">
                                                        Save
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="pages" data-toggle="collapse" href="#page_items" aria-expanded="false">
                                    <span class="m-accordion__item-icon">
                                        <i class="fa fa-book"></i>
                                    </span>
                                    <span class="m-accordion__item-title">
                                        Pages
                                    </span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                <div class="m-accordion__item-body collapse" id="page_items" role="tabpanel" aria-labelledby="" data-parent="#menu_items">
                                    <div class="m-accordion__item-content">

                                        <div class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label for="page" class="col-2 col-form-label">
                                                            Pages:
                                                        </label>
                                                        <div class="col-10">
                                                            <select class="form-control m-input" id="page">
                                                                @foreach($pages as $page)
                                                                    <option value="{{ $page->id }}">{{ $page->translate(get_default_lang_code())->the_title() }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <a href="javascript:void(0)" onclick="add_page()" class="btn btn-primary">
                                                        Save
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="m-accordion__item">
                                <div class="m-accordion__item-head collapsed" role="tab" id="catalogs" data-toggle="collapse" href="#catalog_items" aria-expanded="false">
                                    <span class="m-accordion__item-icon">
                                        <i class="fa fa-cubes"></i>
                                    </span>
                                    <span class="m-accordion__item-title">
                                        Catalogs
                                    </span>
                                    <span class="m-accordion__item-mode"></span>
                                </div>
                                <div class="m-accordion__item-body collapse" id="catalog_items" role="tabpanel" aria-labelledby="" data-parent="#menu_items">
                                    <div class="m-accordion__item-content">

                                        <div class="m-form">
                                            <div class="m-portlet__body">
                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label for="catalog" class="col-2 col-form-label">
                                                            Catalogs:
                                                        </label>
                                                        <div class="col-10">
                                                            <select class="form-control m-input" id="catalog">
                                                                @foreach($catalogs as $catalog)
                                                                    <option value="{{ $catalog->id }}">{{ $catalog->translate(get_default_lang_code())->the_title() }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <a href="javascript:void(0)" onclick="add_catalog()" class="btn btn-primary">
                                                        Save
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Menu Structure
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet__body">
                            <input type="hidden" id="menu_data" name="menu_data">
                            <div class="dd" id="nestable">
                                <ol id="h-menu" class="dd-list">

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-brand">Submit</button>
            </div>
        </div>

    </form>


    <!-- Link update model -->

    <div class="modal fade" id="update_link" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Update Menu Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="update_link_id">

                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">

                                <div class="form-group m-form__group row">
                                    <label for="link_title" class="col-2 col-form-label">
                                        Title:
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control m-input" type="text" id="update_link_title">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="link_url" class="col-2 col-form-label">
                                        URL:
                                    </label>
                                    <div class="col-10">
                                        <input class="form-control m-input" type="text" id="update_link_url">
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="link_target" class="col-2 col-form-label">
                                        Open in:
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-input" id="update_link_target">
                                            <option value="_self">Current Page</option>
                                            <option value="_blank">New Page</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label for="link_follow" class="col-2 col-form-label">
                                        Follow:
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-input" id="update_link_follow">
                                            <option value="nofollow">Nofollow</option>
                                            <option value="dofollow">Dofollow</option>
                                        </select>
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
                    <button type="button" class="btn btn-primary" onclick="update_link()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>



    <!-- category update model -->
    <div class="modal fade" id="update_category" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Update Menu Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="update_category_id">
                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label for="category" class="col-2 col-form-label">
                                        Categories:
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-input" id="update_category_new">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->translate(get_default_lang_code())->the_title() }}</option>
                                            @endforeach
                                        </select>
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
                    <button type="button" class="btn btn-primary" onclick="update_category()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- update page model -->
    <div class="modal fade" id="update_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Update Menu Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="update_page_id">

                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label for="page" class="col-2 col-form-label">
                                        Pages:
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-input" id="update_page_new">
                                            @foreach($pages as $page)
                                                <option value="{{ $page->id }}">{{ $page->translate(get_default_lang_code())->the_title() }}</option>
                                            @endforeach
                                        </select>
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
                    <button type="button" class="btn btn-primary" onclick="update_page()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- update catalog model -->
    <div class="modal fade" id="update_catalog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Update Menu Item
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="update_catalog_id">

                    <div class="m-form">
                        <div class="m-portlet__body">
                            <div class="m-form__section m-form__section--first">
                                <div class="form-group m-form__group row">
                                    <label for="page" class="col-2 col-form-label">
                                        Catalogs:
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control m-input" id="update_catalog_new">
                                            @foreach($catalogs as $catalog)
                                                <option value="{{ $catalog->id }}">{{ $catalog->translate(get_default_lang_code())->the_title() }}</option>
                                            @endforeach
                                        </select>
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
                    <button type="button" class="btn btn-primary" onclick="update_catalog()">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('backend/js/jquery.nestable.js') }}"></script>

    <script type="text/javascript">

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
            updateOutput($('#nestable').data('output', $('#menu_data')));

        });

        function add_link()
        {
            var id = Date.now();
            var type = 'custom_link';
            var title = $('#link_title').val();
            var url = $('#link_url').val();
            var target = $('#link_target').val();
            var follow = $('#link_follow').val();

            if (!title || !url) {
                return false;
            }

            var menu_item =  '<li class="dd-item" id="item-'+id+'"  data-id="'+id+'" data-type="'+type+'" data-label="'+title+'" data-url="'+url+'" data-target="'+target+'" data-follow="'+follow+'">\n' +
                                '<div class="dd-handle">'+title+'</div>\n' +
                                '<div class="dd-actions">\n' +
                                    '<a class="btn btn-sm btn-brand padding-3" data-toggle="modal" data-target="#update_link" data-id="'+id+'"><i class="fa fa-pencil-square"></i></a>\n' +
                                    '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('+id+')"><i class="fa fa-trash"></i></a>\n'+
                                '</div>\n' +
                            '</li>';

            $("#h-menu").append(menu_item);
            $('#nestable').change();

            // reset value
            $('#link_title').val('');
            $('#link_url').val('');
            $('#link_target').prop('selectedIndex',0);
            $('#link_follow').prop('selectedIndex',0);
        }

        function add_category()
        {
            var id = Date.now();
            var type = 'category';
            var cat_id = $('#category').val();
            var title = $("#category option:selected").text();

            var menu_item =     '<li class="dd-item" id="item-'+id+'" data-id="'+id+'" data-type="'+type+'" data-cid="'+cat_id+'" data-label="'+title+'">\n' +
                                    '<div class="dd-handle">'+title+'</div>\n' +
                                    '<div class="dd-actions">\n' +
                                        '<a class="btn btn-sm btn-warning padding-3" data-toggle="modal" data-target="#update_category" data-id="'+id+'"><i class="fa fa-pencil-square"></i></a>\n' +
                                        '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('+id+')"><i class="fa fa-trash"></i></a>\n'+
                                    '</div>\n' +
                                '</li>';

            $("#h-menu").append(menu_item);
            $('#nestable').change();

            $('#category').prop('selectedIndex',0);;
        }

        function add_page()
        {
            var id = Date.now();
            var type = 'page';
            var page_id = $('#page').val();
            var title = $("#page option:selected").text();

            var menu_item =  '<li class="dd-item" id="item-'+id+'" data-id="'+id+'" data-type="'+type+'" data-pid="'+page_id+'" data-label="'+title+'">\n' +
                                '<div class="dd-handle">'+title+'</div>\n' +
                                '<div class="dd-actions">\n' +
                                    '<a class="btn btn-sm btn-warning padding-3" data-toggle="modal" data-target="#update_page" data-id="'+id+'"><i class="fa fa-pencil-square"></i></a>\n' +
                                    '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('+id+')"><i class="fa fa-trash"></i></a>\n'+
                                '</div>\n' +
                            '</li>';

            $("#h-menu").append(menu_item);
            $('#nestable').change();

            $('#page').prop('selectedIndex',0);
        }


        function add_catalog()
        {
            var id = Date.now();
            var type = 'catalog';
            var cat_id = $('#catalog').val();
            var label = $("#catalog option:selected").text();

            var menu_item =  '<li class="dd-item" id="item-'+id+'" data-id="'+id+'" data-type="'+type+'" data-pcid="'+cat_id+'" data-label="'+label+'">\n' +
                                '<div class="dd-handle">'+label+'</div>\n' +
                                '<div class="dd-actions">\n' +
                                    '<a class="btn btn-sm btn-warning padding-3" data-toggle="modal" data-target="#update_catalog" data-id="'+id+'"><i class="fa fa-pencil-square"></i></a>\n' +
                                    '<a class="btn btn-sm btn-danger padding-3" onclick="delete_item('+id+')"><i class="fa fa-trash"></i></a>\n'+
                                '</div>\n' +
                            '</li>';

            $("#h-menu").append(menu_item);
            $('#nestable').change();

            $('#catalog').prop('selectedIndex',0);
        }

        //LOADDATA

        $('#update_link').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);

            var id = button.data('id');

            var old_e = $("#item-" + id);
            var label = old_e.data('label');
            var url = old_e.data('url');
            var target = old_e.data('target');
            var follow = old_e.data('follow');

            $("#update_link_id").val(id);
            $("#update_link_title").val(label);
            $("#update_link_url").val(url);
            $("#update_link_target").val(target);
            $("#update_link_follow").val(follow);

        });

        $('#update_category').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes

            var old_e = $("#item-" + id);
            var cid = old_e.data('cid');

            $("#update_category_id").val(id);
            $("#update_category_new").val(cid);
        });

        $('#update_page').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes

            var old_e = $("#item-" + id);
            var pid = old_e.data('pid');

            $("#update_page_id").val(id);
            $("#update_page_new").val(pid);
        });



        $('#update_catalog').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes

            var old_e = $("#item-" + id);
            var cid = old_e.data('pcid');

            $("#update_catalog_id").val(id);
            $("#updata_catalog_new").val(cid);
        });

        //UPDATE ITEM

        function update_link()
        {
            console.log('ok');

            var id = $("#update_link_id").val();
            var element = $("#item-" + id);



            element.data('label', $("#update_link_title").val());
            element.data('url', $("#update_link_url").val());
            element.data('target', $("#update_link_target").val());
            element.data('follow', $("#update_link_follow").val());

            $("#item-"+id+" > .dd-handle").text($("#update_link_title").val());

            $("#update_link_title").val('');
            $("#update_link_url").val('');
            $("#update_link_target").val('');
            $("#update_link_follow").val('');

            $('#nestable').change();
            $('#update_link').modal('hide');
        }

        function update_category()
        {
            var id = $("#update_category_id").val();
            var element = $("#item-" + id);

            element.data('cid', $("#update_category_new").val());
            element.data('label', $("#update_category_new option:selected").text());

            $("#item-"+id+" > .dd-handle").text($("#update_category_new option:selected").text());

            $('#update_category_new').prop('selectedIndex',0);

            $('#nestable').change();
            $('#update_category').modal('hide');
        }

        function update_page()
        {
            var id = $("#update_page_id").val();
            var element = $("#item-" + id);

            element.data('pid', $("#update_page_new").val());
            element.data('label', $("#update_page_new option:selected").text());

            $("#item-"+id+" > .dd-handle").text($("#update_page_new option:selected").text());

            $('#update_page_new').prop('selectedIndex',0);

            $('#nestable').change();
            $('#update_page').modal('hide');
        }

        function update_catalog()
        {
            var id = $("#update_catalog_id").val();
            var element = $("#item-" + id);

            element.data('cid', $("#update_catalog_new").val());
            element.data('label', $("#update_catalog_new option:selected").text());

            $("#item-"+id+" > .dd-handle").text($("#update_catalog_new option:selected").text());

            $('#update_catalog_new').prop('selectedIndex',0);

            $('#nestable').change();
            $('#update_catalog').modal('hide');
        }

        // DELETE ITEM
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

                if($(element_selector).parent().attr('id') == "h-menu") {
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