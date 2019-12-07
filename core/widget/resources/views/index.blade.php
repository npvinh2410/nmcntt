@extends('dashboard::layouts.main')

@section('title')
   Widgets
@endsection


@section('content')


   <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__body">


         <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
               <div class="col-xl-12 order-2 order-xl-1">
                  <div class="form-group m-form__group row align-items-center">
                     <div class="col-xl-8 order-1 order-xl-2 ">
                        @if(hydrogen_authorize('widgets-create', true))
                            <a href="{{ route('widgets.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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
                <th>Positions</th>
                @if(get_setting('multi_lang') == 'on')
                    @foreach(get_lang_need_translate() as $code => $name)
                        <th>{{ $name }}</th>
                    @endforeach
                @endif
               <th>Actions</th>

            </tr>
            </thead>
            <tbody>
            @foreach($widgets as $p)
               <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->positions }}</td>
                    @if(get_setting('multi_lang') == 'on')
                        @foreach(get_lang_need_translate() as $code => $name)
                            <td>@if($p->translate($code)) translated @endif</td>
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
                           @if(hydrogen_authorize('widgets-show', true))
                           {
                               field: "Positions",
                               template: function(e) {

                                   return "<a href='/dashboard/widgets/"+e.Id+"/{{ get_default_lang_code() }}'>"+ e.Positions +"</a>";
                               }
                           },
                           @endif

                           @if(get_setting('multi_lang') == 'on')
                               @foreach(get_lang_need_translate() as $code => $name)
                               {
                                   field: "{{ $name }}",
                                   template: function(e) {
                                       var tpl = "";
                                       if (e.{{$name}}.trim() == "") {
                                           tpl += @if(current_user()->can('widgets-create')) '<a href="{{ url("/") }}/dashboard/widgets/'+ e.Id.trim() +'/trans/{{ $code }}" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-plus-square-o"></i></a>'; @else ''; @endif
                                       } else if (e.{{$name}}.trim() == "translated") {
                                           tpl += @if(current_user()->can('widgets-show')) '<a href="{{ url("/") }}/dashboard/widgets/'+ e.Id.trim() +'/{{$code}}" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-file-text"></i></a>'; @else ''; @endif
                                               tpl += @if(current_user()->can('widgets-edit')) '<a href="{{ url("/") }}/dashboard/widgets/'+ e.Id.trim() +'/{{$code}}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                               tpl += @if(current_user()->can('widgets-destroy')) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/products/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><input type="hidden" name="lang_code" value="{{$code}}"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
                                       }

                                       return tpl;
                                   }
                               },
                               @endforeach
                           @endif
                           {
                               field: 'Actions',
                               template: function(e) {
                                   var edit_str = @if(hydrogen_authorize('widgets-edit', true)) '<a href="{{ url("/") }}/dashboard/widgets/'+ e.Id.trim() +'/{{ get_default_lang_code() }}/edit" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>'; @else ''; @endif
                                   var delete_str = @if(hydrogen_authorize('widgets-destroy', true)) '<form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ url("/") }}/dashboard/widgets/'+ e.Id.trim() +'">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>'; @else ''; @endif;
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