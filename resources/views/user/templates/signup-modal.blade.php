<!------- SIgnup Modal  -------->
      <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #800000;">
              <h5 class="modal-title text-white" id="exampleModalLongTitle" style="text-align: center;">Sign up</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body rounded-lg" style="background-color: #E8E8E8;">
              <div class="container">
                <div class="text-center">
                  <label for="file-input2">
                    <img class="modal-img rounded-circle" src="{{asset('images/Group 71.png')}}" id="output" >
                  </label>
                  <p class="text-center text-muted text-capitalize">upload image</p><br>
                    {!! $errors->first('photo', '<label id="photo-error" class="error" for="photo" style="color: #B81111">:message</label>') !!}
                      <p id="error1" style="display:none; color:#B81111;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                      </p>
                      <p id="error2" style="display:none; color:#B81111;">
                        Maximum File Size Limit is 5MB.
                      </p>
                </div>
                <form class="form-group mb-5 js-form" action="{{route('register')}}" enctype="multipart/form-data" method="post" >
                  @csrf
                  <center>
                    <input type="file" name="photo" id="file-input2" class="d-none" data-validate-field="photo"/ value="{{old('photo')}}" onchange="loadFile(event)">

                    <input type="text" name="name" placeholder="Full Name" data-validate-field="name" class="mt-4" value="{{old('name')}}">
                    <br>
                    {!! $errors->first('name', '<label id="name-error" class="error" for="name" style="color: #B81111">:message</label>') !!}
                    <br><br>

                    <input type="email" name="email" placeholder="Email Address" data-validate-field="email" value="{{old('email')}}">
                    <br>
                    {!! $errors->first('email', '<label id="email-error" class="error" for="email" style="color: #B81111">:message</label>') !!}
                    <br><br>
                    
                    <input type="password" name="password" placeholder="Password" data-validate-field="password" value="{{old('password')}}" id="password">
                    <br>
                    {!! $errors->first('password', '<label id="password-error" class="error" for="password" style="color: #B81111">:message</label>') !!}
                    <br><br>
                    
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" data-validate-field="password_confirmation" value="{{old('password_confirmation')}}" id="password_confirmation">
                    <br>
                    {!! $errors->first('password_confirmation', '<label id="password_confirmation-error" class="error" for="password_confirmation" style="color: #B81111">:message</label>') !!}
                    <br><br>

                    <input type="text" name="address" placeholder="Address" data-validate-field="address" value="{{old('address')}}">
                    <br>
                    {!! $errors->first('address', '<label id="address-error" class="error" for="address" style="color: #B81111">:message</label>') !!}
                    <br><br>

                    <input type="text" name="city" placeholder="City" data-validate-field="city" value="{{old('city')}}">
                    <br>
                    {!! $errors->first('city', '<label id="city-error" class="error" for="city" style="color: #B81111">:message</label>') !!}
                    <br><br>

                    <input type="text" name="country" placeholder="Country" data-validate-field="country" value="{{old('country')}}">
                    <br>
                    {!! $errors->first('country', '<label id="country-error" class="error" for="country" style="color: #B81111">:message</label>') !!}
                    <br><br>

                    <input type="text" name="phone" placeholder="Phone Number" data-validate-field="phone" value="{{old('phone')}}">
                    <br>
                    {!! $errors->first('phone', '<label id="phone-error" class="error" for="phone" style="color: #B81111">:message</label>') !!}
                    <br><br>

                  </center>
                
                <button class="btn btn-default text-uppercase text-white mb-5 mt-5" type="submit">Sign up</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
    $('#output').css({'width':'150px','height':'150px'});
  };
</script>
      <!------- SIgnIn Modal  -------->
      <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #800000;">
              <h5 class="modal-title text-white" id="exampleModalLongTitle" style="text-align: center;">Sign in</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body rounded-lg" style="background-color: #E8E8E8;">
              <div class="container mt-5">
                {{-- form  --}}
                <form method="POST" action="{{ route('user.login') }}">
                  @csrf
                  <div class="form-group mb-50">
                    <label class="text-bold-600" for="email">Email address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="text-bold-600" for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password">
                    @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                     @enderror
                  </div>
                  <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                    <div class="text-left">
                      <div class="checkbox checkbox-sm">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                          <small>Keep me logged in</small>
                        </label>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-default text-uppercase text-white mb-5">Sign in</button>
                </form>
                
              </div>
            </div>
          </div>
        </div>
      </div>

