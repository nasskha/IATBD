<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Oppas advertenties') }}
        </h2>
    </x-slot>
    <div class="mx-auto p-4 sm:p-6 lg:p-8 max-w-7xl">
        @if(session('status'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($userHasAdvert)

            <div class="bg-white shadow-sm rounded-lg divide-y p-4">
                <a href="{{ route('petsitter-adverts.edit', Auth::user()->id) }}">
                    <x-secondary-button>
                        {{ __('Bewerk je oppas profiel') }}
                    </x-secondary-button>
                </a>
            </div>

        @else
            <div class="bg-white shadow-sm rounded-lg divide-y p-4">
                <a href="{{ route('petsitter-adverts.create') }}">
                    <x-secondary-button>
                        {{ __('Maak je eigen oppas profiel') }}
                    </x-secondary-button>
                </a>
            </div>
        @endif

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($petsitterAdverts as $petsitterAdvert)
                @include('petsitter-adverts.show', ['petsitterAdvert' => $petsitterAdvert])
            @endforeach
        </div>
    </div>
</x-app-layout>
