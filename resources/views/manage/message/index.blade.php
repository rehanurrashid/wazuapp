@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Messages')

{{-- page style --}}
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/extensions/toastr.css')}}">
@endsection
{{-- page-styles --}}

{{-- vendor styles --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/toastr.css')}}">
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div>
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div>
            <a class="btn btn-dark w-25" href="{{ route('messages.create') }}">Add New</a>
        </div>
    </div>
</div>
<br>

<section>
    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="card p-2">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Messages List</h5>

                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="rtable" style="">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Receiver Name</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Product Image</th>
                            <th>Read_at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                                    
            <!-- /basic initialization -->

            </div>
        </div>
    </div>
</section>

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/datatables/datatable.js')}}"></script>
<script src="{{asset('js/scripts/extensions/toastr.js')}}"></script>
<script>
    $(function() {
        $('#rtable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            scrollX: true,
            ajax: '{!! route('messages.index') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'receiver_name', name: 'receiver_name' },
                { data: 'title', name: 'title' },
                { data: 'body', name: 'body' },
                { data: 'image', name: 'image' },
                { data: 'read_at', name: 'read_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            buttons: {
                dom: {
                    button: {
                        className: 'btn btn-light'
                    }
                },
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'

                ],
                'columnDefs': [
                    {
                        "className": "dt-center", "targets": "_all"
                    }
                ],
            }

        });
    });
</script>

@endsection


