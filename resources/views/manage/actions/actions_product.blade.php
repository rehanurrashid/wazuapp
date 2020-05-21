@if(isset($product))
    @if(!$product->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('products.edit', [$product->id]) }}" title="Edit Product"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('products/{{$product->id}}')" title="Suspend Product" class="delete-row delete-color" data-id="{{ $product->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('products/restore/{{$product->id}}')" title="Restore Product" class="restore-row restore-color" data-id="{{ $product->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('products/deletePermanently/{{$product->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $product->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
