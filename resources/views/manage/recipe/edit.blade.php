@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Update Recipe')

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
    <p id="alert" class="alert alert-success d-none">Recipe Updated Successfully</p>
  </div>

<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-12">
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
                    <input type="file" name="photo" id="file-input2" class="d-none" data-validate-field="{{ (!empty($recipe->photo) ? '' : 'photo')}}" value="{{old('photo')}}" onchange="loadFile(event)">
                    </div>
                    @if(!empty($recipe->image))
                      <img src="{{$recipe->image}}" class="img-thumbnail" height="200px" width="200px">
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
                      <div class="file-name"><p class="text-center text-muted text-capitalize">upload image</p></div>
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
                    @if(!empty($recipe->video))
                      <video controls width="350" class="img-thumbnail">

                          <source src="{{$recipe->video}}"
                                  type="video/webm">

                          Sorry, your browser doesn't support embedded videos.
                      </video>
                      <br>
                    @else
                    <h4 class="text-info">No Video Uploaded Yet!</h4>
                    @endif
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('title',old('title'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Title' ,'id' => 'title','data-validate-field' => 'title')) }}
                      {!! $errors->first('title', '<p id="title-error" class="error" for="title" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="title-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email-id-floating-icon" class="d-none label-tags">INGREDIENTS<span style="color:red;">*</span></label>
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('ingredients',old('ingredients'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Ingredients', 'data-role' => 'tagsinput' ,'id' => 'ingredients' , 'data-validate-field' => 'ingredients')) }}

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
                      {{ Form::text('address',old('address'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Address (Kitchen Location)' ,'data-validate-field' => 'address')) }}
                      {!! $errors->first('address', '<p style="color: #B81111" id="address-error" class="error" for="address">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="email-id-floating-icon">Address<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('price',old('price'),array('class'=>'form-control price', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Recipe Price' ,'data-validate-field' => 'price')) }}

                      {!! $errors->first('price', '<p style="color: #B81111" id="price-error" class="error" for="price">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-dollar-circle"></i>
                      </div>
                      <label for="price-id-floating-icon">Price<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($recipe)) ? 'Update' : 'Save'}}</button>
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

        // searchable dropdown
    // $('.select2').select2();

    //     new window.JustValidate('.js-form', {
    //     rules: {
    //         ingredients: {
    //             required: true
    //         },
    //         title: {
    //             required: true
    //         },
    //         recipe: {
    //             required: true
    //         },
    //     },
    //     messages: {
    //         ingredients: {
    //             required: 'Ingredients are required',
    //         },
    //         title: {
    //             required: 'Title is required',
    //         },
    //         recipe: {
    //             required: 'Recipe description is required',
    //         },
    //     },
    // });

      var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
      $('#output').css({'width':'100px','height':'100px'});
    };

  $(document).ready(function(){

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

    $('#reset').click(function(){ 

      $('#output').attr('src','{{ asset("images/Group 71.png") }}')
      $('div.bootstrap-tagsinput').tagsinput('removeAll');
      $('label.label-tags').removeClass('d-none')

      let label_image = '<p class="text-center text-muted text-capitalize">upload image</p>';
      let label_video = '<p class="text-center text-muted text-capitalize">upload video</p>';

      $('div.label-image').find('div.file-name').html(label_image)
      $('div.label-video').find('div.file-name').html(label_video)

      $('textarea[name="recipe"]').text('')
      $('.js-form').find('input[type=text]').val('')

      $('img.img-thumbnail').addClass('d-none')
      $('video.img-thumbnail').addClass('d-none')
    })
  })
</script>
@endsection


