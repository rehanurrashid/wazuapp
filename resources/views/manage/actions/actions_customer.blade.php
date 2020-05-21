@if(isset($customer))
    @if(!$customer->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('customers.edit', [$customer->id]) }}" title="Edit Customer"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('customers/{{$customer->id}}')" title="Suspend Customer" class="delete-row delete-color" data-id="{{ $customer->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('customers/restore/{{$customer->id}}')" title="Restore Customer" class="restore-row restore-color" data-id="{{ $customer->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('customers/deletePermanently/{{$customer->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $customer->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
