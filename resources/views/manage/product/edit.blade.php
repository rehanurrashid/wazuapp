@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Update Product')

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
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/ui/plyr.css')}}">
@endsection

@section('content')

 <div>
    <p id="alert" class="alert alert-success d-none">Product Updated Successfully</p>
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
                {{ Form::model($product,['method'=>'put','route' => ['products.update',$product->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
              {{ Form::open(['route' => 'products.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                 <div class="col-6 text-center mb-3">
                    <div class="form-label-group position-relative has-icon-left">
                      <div class="label-image">
                      <label for="file-input2" style="cursor: pointer;">
                        <img class="modal-img rounded-circle" src="{{asset('images/Group 71.png')}}" id="output" height="100px" width="100px">
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
                    @if(!empty($product->image))
                      <img src="{{$product->image}}" class="img-thumbnail" height="200px" width="200px">
                    @else
                    <h4 class="text-info">No Image Uploaded Yet!</h4>
                    @endif
                  </div>
                  <div class="col-6 text-center mb-3">
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
                    @if(!empty($product->video))
                      <video controls width="350" class="img-thumbnail">

                          <source src="{{$product->video}}"
                                  type="video/webm">

                          Sorry, your browser doesn't support embedded videos.
                      </video>
                      <br>
                    @else
                    <h4 class="text-info">No Video Uploaded Yet!</h4>
                    @endif
                  </div>
                  @if(auth()->user()->role == 'admin')
                  <div class="col-12">
                    <div class="form-group">
                      @php $user[''] = 'Please Select Vendor'; @endphp

                      {{ Form::select('user_id', $user ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;' , 'data-validate-field' => 'user_id' ,'id' => 'user_id']) }}

                      <div id="user_id_error" ></div>

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

                        Form::select('category_id', $category ,null, ['class' => 'form-control select2 ', 'style'=> 'margin-bottom:20px;' , 'data-validate-field' => 'category_id','id' => 'category_id'])
                      }}

                      <div id="category_id_error" ></div>
                    </div>
                  </div>
                  <br>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('title',old('title'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Title' ,'id' => 'title','data-validate-field' => 'title')) }}
                      

                      <div id="title_error" ></div>

                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="title-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email-id-floating-icon" class="d-none label-tags">tags<span style="color:red;">*</span></label>
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('tags',old('tags'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Tags', 'data-role' => 'tagsinput' ,'id' => 'courseTags' , 'data-validate-field' => 'tags')) }}

                      {!! $errors->first('tags', '<p id="tags-error" class="error" for="tags" style="color: #B81111">:message</p>') !!}

                      <label for="email-id-floating-icon">Tags<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('site_url',old('site_url'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Site Url', 'data-validate-field' => 'site_url')) }}
                      

                      <div id="site_url_error" ></div>

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
                      
                      <div id="price_error" ></div>

                      <div class="form-control-position">
                        <i class="bx bx-dollar-circle"></i>
                      </div>
                      <label for="price-id-floating-icon">Price<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::textarea('description',old('description'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Description' ,'data-validate-field' => 'description')) }}
                      

                      <div id="description_error" ></div>
                      
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="description-id-floating-icon">Description<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($product)) ? 'Update' : 'Save'}}</button>
                    <a id="reset" class="btn btn-light-secondary mr-1 mb-1 "  style="cursor: pointer;">Reset</a>
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
<script src="{{asset('vendors/js/ui/plyr.min.js')}}"></script>
@endsection

<!-- // jquery form -->
<script type="text/javascript">

    $(document).ready(function(){
      // var input = '22';

    $('#myForm').ajaxForm({
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
        console.log(data)
        if(data.errors)
        {
          alert('error')
          // $('.photo-progress').text('0%');
          // $('.photo-progress').css('width', '0%');
          // $('#photo-success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
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
      },
      error: function (xhr) {
         $.each(xhr.responseJSON.errors, function(key,value) {
          console.log(key)
           $('#'+key+'_error').html('<p class="error text-danger">'+value+'</p');
       }); 
      },
    });

});
</script>

<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>
<script src="{{asset('js/scripts/forms/select/form-select2.js')}}"></script>
<script src="{{asset('js/scripts/extensions/ext-component-media-player.js')}}"></script>

<!-- tags input js  -->
<script src="{{ asset('admin/js/tagsinput.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>
<script type="text/javascript">


    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    $('#output').css({'width':'100px','height':'100px'});
  }

  $('#file-input2').change(function(){
      let file_name = $(this)[0].files[0].name;
      let template = '<p class="text-center text-muted text-capitalize">upload image</p> <p class="text-center text-muted text-capitalize">'+file_name+'</p>';
      $(this).prev('div.label-image').find('div.file-name').html(template);
      $(this).parents('div.form-label-group').next('h4.text-info').addClass('d-none')
    })

    $('#file-input1').change(function(){
      let file_name = $(this)[0].files[0].name;
      let template = '<p class="text-center text-muted text-capitalize">upload video</p> <p class="text-center text-muted text-capitalize">'+file_name+'</p>';
      $(this).prev('div.label-video').find('div.file-name').html(template);
      $(this).parents('div.form-label-group').next('h4.text-info').addClass('d-none')
    })

$(document).ready(function(){
  
var timer = null;

    $('#reset').click(function(){ 

      $("select#user_id").select2({
          placeholder: "Please Select Vendor"
      });
      $("select#category_id").select2({
          placeholder: "Please Select Category"
      });

      $('#output').attr('src','{{ asset("images/Group 71.png") }}')
      $('div.bootstrap-tagsinput').tagsinput('removeAll');
      $('label.label-tags').removeClass('d-none')

      let label_image = '<p class="text-center text-muted text-capitalize">upload image</p>';
      let label_video = '<p class="text-center text-muted text-capitalize">upload video</p>';

      $('div.label-image').find('div.file-name').html(label_image)
      $('div.label-video').find('div.file-name').html(label_video)

      $('textarea[name="description"]').text('')
      $('.js-form').find('input[type=text]').val('')

      $('img.img-thumbnail').addClass('d-none')
      $('video.img-thumbnail').addClass('d-none')
    function explode(){
      // alert('')
      $('button[type="reset"]').click()
    }
    timer = setTimeout(explode, 1000);

  })
  setInterval(function(){ clearTimeout(timer); }, 3000);
  })
</script>
@endsection


