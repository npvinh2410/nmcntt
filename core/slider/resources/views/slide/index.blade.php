@extends('dashboard::layouts.main')

@section('title')
    Slides
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('backend/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/rowReorder.dataTables.min.css') }}">
    <style>
        .form-inline
        {
            display: block;
        }
    </style>
@endsection


@section('content')


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__body">


            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-xl-8 order-1 order-xl-2 ">
                                @if(hydrogen_authorize('slides-create', true))
                                    <a href="{{ route('slides.create', $slider) }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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


            <table id="html_table" class="table table-bordered table-striped dataTable" role="grid"  width="100%">
                <thead>
                <tr>
                    <th>Priority</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Href</th>
                    <th>Target</th>
                    <th>Follow</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($slider->slides as $slide)
                    <tr>
                        <td>{{ $slide->priority }}</td>
                        <td>{{ $slide->name }}</td>
                        <td><img src="{{ $slide->image }}" alt="{{ $slide->name }}" style="max-width: 250px"></td>
                        <td>{{ $slide->href }}</td>
                        <td>{{ $slide->target }}</td>
                        <td>{{ $slide->follow }}</td>
                        <td>
                            @if(hydrogen_authorize('sliders-edit', true))
                                <a href="{{ route('slides.edit', $slide) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                            @endif

                            @if(hydrogen_authorize('sliders-destroy', true))
                                <form class="_confirm_on_delete" style="display: inline;" method="POST" action="{{ route('slides.destroy', $slide) }}">{{ csrf_field() }}<input type="hidden" name="_method" value="DELETE"><button class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button></form>
                            @endif
                        </td>
                        <td style="display: none">{{ $slide->id }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

@section('custom_js')
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            var ajax_url = '{{ route('reorder-slide') }}';

            var table = $('#html_table').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false,
                'rowReorder'  : true,
            });

            table.on( 'row-reorder', function ( e, diff, edit ) {

                for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
                    var rowData = table.row( diff[i].node ).data();

                    var data = {
                        '_token': '{{ csrf_token() }}',
                        'id' : rowData[7],
                        'new_priority': diff[i].newData
                    };

                    $.post(ajax_url, data).done(function(data) {
                        // console.log(data);
                    });
                }

            });

        });
    </script>
@endsection
