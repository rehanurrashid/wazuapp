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
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.png')}}">
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
                <a class="btn btn-dark btn-b text-capitalize rounded text-light" href="mailto:support@wazuapp.com">contact us</a>
              <a class="btn btn-dark btn-b ml-3 text-capitalize rounded text-light" href="{{url('https://apps.apple.com/us/app/wazu/id1511788564')}}" target="_blank">download</a>
            </div>
            </div>
            <div class="col-md-5">
              <img class="img-fluid mt-5 mt-md-0" src="{{asset('images/banner.png')}}" width="400">
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
          <h6 class="text-capitalize"><span><img class="p-2" src="{{asset('images/bullet.png')}}">subscriptions for products</span>
          </h6>
          <p class="text-muted w-75">First impressions mean everything with the customers discovering your product.<br>
          Extend your customer lifetime value by introducing the product to your customers as if you were there engaging with them in person. Working with WAZU allows your customers to spend more time focusing on your products, allowing them to remember details and your brand values. <br>
          Delight your customers by adding your products to our database by signing up to one of our subscriptions.</p>
        </div>
        <div class="col-md-6">
          <img class="w-100" src="{{asset('images/Group 61.png')}}">
        </div>
        <div class="empty-2"></div>
      </div>
    </div>
  </section>
  <section class="how-we-work" id="Technology">
    <div class="container">
      <h3 class="text-white text-center text-capitalize p-5 mt-3">how <span class="font-weight-bold">we work</span></h3>
      <p class="text-white text-center">With WAZU customers take pictures (no QR codes , no barcodes) and find details about the products that they’re interested in.
      <br>
      WAZU allows you to create custom experiences for your customers. <br> You can run promotions, educate customers or send them directly to your personal website in seconds. <br> Easily discover where you need retail distribution by learning the location of the customers are looking for your products.
      </p>
      <div class="row justify-content-center">
        <div class="col-md-3">
          <div class="white-back text-center p-3">
            <img src="{{asset('images/Ai.png')}}"> <span class="ml-3">Artificial inteligence</span>
          </div>
        </div>
        <div class="col-md-3 mt-4 mt-md-0">
          <div class="white-back text-center p-3 ml-3">
            <img src="{{asset('images/image processing.png')}}" class="mt-1"><span class="ml-3">Image Processing</span>
          </div>
        </div>
        
      </div>
      <div class="empty-2"></div><br>
      <div class="work-div shadow">
        <div class="container">
          <div class="row justify-content-center">
            <img src="{{asset('images/step 1.png')}}" style=" margin-top: 1rem; width: auto;">
            <img src="{{asset('images/loading.png')}}" style="width: 15%; height: 12px; margin-top: 6rem; margin-left: 2rem;">
            <img src="{{asset('images/step 2.png')}}" style="margin-left: 2rem; margin-top: 1.5rem; width: auto;">
            <img src="{{asset('images/loading.png')}}" style="width: 15%; height: 12px; margin-top: 6rem; margin-left: 2rem;">
            <img src="{{asset('images/step 3.png')}}" style="margin-left: 2rem; margin-top: 1.5rem; width: auto;">
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
    <button class="btn btn-default text-uppercase text-white mb-5 mt-5" href="#SignUp" data-toggle="modal" data-target="#exampleModalCenter">SignUp Now</button>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="empty-2"></div>
            <div class="col-md-7 offset-3">
              <div class="">
                <h5 class="text-capitalize">product scanning</h5>
                <p class="mb-5 text-muted">Customers take pictures of products in WAZU recognizes your product using  artificial intelligence in seconds. <br> There is no need for  you to change your packaging and add a QR code or a barcode.</p>
              </div>
            </div>
            <div class="col-md-2 p-0">
              <img class="img-pr" src="{{asset('images/scaning.png')}}">
            </div>
          </div>
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-7 offset-3">
              <div class="">
                <h5 class="text-capitalize">retrieve results</h5>
                <p class=" mb-5 text-muted">WAZU shifts through millions<br> of  inventory to find your <br>product quickly</p>
              </div>
            </div>
            <div class="col-md-2 p-0">
              <img class="img-pr" src="{{asset('images/results.png')}}">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <img src="{{asset('images/phone 1.png')}}" style="display: block; margin: auto; width: 75%; margin-top: 2rem;">
        </div>
        <div class="col-md-4">
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-2">
              <img class="img-pr" src="{{asset('images/shop.png')}}">
            </div>
            <div class="col-md-7 offset-1">
              <div class="pr-2">
                <h5 class="text-capitalize">shop online</h5>
                <p class=" mb-5 text-muted">Two clicks is all it takes for customers to reach a destination of your choice. <br>
          We can forward customers  <br>to your personal shopping  <br>website or social media.</p>
              </div>
            </div>
          </div>
          <div class="empty-2"></div>
          <div class="row">
            <div class="col-md-2">
              <img class="img-pr" src="{{asset('images/process.png')}}">
            </div>
            <div class="col-md-7 offset-1">
              <div class="pr-2">
                <h5 class="text-capitalize">image processing</h5>
                <p class=" mb-5 text-muted">If you need more reviews WAZU can facilitate product sampling to authentic customers who love to try your brand.</p>
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
    <p class="text-center text-muted">If you need more reviews WAZU can facilitate product sampling to authentic customers who love to try your brand.</p>
    <div class="container">
      <div class="center slider pt-4 pb-5 ">
        <div>
          <img src="{{asset('images/screen 1.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 2.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 3.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 4.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 3.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 1.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 2.png')}}">
        </div>
        <div>
          <img src="{{asset('images/screen 3.png')}}">
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
            <img src="{{asset('images/why us.png')}}">
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

    @if (Session::has('sign-up-error'))
      window.$('#exampleModalCenter').modal('show');
      window.$('#exampleModalCenter').addClass('show')
    @endif

    @if (Session::has('sign-in-error'))
      window.$('#exampleModalCenter1').modal('show');
      window.$('#exampleModalCenter1').addClass('show')
    @endif

    @if(Session::has('successfully-registered') || Session::has('plan_failed') || Session::has('plan_already_activated') || Session::has('not-authorized'))
        window.$('#exampleModalCenter2').modal('show'); 
        window.$('#exampleModalCenter2').addClass('show')
    @endif

    $('#exampleModal').on('hidden.bs.modal', function () {
      $('#exampleModalCenter2').css('z-index','')
    })

    $('.buy-now').click(function(){
      @if(Auth::check())

      $('#exampleModalCenter2').css('z-index',1000)
      $('#exampleModal').css('z-index', 1050);


      $(this).parents('.row').find('button.buy-now-selected').removeClass('buy-now-selected')
      $(this).addClass('buy-now-selected')

      $('#checkout-form').removeClass('d-none')
      var plan_price = $(this).parents('.card-2').find('h3.plan-price').text();
      var plan_id = $(this).parents('.card-2').find('p.plan-id').text();
      $('#plan-price-form').val(plan_price)
      $('#plan-id-form').val(plan_id)

      @else
        window.location.replace('admin/login');
      @endif
    })

    // pk_test_w1bPPgyQs8vPVM59Bc2FK03A00mJZV31dU test key
    // Create a Stripe client.       pk_live_9S6yUbrolaJSfrXIfwd5nj8F
var stripe = Stripe('pk_live_9S6yUbrolaJSfrXIfwd5nj8F');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
  })

</script>

</body>

</html>
