@extends('layouts.contentLayoutMaster')

{{-- title --}}
@section('title','Recipe Details')


@section('content')


<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
  <!-- Dashboard content -->
                <div class="row">
                    <div class="col-xl-12">

                        <!-- /quick stats boxes -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header header-elements-inline">
                                            <h6 class="card-title">Recipe Details</h6>
                                            <div class="header-elements">
                                                <div class="list-icons">
                                                    <a class="list-icons-item" data-action="collapse"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Title: </h4>
                                                </div>
                                                <div class="col">
                                                    <h4>{{$recipe->title}}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Ingredients: </h4>
                                                </div>
                                                <div class="col">
                                                    <h4>{{$recipe->ingredients}}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Recipe </h4>
                                                </div>
                                                <div class="col">
                                                    <h4>{{$recipe->recipe}}</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Image: </h4>
                                                </div>
                                                <div class="col">
                                                    @if($recipe->image != Null)
                                                    <div class="form-group ml-3">
                                                        <img src="{{$recipe->image}}" alt="" class="img-thumbnail" width="200px" height="200px">
                                                    </div>
                                                    @else
                                                    <h4 class="text-info">No Image Uploaded Yet!</h4>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4 class="float-right">Video: </h4>
                                                </div>
                                                <div class="col">
                                                    @if($recipe->video != Null)
                                                    <div class="form-group ml-3">
                                                        <video width="400" controls>
                                                          <source src="{{$recipe->video}}" type="video/mp4">
                                                          <source src="" type="video/ogg">
                                                          Your browser does not support HTML video.
                                                        </video>
                                                    </div>
                                                    @else
                                                    <h4 class="text-info">No Video Uploaded Yet!</h4>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>


                    </div>
                </div>
</section>
<!-- // Basic multiple Column Form section end -->
@endsection



