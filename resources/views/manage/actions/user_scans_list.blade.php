
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning w-50 total-scans" data-toggle="modal" 
data-target="{{ ($customer->scans_count != 0) ? '#exampleModalCenter' : ''}}">
  {{ $customer->scans_count }}
</button>
    @if(count($customer->scans))
        <p class="total-products-visited d-none"> {{ count($customer->scans) }}</p>
       <table class="table table-hover product-details d-none">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col" >Image</th>
              <th scope="col" class="w-25">Visit Site</th>
              <th scope="col">Price($)</th>
              <th scope="col">Total Scans</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customer->scans as $product)
                <tr>
                  <td class="title{{$loop->iteration}}">{{ $product->title }}</td>
                  <td class="image{{$loop->iteration}}">
                    <img src="{{ $product->image }}" class="img-thumbnail" width="100%" height="100%">
                  </td>
                  <td class="site_url{{$loop->iteration}}">
                    <a href="{{ $product->site_url }}" class="btn btn-outline-dark">Visit Site</a>
                  </td>
                  <td class="price{{$loop->iteration}}">{{ $product->price }}</td>
                  <td class="scans_count{{$loop->iteration}}">{{ $product->scans_count }}</td>
                </tr>
            @endforeach
            
          </tbody>
        </table> 
        
    @endif
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Products Visited: <span class="products-visited"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body product-list">

        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
