@if(isset($user))
    @if(!$user->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('users.edit', [$user->id]) }}" title="Edit User"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('users/{{$user->id}}')" title="Suspend User" class="delete-row delete-color" data-id="{{ $user->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('users/restore/{{$user->id}}')" title="Restore User" class="restore-row restore-color" data-id="{{ $user->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('users/deletePermanently/{{$user->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $user->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
