@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Add Product')

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

  <div>
    <p id="alert" class="alert alert-success d-none">Product Created Successfully</p>
  </div>

<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($product)) ? 'Update' : 'Add'}} Product</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($product))
                {{ Form::model($product,['method'=>'put','route' => ['products.update',$product->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form','id' => 'myForm']) }}
            @else
            	{{ Form::open([ 'route' => 'products.store','enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post','id' => 'myForm']) }}
            @endif
              <div class="form-body">
                <div class="row">
                 <div class="col-6 text-center">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="label-image">
		                  <label for="file-input2" style="cursor: pointer;">
		                   <img class="modal-img rounded-circle" src="{{asset('images/Group 71.png')}}" id="output" height="100px" width="100px" >
		                  </label>
		                  <div class="file-name"><p class="text-center text-muted text-capitalize">upload image</p></div>
                      <br>
		                    {!! $errors->first('photo', '<p style="color: #B81111" id="photo-error" class="error" for="photo" style="color: #B81111">:message</p>') !!}
		                      <p id="error1" style="display:none; color:#B81111;">
		                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
		                      </p>
		                      <p id="error2" style="display:none; color:#B81111;">
		                        Maximum File Size Limit is 5MB.
		                      </p>
                          
                      <div class="progress d-none"  style="height:0.8rem">
                        <div class="progress-bar photo-progress" role="progressbar" style="width:0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                      <div id="photo-success"></div>

		                </div>
		                <input type="file" name="photo" id="file-input2" class="d-none" data-validate-field="photo" value="{{old('photo')}}" onchange="loadFile(event)">
                    </div>
                  </div>
                  <div class="col-6 text-center">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="label-video">
                      <label for="file-input1" style="cursor: pointer;">
                        <img class="modal-img" src="{{asset('images/video.png')}}" height="100px" width="100px">
                      </label>
                      <div class="file-name"><p class="text-center text-muted text-capitalize">upload video</p></div>
                      <br>
                      {!! $errors->first('video', '<label id="video-error" class="error" for="video">:message</label>') !!}
                      <p id="videoerror1" style="display:none; color:#B81111;">
                      Invalid Video Format! Video Format Must Be MP4, Webm, Flv.
                      </p>
                      <p id="videoerror2" style="display:none; color:#B81111;">
                      Maximum File Size Limit is 5MB.
                      </p>

                      <div class="progress d-none" style="height:0.8rem">
                        <div class="progress-bar video-progress" role="progressbar" style="width:0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                      <div id="video-success"></div>

                    </div>
                    <input type="file" name="video" id="file-input1" class="d-none" data-validate-field="video" value="{{old('video')}}">
                    </div>
                  </div>
                  @if(auth()->user()->role == 'admin')
                  <div class="col-12">
                    <div class="form-group">
                      @php $user[''] = 'Please Select Vendor'; @endphp
                      {{ Form::select('user_id', $user ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;' , 'data-validate-field' => 'user_id','id' => 'user_id']) }}

                      <p id="user-id-error" class="error d-none" for="title" style="color: #B81111"> User id field is required!</p>
                    </div>
                  </div>
                  @else
                      <div class="col-12">
                          <input type="text" hidden value="{{ auth()->id() }}" name="user_id"/>
                      </div>
                  @endif
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      @php $category[''] = 'Please Select Category'; @endphp
                      {{

                        Form::select('category_id', $category ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;' , 'data-validate-field' => 'category_id','id' => 'category_id'])
                      }}
                      <p id="category-id-error" class="error d-none" for="title" style="color: #B81111"> Category id field is required!</p>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('title',old('title'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Title' ,'id' => 'title','data-validate-field' => 'title')) }}
                      
                      <p id="title-error" class="error d-none" for="title" style="color: #B81111">Title field is required!</p>

                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="title-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email-id-floating-icon" class="d-none label-tags">TAGS<span style="color:red;">*</span></label>
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('tags',old('tags'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Tags', 'data-role' => 'tagsinput' ,'id' => 'tags' , 'data-validate-field' => 'tags')) }}

                      {!! $errors->first('tags', '<p id="tags-error" class="error" for="tags" style="color: #B81111">:message</p>') !!}

                      <label for="email-id-floating-icon">tags<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('site_url',old('site_url'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Site Url', 'data-validate-field' => 'site_url')) }}
                      
                      <p id="site-url-error" class="error d-none" for="title" style="color: #B81111">Site url field is required!</p>

                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="site_url-id-floating-icon">Site Url<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('address',old('address'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Address' ,'data-validate-field' => 'address')) }}
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
                      
                      <p id="price-error" class="error d-none" for="title" style="color: #B81111">Price field is required!</p>

                      <div class="form-control-position">
                        <i class="bx bx-dollar-circle"></i>
                      </div>
                      <label for="price-id-floating-icon">Price<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::textarea('description',old('description'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Description' ,'data-validate-field' => 'description')) }}
                      
                      <p id="description-error" class="error d-none" for="title" style="color: #B81111">Description field is required!</p>

                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="description-id-floating-icon">Description<span style="color:red;">*</span></label>
                    </div>
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

<!-- // jquery form -->
<script type="text/javascript">

    $(document).ready(function(){
      // var input = '22';

    $('form').ajaxForm({
      // data: formData,
      beforeSend:function(){

        $('#photo-success').empty();
      },
      uploadProgress:function(event, position, total, percentComplete)
      {

        $('.photo-progress').text(percentComplete + '%');
        $('.photo-progress').css('width', percentComplete + '%');
      },
      success:function(data)
      {
        if(data.errors)
        {
          console.log(data.errors)
          if(data.errors[0] != ''){
            $('#user-id-error').removeClass('d-none')
          }
          if(data.errors[1] != ''){
            $('#category-id-error').removeClass('d-none')
          }
          if(data.errors[2] != ''){
            $('#title-error').removeClass('d-none')
          }
          if(data.errors[3] != ''){
            $('#description-error').removeClass('d-none')
          }
          if(data.errors[4] != ''){
            $('#site-url-error').removeClass('d-none')
          }
          if(data.errors[5] != ''){
            $('#price-error').removeClass('d-none')
          }

        }
        if(data.photo_success)
        {

          $('.photo-progress').text('Uploaded');
          $('.photo-progress').css('width', '100%');
          $('#photo-success').html('<span class="text-success"><b>'+data.photo_success+'</b></span><br /><br />');
          $('#photo-success').append(data.image);
        }
        if(data.video_success)
        {

          $('.video-progress').text('Uploaded');
          $('.video-progress').css('width', '100%');
          $('#video-success').html('<span class="text-success"><b>'+data.video_success+'</b></span><br /><br />');
          $('#video-success').append(data.video);
        }
        if(data.data_save){
          $('p.alert-success').removeClass('d-none')
          $(window).scrollTop(0);
        }
      }
    });

});
</script>

<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>

<!-- tags input js  -->
<script src="{{ asset('admin/js/tagsinput.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>
<script type="text/javascript">

// new window.JustValidate('.js-form', {
//         rules: {
//             user_id: {
//                 required: true
//             },
//             category_id: {
//                 required: true
//             },
//             title: {
//                 required: true
//             },
//             site_url: {
//                 required: true
//             },
//             price: {
//                 required: true
//             },
//             description: {
//                 required: true
//             },
//         },
//         messages: {
//             user_id: {
//                 required: 'Please select vendor',
//             },
//             category_id: {
//                 required: 'Please select category',
//             },
//             title: {
//                 required: 'Title is required',
//             },
//             site_url: {
//                 required: 'Site url is required',
//             },
//             price: {
//                 required: 'Price is required',
//             },
//             description: {
//                 required: 'Description is required',
//             },
//         },
//     });

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    $('#output').css({'width':'100px','height':'100px'});
  };

  $('#file-input2').change(function(){
    let file_name = $(this)[0].files[0].name;
    let template = '<p class="text-center text-muted text-capitalize">upload image</p> <p class="text-center text-muted text-capitalize">'+file_name+'</p>';
    $(this).prev('div.label-image').find('div.file-name').html(template);

    $('.photo-progress').parent('div.progress').removeClass('d-none')
  })

  $('#file-input1').change(function(){
    let file_name = $(this)[0].files[0].name;
    let template = '<p class="text-center text-muted text-capitalize">upload video</p> <p class="text-center text-muted text-capitalize">'+file_name+'</p>';
    $(this).prev('div.label-video').find('div.file-name').html(template);

    $('.video-progress').parent('div.progress').removeClass('d-none')
  })


   // function click_auto(){
   //  setTimeout(function () {
   //      $('button[type="reset"]').click();
   //    }, 100)
   // }
  $('button[type="reset"]').click(function(){ 

    $("select#user_id").select2({
        placeholder: "Please Select Vendor"
    });
    $("select#category_id").select2({
        placeholder: "Please Select Category"
    });

    $('#output').attr('src','{{ asset("images/Group 71.png") }}');

    let label_image = '<p class="text-center text-muted text-capitalize">upload image</p>';
    let label_video = '<p class="text-center text-muted text-capitalize">upload video</p>';

    $('div.label-image').find('div.file-name').html(label_image)
    $('div.label-video').find('div.file-name').html(label_video)
    $('div.bootstrap-tagsinput').tagsinput('refresh');
    $('label.label-tags').removeClass('d-none')

    
  })
  
</script>
@endsection


