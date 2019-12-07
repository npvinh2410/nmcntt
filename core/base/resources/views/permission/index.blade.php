@extends('dashboard::layouts.main')

@section('title')
    Administrator Permissions
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-xl-8 order-1 order-xl-2 ">
                                @if( hydrogen_authorize('permissions-create', true))
                                    <a href="{{ route('permissions.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                        <span>
                                            <i class="la la-plus-square"></i>
                                            <span>
                                                New
                                            </span>
                                        </span>
                                    </a>
                                @endif

                                @if( hydrogen_authorize('permissions-create', true))
                                    <a href="{{ route('permissions.create_bundle') }}" class="btn btn-warning m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                    <span>
                                        <i class="la la-plus-square"></i>
                                        <span>
                                            New Bundle
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
            <table class="m-datatable" id="html_table" width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->display_name }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection


@section('custom_js')
    <script>
        var DatatableHtmlTable = function() {
            var e = function() {
                var e = $(".m-datatable").mDatatable({
                        columns: [
                                @if(hydrogen_authorize('permissions-show', true))
                            {
                                field: "Name",
                                template: function(e) {
                                    return "<a href='/dashboard/permissions/"+e.Id+"'>"+ e.Name +"</a>";
                                }
                            },
                                @endif

                            {
                                field: 'Actions',
                                template: function(e) {
                                    var edit_str = @if(hydrogen_authorize('permissions-edit', true)) '<a href="{{ url("/") }}/dashboard/permissions/'+ e.Id.trim() +'/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                    var delete_str = @if(hydrogen_authorize('permissions-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/permissions/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
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
            DatatableHtmlTable.init()
        });
    </script>
@endsection