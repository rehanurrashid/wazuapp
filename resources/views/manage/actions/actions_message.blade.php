@if(isset($message))
    @if(!$message->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('messages.edit', [$message->id]) }}" title="Edit Message"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('messages/{{$message->id}}')" title="Suspend Message" class="delete-row delete-color" data-id="{{ $message->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('messages/restore/{{$message->id}}')" title="Restore Message" class="restore-row restore-color" data-id="{{ $message->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('messages/deletePermanently/{{$message->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $message->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
