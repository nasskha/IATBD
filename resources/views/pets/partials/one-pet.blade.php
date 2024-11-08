<div class="p-6 flex space-x-2">

    <div class="flex-1">
        <div class="flex items-center">
            <div>
                <span class="text-xl"> <strong>{{ $pet->name }}</strong>, {{ $pet->type }}</span>
                <span>
                    <x-pet-picture :pet="$pet"/>
                </span>
            </div>

        </div>
        <div class="mt-4">
            @if($pet->user->is(auth()->user()))
                <p><strong> Jouw huisdier </strong></p>
            @endif
            @if($pet->breed)
                <p><strong>Ras:</strong> {{ $pet->breed }}</p>
            @endif
            @if($pet->age)
                <p><strong>Leeftijd:</strong> {{ $pet->age }}</p>
            @endif
        </div>
        @if($pet->user->is(auth()->user()))
            <div class="grid md:grid-cols-2 gap-2 py-6">
                <a href=" {{route('pets.edit', $pet)}}">
                    <x-primary-button>
                        {{ __('Aanpassen') }}
                    </x-primary-button>
                </a>
                <form method="post" action="{{ route('pets.destroy', $pet) }}">
                    @csrf
                    @method('delete')
                    <x-danger-button :href="route('pets.destroy', $pet)"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Verwijder') }}
                    </x-danger-button>
                </form>

            </div>
        @endif

        @if(auth()->user()->isAdmin())
            <form method="post" action="{{ route('pets.destroy', $pet) }}">
                @csrf
                @method('delete')
                <x-danger-button :href="route('pets.destroy', $pet)"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Verwijder') }}
                </x-danger-button>
            </form>
        @endif


    </div>
</div>
