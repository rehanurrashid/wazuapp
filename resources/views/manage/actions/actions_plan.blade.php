@if(isset($plan))
    @if(!$plan->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('plans.edit', [$plan->id]) }}" title="Edit Plan"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('plans/{{$plan->id}}')" title="Suspend Plan" class="delete-row delete-color" data-id="{{ $plan->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('plans/restore/{{$plan->id}}')" title="Restore Plan" class="restore-row restore-color" data-id="{{ $plan->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('plans/deletePermanently/{{$plan->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $plan->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
