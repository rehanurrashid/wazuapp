@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Add Bulk Products')

{{-- vendor scripts --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">

    <!-- tags input css -->
    <link href="{{ asset('admin/css/tagsinput.css') }}" rel="stylesheet" type="text/css">

    <style type="text/css">
        .bootstrap-tagsinput .badge {
            margin: 3px 6px;
            padding: 5px 8px;
        }
    </style>
@endsection

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($product)) ? 'Update' : 'Add'}} Products In Bulk</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($product))
                {{ Form::model($product,['method'=>'put','route' => ['products.update',$product->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
            	{{ Form::open(['route' => 'products.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                  @if(auth()->user()->role == 'admin')
                  <div class="col-12">
                    <div class="form-group">
                      @php $user[''] = 'Please Select Vendor'; @endphp
                      {{ Form::select('user_id', $user ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;' , 'data-validate-field' => 'user_id']) }}
                    </div>
                  </div>
                  @else
                      <div class="col-12">
                          <input type="text" hidden value="{{ auth()->id() }}" name="user_id"/>
                      </div>
                  @endif
                  <div class="col-6">
                    <div class="form-group">
                      <h5>Instructions:</h5>
                      <ul>
                        <li>File must be of .csv formate</li>
                        <li>Lorem ipsum Lorem ipsum</li>
                        <li>Lorem ipsum Lorem ipsum</li>
                      </ul>
                    </div>
                    <hr>
                    <div class="form-label-group position-relative has-icon-left text-center">
                      <div class="">
		                  <label for="file-input2" style="cursor: pointer;">
		                    <img class="modal-img" src="{{asset('images/upload.png')}}" >
		                  </label>
		                  <p class="text-muted text-capitalize">Upload .csv File</p><br>

		                  {!! $errors->first('products', '<p style="color: #B81111" id="products-error" class="error" for="products">:message</p>') !!}

                      <p id="error1" style="display:none; color:#B81111;">
                      Invalid File Format! File Format Must Be CSV.
                      </p>
                      <p id="error2" style="display:none; color:#B81111;">
                      Maximum File Size Limit is 5MB.
                      </p>

		                  <input type="file" name="products" id="file-input2" class="d-none" data-validate-field="products" value="{{old('products')}}">
                    </div>
                  </div>
                  <hr>
                </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($product)) ? 'Update' : 'Save'}}</button>
                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                  </div>
                </div>
              </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- // Basic multiple Column Form section end -->
@endsection
<!-- Select2 Sizing end -->

{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>

<!-- tags input js  -->
<script src="{{ asset('admin/js/tagsinput.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>
<script type="text/javascript">

        // searchable dropdown
    // $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            user_id: {
                required: true
            },
            products: {
                required: true
            },

        },
        messages: {
            user_id: {
                required: 'Please select vendor',
            },
            products: {
                required: 'Please upload .CSV formate file',
            },
        },
    });
</script>
@endsection


