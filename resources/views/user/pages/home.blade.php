<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
  
     <!-- Slick Slider Includes -->
  
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}">

  <title>Home | Wazu</title>
</head>

<body class="p-0">
  <section class="navb-section">
    <div class="container-fluid">
      <!------------------Header Section---------------------------->
        @include('user.templates.header')

      <!------- SIgnup Modal  -------->
      @include('user.templates.signup-modal')

      <!------- Pricing Modal  -------->
      @include('user.templates.price-modal')



        <div class="container pt-5 pb-5">
          <div class="row mt-5">
            <div class="col-md-7 m-auto">
              <div class="top-text-1" style="width: 90%">
                <h1 class="text-white">An augmented reality mobile application that aims to enhance retail shopping experience anywhere.</h1>
                <p class="text-white font-style-1 text-top">Help customers recognize your products, extend customer lifetime value through customizable brand experiences and direct them directly to your website or social media channels.</p>
              </div>
              <div class="left-center mt-4">
                <button class="btn btn-dark btn-b text-capitalize rounded">contact us</button>
              <button class="btn btn-dark btn-b ml-3 text-capitalize rounded">download</button>
            </div>
            </div>
            <div class="col-md-5">
              <img class="img-fluid mt-5 mt-md-0" src="images/banner.png" width="400">
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <section class="features-we-offer">
    <div class="empty-2"></div>
    <div class="container-fluid">
      <div class="row chooos-div">
        <div class="col-md-6">
          <h3 class="text-capitalize text-left mb-5">Features <span class="font-weight-bold">we offer</span></h3>
          <h6 class="text-capitalize"><span><img class="p-2" src="images/bullet.png">subscriptions for products</span>
          </h6>
          <p class="text-muted">Lorem Ipsum is simply dummy text of the printing <br>and typesetting industry. Lorem
            Ipsum has been the <br>industry's standard dummy text ever since the 1500s,<br> when an unknown printer took
            a galley of type and <br>scrambled it to make a type specimen book</p>
        </div>
        <div class="col-md-6">
          <img class="w-100" src="images/Group 61.png">
        </div>
        <div class="empty-2"></div>
      </div>
    </div>
  </section>
  <section class="how-we-work" id="Technology">
    <div class="container">
      <h3 class="text-white text-center text-capitalize p-5">how <span class="font-weight-bold">we work</span></h3>
      <p class="text-white text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
        Ipsum has been the industry's standard</p>
      <p class="text-white text-center">Lorem Ipsum is simply dummy text. Lorem Ipsum has been the industry's standard
      </p>
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="white-back text-center p-3">
            <img src="images/Ai.png"> <span class="ml-3">Artificial inteligence</span>
          </div>
        </div>
        <div class="col-md-3 mt-4 mt-md-0">
          <div class="white-back text-center p-3 ml-3">
            <img src="images/image processing.png" class="mt-1"><span class="ml-3">Image Processing</span>
          </div>
        </div>
        
      </div>
      <div class="empty-2"></div><br>
      <div class="work-div shadow">
        <div class="container">
          <div class="row justify-content-center">
            <img src="images/step 1.png" style=" margin-top: 1rem; width: auto;">
            <img src="images/loading.png" style="width: 15%; height: 12px; margin-top: 6rem; margin-left: 2rem;">
            <img src="images/step 2.png" style="margin-left: 2rem; margin-top: 1.5rem; width: auto;">
            <img src="images/loading.png" style="width: 15%; height: 12px; margin-top: 6rem; margin-left: 2rem;">
            <img src="images/step 3.png" style="margin-left: 2rem; margin-top: 1.5rem; width: auto;">
          </div>
        </div>
      </div>
    </div>
    <div class="empty-2"></div>
  </section>
  <div class="empty-2"></div>
  <div class="empty-2"></div>
  <section class="powerful-features" id="features">
    <h3 class="text-center text-capitalize">powerful <span class="font-weight-bold">features</span></h3>
    <p class="text-center text-muted mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
    </p>
    <p class="text-center text-muted mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting
      industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br>Lorem Ipsum is simply dummy
      text of the printing and typesetting industry.Lorem </p>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="empty-2"></div>
            <div class="col-md-10">
              <div class="pr-1">
                <h5 class="text-capitalize">product scanning</h5>
                <p class="mb-5 text-muted">lorem ipsum is a dummy text <br>lorem ipsum is a dummy text lorem ipsum
                  <br>is a dummy text lorem ipsum <br>is a dummy text lorem ipsum is a dummy</p>
              </div>
            </div>
            <div class="col-md-2">
              <img class="img-pr" src="images/scaning.png">
            </div>
          </div>
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-10">
              <div class="pr-1">
                <h5 class="text-capitalize">retrieve results</h5>
                <p class=" mb-5 text-muted">lorem ipsum is a dummy text <br>lorem ipsum is a dummy text lorem ipsum
                  <br>is a dummy text lorem ipsum <br>is a dummy text lorem ipsum is a dummy</p>
              </div>
            </div>
            <div class="col-md-2">
              <img class="img-pr" src="images/results.png">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <img src="images/phone 1.png" style="display: block; margin: auto; width: 75%; margin-top: 2rem;">
        </div>
        <div class="col-md-4">
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-2">
              <img class="img-pr" src="images/shop.png">
            </div>
            <div class="col-md-10 pl-4">
              <div class="pr-2">
                <h5 class="text-capitalize">shop online</h5>
                <p class=" mb-5 text-muted">lorem ipsum is a dummy text <br>lorem ipsum is a dummy text lorem ipsum
                  <br>is a dummy text lorem ipsum <br>is a dummy text lorem ipsum is a dummy</p>
              </div>
            </div>
          </div>
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-2">
              <img class="img-pr" src="images/process.png">
            </div>
            <div class="col-md-10 pl-4">
              <div class="pr-2">
                <h5 class="text-capitalize">image processing</h5>
                <p class=" mb-5 text-muted">lorem ipsum is a dummy text <br>lorem ipsum is a dummy text lorem ipsum
                  <br>is a dummy text lorem ipsum <br>is a dummy text lorem ipsum is a dummy</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="empty-2"></div>
  <section class="explore-our-app">
    <h3 class="text-capitalize text-center mb-4">explore <span class="font-weight-bold">our app</span></h3>
    <p class="text-center text-muted">lorem ipsum has been the industry's standard dummy text ever</p>
    <div class="container">
      <div class="center slider pt-4 pb-5 ">
        <div>
          <img src="images/screen 1.png">
        </div>
        <div>
          <img src="images/screen 2.png">
        </div>
        <div>
          <img src="images/screen 3.png">
        </div>
        <div>
          <img src="images/screen 4.png">
        </div>
        <div>
          <img src="images/screen 3.png">
        </div>
        <div>
          <img src="images/screen 1.png">
        </div>
        <div>
          <img src="images/screen 2.png">
        </div>
        <div>
          <img src="images/screen 3.png">
        </div>
      </div>
    </div>

  </section>
  <section class="choos-us" style="background-color: #F8F8F8">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="chooos-div">
            <h3 class="text-capitalize pt-5">Why choos <span class="font-weight-bold">us</span></h3>
            <p class="text-muted mb-5">It's all at your fingertips! The quality you need! Go ahead, Download us.</p>
            <div class="services-div p-4 mb-4 shadow">
              1. Store and Product maintenance
            </div>
            <div class="services-div p-4 mb-4 shadow">
              2. Product Management
            </div>
            <div class="services-div p-4 mb-4 shadow">
              3. Stats
            </div>
            <div class="services-div p-4 mb-4 shadow">
              4. Communication
            </div>
          </div>
        </div>
        <div class="col-md-6 p-0 m-0">
          <div class="empty-2"></div>
          <div class="choose-image-div">
            <img src="images/why us.png">
          </div>
        </div>
      </div>
    </div>
    <div class="empty-2"></div>
  </section>


  <!------------------Footer Section---------------------------->
        @include('user.templates.footer')


