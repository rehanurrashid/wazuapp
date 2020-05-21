@if(isset($recipe))
    @if(!$recipe->trashed())
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('recipes.edit', [$recipe->id]) }}" title="Edit Recipe"><i class="bx bx-edit-alt" style="font-size: 1.8rem;"></i></a>
        <a href="javascript:sdelete('recipes/{{$recipe->id}}')" title="Suspend Recipe" class="delete-row delete-color" data-id="{{ $recipe->id }}"><i class="bx bx-trash 2x"  style="color:red;font-size: 1.8rem;"></i></a>
         <a href="{{ route('recipes.show', [$recipe->id]) }}" title="View Recipe Details" class="delete-row delete-color" data-id="{{ $recipe->id }}">
            <img src="{{asset('images/eye.png')}}" height="32">
        </a>
    </div>
    @else
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="javascript:restore('recipes/restore/{{$recipe->id}}')" title="Restore Recipe" class="restore-row restore-color" data-id="{{ $recipe->id }}"><i
                class="icon-loop3"></i></a>
        <a href="javascript:permanent('recipes/deletePermanently/{{$recipe->id}}')" title="Delete Permanently" class="delete-permanently-row delete-color" data-id="{{ $recipe->id }}"><i class="icon-cancel-square2" style="color: red;"></i></a>
     </div>
     
    @endif
@endif
