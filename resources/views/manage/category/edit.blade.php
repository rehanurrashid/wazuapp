@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Update Category')

@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <div class="row match-height">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{(isset($category)) ? 'Update' : 'Add'}} Category</h4>
        </div>
        <br>
        <div class="card-content">
          <div class="card-body">
            @if(isset($category))
                {{ Form::model($category,['method'=>'put','route' => ['categories.update',$category->id], 'enctype' =>'multipart/form-data', 'class' => 'js-form']) }}
            @else
              {{ Form::open(['route' => 'categories.store', 'enctype' =>'multipart/form-data', 'class' => 'js-form','method' => 'post']) }}
            @endif
              <div class="form-body">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      @php $parent_category[''] = 'Please Select Parent Category'; @endphp
                      {{ 

                          Form::select('parent_id', $parent_category ,null, ['class' => 'form-control select2', 'style'=> 'margin-bottom:20px;']) 
                      }}
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-label-group position-relative has-icon-left">
                      {{ Form::text('name',old('name'),array('class'=>'form-control', 'style'=> 'margin-bottom:10px;','placeholder'=>'Enter Product Title' ,'id' => 'title','data-validate-field' => 'name')) }}
                      {!! $errors->first('name', '<p id="name-error" class="error" for="name" style="color: #B81111">:message</p>') !!}
                      <div class="form-control-position">
                        <i class="bx bx-user"></i>
                      </div>
                      <label for="name-id-floating-icon">Title<span style="color:red;">*</span></label>
                    </div>
                  </div>
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-1 mb-1">{{(isset($category)) ? 'Update' : 'Save'}}</button>
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
        },
        messages: {

            name: {
                required: 'Name is required',
            },
        },
    });
</script>
@endsection