<!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).on('ready', function () {

      $(".center").slick({
        dots: false,
        infinite: true,
        centerMode: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              dots: false
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });

    });
  </script>
<!-- validation -->
<script type="text/javascript" src="{{ asset('admin/js/imageValidate.js') }}"></script>

<script src="{{ asset('js/just-validate.min.js') }}"></script>

<script type="text/javascript">

        new window.JustValidate('.js-form', {
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            country: {
                required: true
            },
            photo: {
                required: true
            },
            phone: {
                required: true
            },
            password : {
                strength: {
                default: true,

              },
            },
            password_confirmation: {
              equalTo: "#password"
            },
        },
        messages: {
            name: {
                required: 'Full name is required',
            },
            email: {
                required: 'Email address is required',
                email: 'Please enter a valid email address',
            },
            address: {
                required: 'Address is required',
            },
            city: {
                required: 'City is required',
            },
            country: {
                required: 'Country is required',
            },
            photo: {
                required: 'Image is required',
            },
            phone: {
                required: 'Phone number is required',
            },

        },
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    
    @if ($errors->any())
      window.$('#exampleModalCenter').modal('show'); 
    @endif

    @if(Session::has('message'))
        window.$('#exampleModalCenter2').modal('show'); 
    @endif

    $('.buy-now').click(function(){

      var plan_id = $(this).parents('.card-2').find('p.plan-id').text();
      var user_id = '{{ (!empty(Auth::user()->id)) ? Auth::user()->id : '' }}';
      var host = "{{URL::to('/')}}";

      $.ajax({
           type: "POST",
           url: host+'/activate-plan',
           data: {"_token": "{{ csrf_token() }}",user_id:user_id, plan_id:plan_id},
           success: function( response ) {

              if(response.status == true){
                window.location.replace('admin/dashboard');
              }
              else if(response.status == false){
                alert(response.message)
              }

           },
           error: function(response){

              if(response.status == false){
                alert(response.message)
              }
           }
      });
    })

  })
</script>

</body>

</html>
