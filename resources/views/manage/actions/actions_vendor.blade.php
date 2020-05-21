@if(isset($vendor))
    @if(!$vendor->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a class="mr-1" href="{{ route('manage_vendors.edit', [$vendor->id]) }}" title="Edit Vendor"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('manage_vendors/{{$vendor->id}}')" title="Suspend Vendor" class="delete-row delete-color" data-id="{{ $vendor->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('manage_vendors/restore/{{$vendor->id}}')" title="Restore Vendor" class="restore-row restore-color" data-id="{{ $vendor->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('manage_vendors/deletePermanently/{{$vendor->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $vendor->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
