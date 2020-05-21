@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Update Plan')

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($plan)) ? 'Update' : 'Add'}} Plan</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($plan))
                {{ Form::model($plan,['method'=>'put','route' => ['plans.update',$plan->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
              {{ Form::open(['route' => 'plans.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('name',old('name'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Package Name' ,'id' => 'name','data-validate-field' => 'name')) }}
                      {!! $errors->first('name', '<p id="name-error" class="error" for="name" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="name-id-floating-icon">Name<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('duration',old('duration'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Duration', 'data-validate-field' => 'duration')) }}
                      {!! $errors->first('duration', '<p id="duration-error" class="error" for="duration" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="duration-id-floating-icon">Duration<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('price',old('price'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Price' ,'data-validate-field' => 'price')) }}
                      {!! $errors->first('price', '<p style="color: #B81111" id="price-error" class="error" for="price">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="price-id-floating-icon">Price<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::textarea('description',old('description'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Description' ,'data-validate-field' => 'description')) }}
                      {!! $errors->first('description', '<p style="color: #B81111" id="description-error" class="error" for="description">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="description-id-floating-icon">Description<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($plan)) ? 'Update' : 'Save'}}</button>
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

{{-- page scripts --}}
@section('page-scripts')

<script src="{{ asset('js/just-validate.min.js') }}"></script>
<script type="text/javascript">

        // searchable dropdown
    // $('.select2').select2();

        new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true
            },
            duration: {
                required: true
            },
            price: {
                required: true
            },
            description: {
                required: true
            },
        },
        messages: {
            name: {
                required: 'Name is required',
            },
            price: {
                required: 'Price is required',
            },
            duration: {
                required: 'Duration is required',
            },
            description: {
                required: 'Description is required',
            },
        },
    });
</script>
@endsection


