@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Update Vendor')

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($vendor)) ? 'Update' : 'Add'}} Vendor</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($customer))
                {{ Form::model($customer,['method'=>'put','route' => ['customers.update',$customer->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
              {{ Form::open(['route' => 'customers.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ Form::label('status','Activate/Deactivate Account') }}<span style="color:red;">*</span>
                            {{ Form::select('status', ['1' => 'Activate', '0' => 'Deactivate'] ,'1' , ['class' => 'form-control select2', 'style'=> 'margin-bottom:10px;']) }}

                            {!! $errors->first('status', '<label id="status-error" class="error" for="status">:message</label>') !!}
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($customer)) ? 'Update' : 'Save'}}</button>
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

{{-- page scripts --}}
@section('page-scripts')

<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>
<script type="text/javascript">

        // searchable dropdown
    // $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true
            },
            email: {
                required: true
            },
            city: {
                required: true
            },
            country: {
                required: true
            },
            address: {
                required: true
            },
            phone: {
                required: true
            },
            photo: {
                required: true
            },
        },
        messages: {
            name: {
                required: 'Full name is required',
            },
            email: {
                required: 'Email is required',
            },
            phone: {
                required: 'Phone number is required',
            },
            city: {
                required: 'City is required',
            },
            country: {
                required: 'Country is required',
            },
            address: {
                required: 'Address is required',
            },
            photo: {
                required: 'Image is required',
            },
        },
    });
</script>
@endsection