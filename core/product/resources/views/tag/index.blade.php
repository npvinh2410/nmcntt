@extends('dashboard::layouts.main')

@section('title')
    Tags
@endsection

@section('content')


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">

            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-xl-8 order-1 order-xl-2 ">
                                @if(hydrogen_authorize('catalogs-create', true))
                                    <a href="{{ route('tags.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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

            <table class="m-datatable" id="html_table" width="100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    @if(get_setting('multi_lang') == 'on')
                        @foreach(get_lang_need_translate() as $code => $name)
                            <th>{{ $name }}</th>
                        @endforeach
                    @endif
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->translate(get_default_lang_code())->the_title() }}</td>
                        @if(get_setting('multi_lang') == 'on')
                            @foreach(get_lang_need_translate() as $code => $name)
                                <td>@if($tag->translate($code)) translated @endif</td>
                            @endforeach
                        @endif
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
                @if(hydrogen_authorize('catalogs-show', true))
                {
                    field: "Title",
                        template: function(e) {

                            return "<a href='/dashboard/tags/"+e.Id+"/{{ get_default_lang_code() }}'>"+ e.Title +"</a>";
                        }
                },
                @endif
                @if(get_setting('multi_lang') == 'on')
                    @foreach(get_lang_need_translate() as $code => $name)
                    {
                        field: "{{ $name }}",
                        template: function(e) {
                            var tpl = "";
                            if (e.{{$name}}.trim() == "")
                            {
                                tpl += @if(hydrogen_authorize('catalogs-create', true)) '<a href="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'/trans/{{ $code }}" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-plus-square-o"></i></a>'; @else ''; @endif
                            }
                            else if (e.{{$name}}.trim() == "translated")
                            {
                                tpl += @if(hydrogen_authorize('catalogs-show', true)) '<a href="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'/{{$code}}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-file-text"></i></a>'; @else ''; @endif
                                tpl += @if(hydrogen_authorize('catalogs-edit', true)) '<a href="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'/{{$code}}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                tpl += @if(hydrogen_authorize('catalogs-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="lang_code" value="{{$code}}"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
                            }

                            return tpl;
                        }
                    },
                    @endforeach
                @endif
                {
                    field: 'Actions',
                    template: function(e) {
                        var edit_str = @if(hydrogen_authorize('catalogs-edit', true)) '<a href="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'/{{ get_default_lang_code() }}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                        var delete_str = @if(hydrogen_authorize('catalogs-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/tags/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
                        return  edit_str + delete_str;
                    }
                },
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
