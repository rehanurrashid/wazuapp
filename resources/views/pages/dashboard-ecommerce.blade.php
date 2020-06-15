@extends('layouts.contentLayoutMaster')
{{-- page Title --}}
@section('title','Dashboard Ecommerce')
{{-- vendor css --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/charts/apexcharts.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/swiper.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/dashboard-ecommerce.css')}}">
@endsection

@section('content')

<section id="default-breadcrumb">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dashboard</h4>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
      <div class="row">
        <div class="col-lg-12">
            <div>
                @if(Session::has('authenticated'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('authenticated') }}</p>
                @endif
            </div>
            <div>
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
                @endif
            </div>
            <div>
                @if(Session::has('updated'))
                    <p class="alert {{ Session::get('alert-class', 'alert-primary') }}">{{ Session::get('updated') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('vendor-scripts')
<script src="{{asset('vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('vendors/js/extensions/swiper.min.js')}}"></script>
@endsection

@section('page-scripts')
<script src="{{asset('js/scripts/pages/dashboard-ecommerce.js')}}"></script>
@endsection

