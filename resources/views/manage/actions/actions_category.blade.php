@if(isset($category))
    @if(!$category->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('categories.edit', [$category]) }}" title="Edit category"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('categories/{{$category->id}}')" title="Suspend category" class="delete-row delete-color" data-id="{{ $category->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('categories/restore/{{$category->id}}')" title="Restore category" class="restore-row restore-color" data-id="{{ $category->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('categories/deletePermanently/{{$category->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $category->id }}"><i
                class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
    @endif
@endif
