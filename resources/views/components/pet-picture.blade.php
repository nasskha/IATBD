<div>
    @if($pet->picture)
        <img width="200rem"
             src="{{ asset('storage/' . $pet->picture) }}"
             alt="{{$pet->name}}">
    @endif
</div>
