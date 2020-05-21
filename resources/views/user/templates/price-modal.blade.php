<!------- Pricing Modal  -------->
      <div class="modal bd-example-modal-lg" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #800000;">
              <h5 class="modal-title text-white text-capitalize" id="exampleModalLongTitle" style="text-align: center;">Choose Your Plan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body rounded-lg" style="background-color: #E8E8E8;">
              <div class="container">
                <div>
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</p>
                    @endif
                </div>
                <div>
                    @if(Session::has('check'))
                        <p class="alert alert-warning">{{Session::get('check') }}</p>
                    @endif
                </div>
                <h5 class="text-center text-capitalize mt-4">plans & <span class="font-weight-bold">Pricing</span></h5>
                <p class="text-muted text-center mb-5">lorem ipsum has been the industry's standard dummy text ever</p>
                <div class="row mb-5">

                @forelse($plans as $plan)
                  <div class="col-md-4 ">
                    <div class="card-2">
                      <h2 class="text-white text-center basic">{{$plan->name}}</h2>
                      <p class="text-white p-3 text-center">
                      {{$plan->description}}
                    </p>
                    <p class="plan-id d-none">{{$plan->id}}</p>
                      <h3 class="text-center text-white">$ {{$plan->price}}</h3>
                      <div class="products">
                        <ul style="margin-top: 7.5rem; list-style-type: none; line-height: 2;">
                          <li><img src="images/tick.png"> number of products</li>
                          <li><img src="images/tick.png"> number of products</li>
                          <li><img src="images/tick.png"> number of products</li>
                          <li><img src="images/tick.png"> number of products</li>
                          <li><img src="images/tick.png"> number of products</li>
                        </ul>
                        <button class="btn btn-default mt-4 mb-4 text-white buy-now">Buy Now</button>
                      </div>
                    </div>
                  </div>
                @empty
                  <h4 class="text-dark">No plans yet!</h4>
                @endforelse

                </div>
                <!--  <button class="btn btn-default text-uppercase text-white mb-5">Sign up</button> -->
              </div>
            </div>
          </div>
        </div>
      </div>