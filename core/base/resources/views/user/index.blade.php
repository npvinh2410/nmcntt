@extends('dashboard::layouts.main')

@section('title')
    Users
@endsection


@section('content')
    <div class="m-portlet m-portlet--tabs">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                    @if(hydrogen_authorize('clients-index', true))
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#clients" role="tab">
                                <i class="flaticon-users"></i>
                                Clients
                            </a>
                        </li>
                    @endif
                    @if(hydrogen_authorize('admins-index', true))
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link @if(!hydrogen_authorize('clients-index', true)) active @endif" data-toggle="tab" href="#admins" role="tab">
                                <i class="flaticon-user-ok"></i>
                                Admins
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <div class="tab-content">
                @if(hydrogen_authorize('clients-index', true))
                    <div class="tab-pane active" id="clients" role="tabpanel">

                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__body">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-12 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-xl-8 order-1 order-xl-2 ">
                                                    @if( hydrogen_authorize('clients-create', true))
                                                        <a href="{{ route('clients.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                            <span>
                                                                <i class="la la-plus-square"></i>
                                                                <span>
                                                                    New
                                                                </span>
                                                            </span>
                                                        </a>
                                                    @endif
                                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                                </div>
                                                <div class="col-md-4 order-2 order-xl-3">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="m-datatable-1" id="html_table" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client->id }}</td>
                                            <td>{{ $client->client->name }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                @endif
                @if(hydrogen_authorize('admins-index', true))
                    <div class="tab-pane @if(!hydrogen_authorize('clients-index', true)) active @endif" id="admins" role="tabpanel">

                        <div class="m-portlet m-portlet--mobile">
                            <div class="m-portlet__body">
                                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-12 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-xl-8 order-1 order-xl-2 ">
                                                    @if( hydrogen_authorize('admins-create', true))
                                                        <a href="{{ route('admins.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                            <span>
                                                                <i class="la la-plus-square"></i>
                                                                <span>
                                                                    New
                                                                </span>
                                                            </span>
                                                        </a>
                                                    @endif
                                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                                </div>
                                                <div class="col-md-4 order-2 order-xl-3">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="m-datatable-2" id="html_table" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->admin->name }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script>
        var DatatableHtmlTable1 = function() {
            var e = function() {
                var e = $(".m-datatable-1").mDatatable({
                        columns: [
                                @if(hydrogen_authorize('clients-show', true))
                                    {
                                        field: "Name",
                                        template: function(e) {
                                            return "<a href='/dashboard/clients/"+e.Id+"/show'>"+ e.Name +"</a>";
                                        }
                                    },
                                @endif

                                    {
                                        field: 'Actions',
                                        template: function(e) {
                                            var edit_str = @if(hydrogen_authorize('clients-edit', true)) '<a href="{{ url("/") }}/dashboard/clients/'+ e.Id.trim() +'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                            var delete_str = @if(hydrogen_authorize('clients-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/clients/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
                                            return  edit_str + delete_str;
                                        }
                                    }
                                ]
                        }),
                        a = e.getDataSourceQuery();

                $("#m_form_search").on("keyup", function(a) {
                    e.search($(this).val().toLowerCase())
                }).val(a.generalSearch)
            };
            return {
                init: function() {
                    e()
                }
            }
        }();

        var DatatableHtmlTable2 = function() {
            var e = function() {
                var e = $(".m-datatable-2").mDatatable({
                        columns: [
                                @if(hydrogen_authorize('admins-show', true))
                            {
                                field: "Name",
                                template: function(e) {
                                    return "<a href='/dashboard/admins/"+e.Id+"/show'>"+ e.Name +"</a>";
                                }
                            },
                                @endif

                            {
                                field: 'Actions',
                                template: function(e) {
                                    var edit_str = @if(hydrogen_authorize('admins-edit', true)) '<a href="{{ url("/") }}/dashboard/admins/'+ e.Id.trim() +'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                    var delete_str = @if(hydrogen_authorize('admins-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/admins/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
                                    return  edit_str + delete_str;
                                }
                            }
                        ]
                    }),
                    a = e.getDataSourceQuery();
                $("#m_form_search").on("keyup", function(a) {
                    e.search($(this).val().toLowerCase())
                }).val(a.generalSearch)
            };
            return {
                init: function() {
                    e()
                }
            }
        }();


        jQuery(document).ready(function() {
            DatatableHtmlTable1.init();
            DatatableHtmlTable2.init();
        });
    </script>
@endsection