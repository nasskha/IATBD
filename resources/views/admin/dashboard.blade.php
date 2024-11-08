<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin dashboard') }}
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

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">

            @foreach($users as $user)
                <table>
                    <tr>
                        <td>
                            <div class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full" src="{{ $user->profile_picture }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form method="POST" action="{{route('admin.block', $user)}}">
                                    @csrf
                                    @method('POST')

                                    <x-primary-button>
                                        {{ __('Blokkeer') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <div>
                                @if($user->isBanned())
                                    <p> <b>Geblokkeerd</b> </p>
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            @endforeach

        </div>
    </div>
</x-app-layout>
