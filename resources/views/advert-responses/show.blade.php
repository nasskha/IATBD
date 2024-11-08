<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
    <div class="">
        <div class="px-4 py-2"
        >Je hebt gereageerd op: <a href="/my-pets"> <strong>{{ $advertResponse->pet->name }},
                    {{ $advertResponse->pet->type }}</strong></a></div>

        <div class="bg-gray-100 p-4 rounded">
            {!!nl2br($advertResponse->message) !!}
        </div>
        <div class="px-4 py-2">Sent at {{ $advertResponse->created_at->format('j F, g:i A') }} by
            <strong>{{ $advertResponse->user->name }}</strong>
        </div>
    </div>

    @switch($advertResponse->getStatus())
        @case('pending')
        <div class="px-4 py-2 rounded font-bold" style="background-color: #D2E0E1;">In behandeling</div>

            @if($advertResponse->target_user_id === Auth::id())
                {{--                if user is petsitter --}}
                <div class="grid md:grid-cols-2 gap-2">
                    <form method="post" action="{{ route('advert-responses.accept', $advertResponse) }}">
                        @csrf
                        @method('put')
                        <x-primary-button type="submit" class="btn btn-success"
                                          onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Accepteer') }}
                        </x-primary-button>
                    </form>
                    <form method="post" action="{{ route('advert-responses.deny', $advertResponse) }}">
                        @csrf
                        @method('put')
                        <x-danger-button type="submit" class="btn btn-danger"
                                         onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Afwijzen') }}
                        </x-danger-button>
                    </form>

                </div>
            @endif
            @break

        @case('accepted')
            <div class="px-4 py-2 bg-green-200 rounded font-bold">Geaccepteerd</div>
            @if($advertResponse->target_user_id === Auth::id())
                <div class="">
                    <h2>Laat een review achter</h2>
                    <form method="post" action="{{
                route('petsitter-adverts.review', $advertResponse) }}">
                        @csrf
                        @method('put')
                        <textarea
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            name="review"
                            id="review"
                            cols="40"
                            rows="4"></textarea>
                        <x-primary-button>{{__('Indienen')}}</x-primary-button>
                    </form>
                </div>
            @endif
            @break

        @case('denied')
            <div class="px-4 py-2 bg-red-200 rounded font-bold">Afgewezen</div>
            @break
    @endswitch

    @if($advertResponse->user_id === auth()->user()->id)
        {{--        if outbox --}}
        <form method="post" action="{{ route('advert-responses.destroy', $advertResponse) }}">
            @csrf
            @method('delete')
            <x-danger-button type="submit" class="btn btn-danger"
                             onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Verwijder') }}
            </x-danger-button>
        </form>
    @endif
</div>
