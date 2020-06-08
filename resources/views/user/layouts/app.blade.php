<!DOCTYPE html>
<html lang="en">
<head>
    @include("user.templates.head")
</head>
<body>
@yield('content')
</body>
</html>
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

    // Create a Stripe client.
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

