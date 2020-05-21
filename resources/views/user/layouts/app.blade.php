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
                window.location.replace('dashboard-ecommerce');
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

