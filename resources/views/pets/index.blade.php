<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Route::is('pets.my-pets'))
                {{ __('Mijn dieren') }}
            @else
                {{ __('Dieren advertenties') }}
            @endif
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">

        @if(session('status'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <strong class="font-bold">success!</strong>
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif


            @includeWhen(Route::is('pets.my-pets'), 'pets.partials.create-pet-form')

            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form action="{{ route('pets.index') }}" method="GET">
                        <div class="p-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <label for="type">Filter diersoort</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">Alle</option>
                                <option value="dog" {{ old('type') == 'dog' ? 'selected' : '' }}>Hond</option>
                                <option value="cat" {{ old('type') == 'cat' ? 'selected' : '' }}>Kat</option>
                                <option value="bird" {{ old('type') == 'bird' ? 'selected' : '' }}>Vogel</option>
                                <option value="fish" {{ old('type') == 'fish' ? 'selected' : '' }}>Vis</option>
                                <option value="reptile" {{ old('type') == 'reptile' ? 'selected' : '' }}>Reptiel</option>
                                <option value="hamster" {{ old('type') == 'hamster' ? 'selected' : '' }}>Hamster</option>
                                <option value="insect" {{ old('type') == 'insect' ? 'selected' : '' }}>Insect</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Anders</option>
                            </select>
                            <button type="submit" class="bg-[#2D5D7B] hover:bg-[#1a3c4f] text-white font-bold py-2 px-4 rounded mt-2">Filter</button>

                        </div>
                    </form>
                </div>
            </div>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @each('pets.show', $pets, 'pet')
        </div>
    </div>
</x-app-layout>
