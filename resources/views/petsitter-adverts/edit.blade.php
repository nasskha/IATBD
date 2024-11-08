<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Verander hier jouw oppas profiel') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('petsitter-adverts.show', ['petsitterAdvert' => $petsitterAdvert])
        <div class=" py-12 w-full space-y-6 bg-white shadow-sm rounded-lg">
            <form id="send-verification" method="post" action="{{route('verification.send')}}">
                @csrf
            </form>

            <form method="POST" action="{{ route('petsitter-adverts.update', $petsitterAdvert) }}"
                  class="space-y-6"
                  enctype="multipart/form-data">
                @method('PATCH')

                @csrf
                <div class="sm:p-8 mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4 w-full">

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full space-y-6">

                        <div class="mt-4">
                            <label for="advert_active" class="flex items-center">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Concept?') }} &ensp;</span>
                                <input id="advert_active" name="advert_active" type="checkbox"
                                       class="form-checkbox h-5 w-5 text-indigo-600">
                            </label>
                            <p class="mt-2 text-sm text-gray-500"> Als aangevinkt, wordt de advertentie niet gepubliceerd.</p>
                            <x-input-error class="mt-1" :messages="$errors->get('advert_active')"/>
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Openbare naam *')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', $petsitterAdvert->name)" required
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                        </div>

                        <div>
                            <label for="description">{{__('Beschrijving *')}}</label>
                            <textarea
                                id="description"
                                name="description"
                                type="text"
                                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                rows="4"
                                required>{{ old('description', $petsitterAdvert->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>

                        </div>

                        <div>
                            <x-input-label for="city" :value="__('Stad')"/>
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                          :value="old('city', $petsitterAdvert->city)"
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('city')"/>
                        </div>

                        <div>
                            <x-input-label for="picture" :value="__('Foto')"/>
                            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full"
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('picture')"/>
                        </div>

                        <div>
                            <x-primary-button> {{ __('Opslaan') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>

            <div>
                <form method="POST" action="{{ route('petsitter-adverts.destroy', $petsitterAdvert) }}">
                    @csrf
                    @method('DELETE')

                    <x-danger-button>{{ __('Verwijder profiel') }}</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
