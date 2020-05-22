@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Add Recipe')

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
          <h4 class="card-title">{{(isset($recipe)) ? 'Update' : 'Add'}} Recipe</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($recipe))
                {{ Form::model($recipe,['method'=>'put','route' => ['recipes.update',$recipe->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
            	{{ Form::open(['route' => 'recipes.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                 <div class="col-6 text-center">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="">
		                  <label for="file-input2" style="cursor: pointer;">
		                    <img class="modal-img" src="{{asset('images/Group 71.png')}}" >
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
		                <input type="file" name="photo" id="file-input2" class="d-none" data-validate-field="photo" value="{{old('photo')}}">
                    </div>
                  </div>
                  <div class="col-6 text-center">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="">
                      <label for="file-input1" style="cursor: pointer;">
                        <img class="modal-img" src="{{asset('images/video.png')}}" width="36%">
                      </label>
                      <p class="text-center text-muted text-capitalize">upload video</p><br>
                      {!! $errors->first('video', '<label id="video-error" class="error" for="video">:message</label>') !!}
                      <p id="videoerror1" style="display:none; color:#B81111;">
                      Invalid Video Format! Video Format Must Be MP4, Webm, Flv.
                      </p>
                      <p id="videoerror2" style="display:none; color:#B81111;">
                      Maximum File Size Limit is 5MB.
                      </p>
                    </div>
                    <input type="file" name="video" id="file-input1" class="d-none" data-validate-field="video" value="{{old('video')}}">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('title',old('title'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Title' ,'id' => 'title','data-validate-field' => 'title')) }}
                      {!! $errors->first('title', '<p id="title-error" class="error" for="title" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="title-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('ingredients',old('ingredients'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Ingredients', 'data-role' => 'tagsinput' ,'id' => 'courseTags' , 'data-validate-field' => 'ingredients')) }}

                      {!! $errors->first('ingredients', '<p id="ingredients-error" class="error" for="ingredients" style="color: #B81111">:message</p>') !!}

                      <label for="email-id-floating-icon">Ingredients<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::textarea('recipe',old('recipe'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Description' ,'data-validate-field' => 'recipe')) }}
                      {!! $errors->first('recipe', '<p style="color: #B81111" id="recipe-error" class="error" for="recipe">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="recipe-id-floating-icon">Description<span style="color:red;">*</span></label>
                    </div>
                  </div>
                                    <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('site_url',old('site_url'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Site Url', 'data-validate-field' => 'site_url')) }}
                      {!! $errors->first('site_url', '<p id="site_url-error" class="error" for="site_url" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="site_url-id-floating-icon">Site Url<span style="color:red;">*</span></label>
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
                      {{ Form::text('price',old('price'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Price' ,'data-validate-field' => 'price')) }}
                      {!! $errors->first('price', '<p style="color: #B81111" id="price-error" class="error" for="price">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="price-id-floating-icon">Price<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($recipe)) ? 'Update' : 'Save'}}</button>
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
            ingredients: {
                required: true
            },
            title: {
                required: true
            },
            recipe: {
                required: true
            },
        },
        messages: {
            ingredients: {
                required: 'Ingredients are required',
            },
            title: {
                required: 'Title is required',
            },
            recipe: {
                required: 'Recipe description is required',
            },
        },
    });
</script>
@endsection


