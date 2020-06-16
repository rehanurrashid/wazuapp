@extends('layouts.contentLayoutMaster')
{{-- title --}}
@section('title','Customers')

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
            <a class="btn btn-dark w-25" href="{{ route('customers.create') }}">Add New</a>
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
                        <h5 class="card-title">Customers List</h5>

                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                            </div>
                        </div>
                    </div>
                    <table class="table" id="rtable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="w-25">Total Scans</th>
                            <th >View Scans</th>
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

        // Setup - add a text input to each footer cell

        $('#rtable').DataTable({

            processing: true,
            serverSide: true,
            autoWidth: true,
            responsive: true,
            ajax: {
              url: '{!! route('customers.index') !!}',
              type: 'GET',
              data: function (d) {
              d.scan = $('input[type="search"]').val();
              }
             },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'scans_count', name: 'scans_count' },
                { data: 'scans', name: 'scans' },
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
            },
            rowCallback: function( row, data ) {
                console.log(row)
            if ( data.grade == "A" ) {
              $('td:eq(4)', row).html( '<b>A</b>' );
            }
          }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#rtable tbody" ).on( "click", "button", function() {

            let totalProductsTemplate = $(this).next('p').html();
            let tableTemplate = $(this).siblings('table').html();
            console.log(tableTemplate)

            $('.product-list').html(tableTemplate);
            $('span.products-visited').html(totalProductsTemplate);
        });



    })

</script>
@endsection


