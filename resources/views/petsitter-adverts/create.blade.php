<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maak uw eigen huisdier oppasprofiel aan!') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8 ">
        <div class=" py-12 w-full space-y-6 bg-white shadow-sm rounded-lg">

            <form id="send-verification" method="post" action="{{route('verification.send')}}">
                @csrf
            </form>

            <form method="POST" action="{{ route('petsitter-adverts.store') }}"
                  class="space-y-6"
                  enctype="multipart/form-data">

                @csrf
                <div class="sm:p-8 mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4 w-full">

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg w-full space-y-6">

                        <div class="mt-4">
                            <label for="advert_active" class="flex items-center">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Concept profiel') }} &ensp;</span>
                                <input id="advert_active" name="advert_active" type="checkbox"
                                       class="form-checkbox h-5 w-5 text-indigo-600">
                            </label>
                            <p class="mt-2 text-sm text-gray-500"> Als u dit heeft aangevinkt, wordt uw profiel niet gepubliceerd.</p>
                            <x-input-error class="mt-1" :messages="$errors->get('advert_active')"/>
                        </div>

                        <div>
                            <x-input-label for="name" :value="__('Openbare naam *')"/>
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name')" required
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
                                required></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')"/>

                        </div>

                        <div>
                            <x-input-label for="city" :value="__('Stad')"/>
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full"
                                          :value="old('city')"
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('city')"/>
                        </div>

                        <div>
                            <x-input-label for="picture" :value="__('Foto')"/>
                            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full"
                                          autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('picture')"/>
                        </div>

                        {{--                    als een foto van een huis is toegevoegd,  voeg dan button toe voor andere huis foto upload. --}}
                        <div>
                            <x-input-label for="house_pictures" :value="__('Huis foto')"/>
                            <input id="house_pictures" name="house_pictures[]" type="file" class="mt-1 block w-full"
                                   autofocus multiple>
                            <x-input-error class="mt-2" :messages="$errors->get('house_pictures')"/>
                        </div>

                    </div>

                    <div>
                        <x-primary-button> {{ __('Opslaan') }}</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
