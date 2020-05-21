@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Add Message')

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($message)) ? 'Update' : 'Add'}} Message</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($message))
                {{ Form::model($message,['method'=>'put','route' => ['messages.update',$message->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
            	{{ Form::open(['route' => 'messages.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('title',old('title'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Message Title' ,'id' => 'title','data-validate-field' => 'title')) }}
                      {!! $errors->first('title', '<p id="title-error" class="error" for="title" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="title-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::textarea('body',old('body'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Message Description' ,'data-validate-field' => 'body')) }}
                      {!! $errors->first('body', '<p style="color: #B81111" id="body-error" class="error" for="body">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-mail-send"></i>
                      </div>
                      <label for="body-id-floating-icon">Description<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($message)) ? 'Update' : 'Save'}}</button>
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
            title: {
                required: true
            },
            description: {
                required: true
            },
        },
        messages: {
            title: {
                required: 'Title is required',
            },
            description: {
                required: 'Description is required',
            },
        },
    });
</script>
@endsection


