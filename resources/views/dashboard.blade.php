<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berichten Inbox') }}
        </h2>
    </x-slot>

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

    <div class="mx-auto p-4 sm:p-6 lg:p-8 max-w-7xl">
    <div class="mt-6 shadow-sm rounded-lg divide-y" style="background-color: #C2D3CD;">

            <div class="py-12">
                <div class="mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4">

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">

                        <h2 class="text-lg font-medium text-gray-900">Inkomende requests </h2>

                        @each('advert-responses.show', $advertResponsesInbox, 'advertResponse')
                        @each('petsitter-advert-responses.show', $petsitterAdvertResponsesInbox, 'advertResponse')

                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
                        <h2 class="text-lg font-medium text-gray-900">Uitgaande requests</h2>
                        @each('advert-responses.show', $advertResponsesOutbox, 'advertResponse')
                        @each('petsitter-advert-responses.show', $petsitterAdvertResponsesOutbox, 'advertResponse')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
