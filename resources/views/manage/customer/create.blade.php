@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Add Customer')

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($customer)) ? 'Update' : 'Add'}} Customer</h4>
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
                 <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="text-center">
		                  <label for="file-input2" style="cursor: pointer;">
		                    <img class="modal-img rounded-circle" src="{{asset('images/Group 71.png')}}" id="output" >
		                  </label>
		                  <p class="text-center text-muted text-capitalize">upload image</p><br>
		                    {!! $errors->first('photo', '<p style="color: #B81111" id="photo-error" class="error" for="photo" style="color: #B81111">:message</p>') !!}
		                      <p id="error1" style="display:none; color:#B81111;">
		                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
		                      </p>
		                      <p id="error2" style="display:none; color:#B81111;">
		                        Maximum File Size Limit is 5MB.
		                      </p>
		                </div>
		                <input type="file" name="photo" id="file-input2" class="d-none" data-validate-field="photo" value="{{old('photo')}}" onchange="loadFile(event)">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('name',old('name'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Customer Name' ,'id' => 'name','data-validate-field' => 'name')) }}
                      {!! $errors->first('name', '<p id="name-error" class="error" for="name" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="email-id-floating-icon">Name<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::email('email',old('email'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Email Address', 'data-validate-field' => 'email')) }}
                      {!! $errors->first('email', '<p id="email-error" class="error" for="email" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="email-id-floating-icon">Email<span style="color:red;">*</span></label>

                    </div>

                  </div>

                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('address',old('address'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Address' ,'data-validate-field' => 'address')) }}
                      {!! $errors->first('address', '<p style="color: #B81111" id="address-error" class="error" for="address">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="email-id-floating-icon">Address<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('city',old('city'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter City Name' ,'data-validate-field' => 'city')) }}
                      {!! $errors->first('city', '<p style="color: #B81111" id="city-error" class="error" for="city">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="email-id-floating-icon">City<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('country',old('country'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Country Name' ,'data-validate-field' => 'country')) }}
                      {!! $errors->first('country', '<p style="color: #B81111" id="country-error" class="error" for="country">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="email-id-floating-icon">Country<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::number('phone',old('phone'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Phone Number' ,'data-validate-field' => 'phone')) }}
                      {!! $errors->first('phone', '<p style="color: #B81111" id="phone-error" class="error" for="phone">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mobile"></i>
                      </div>
                      <label for="email-id-floating-icon">Phone number<span style="color:red;">*</span></label>
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

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    $('#output').css({'width':'150px','height':'150px'});
  };

</script>
@endsection