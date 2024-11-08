<div class="p-6 flex space-x-2">

    <div class="flex-1">
        <div class="flex items-center">
            <div>
                <span class="text-xl">{{ __('Advertentie') }}</span>
            </div>
        </div>
        @if($pet->advert_active)
            <div class="mt-4 space-y-6">
                <div class="bg-gray-100 p-4 rounded">
                    @if($pet->description)
                        <h6 class="font-bold text-lg"><strong>Beschrijving</strong></h6>
                        <p>
                            {!!nl2br($pet->description)!!}
                        </p>
                    @endif
                </div>

                <div>
                    @if($pet->begin_date)
                        <p><strong>Van: </strong> {{ date('j F, Y', strtotime($pet->begin_date)) }} </p>
                    @endif
                    @if($pet->end_date)
                        <p><strong>Tot: </strong> {{ date('j F, Y', strtotime($pet->end_date)) }}</p>
                    @endif
                </div>
                @if($pet->hourly_rate)
                    <p><strong>Uurtarief: </strong> ${{ $pet->hourly_rate }}</p>
                @endif
                @if($pet->city)
                    <p><strong>Stad:</strong> {{ $pet->city }}</p>
                @endif
            </div>
        @else
            <div class="mt-4">
                <p><strong>Advertentie is niet actief</strong></p>
            </div>
        @endif

        <div class="mt-4">
            @if(!$pet->user->is(auth()->user()) && Route::is('pets.index') && $pet->advert_active)
                <a href="{{ route('pets.respond', $pet) }}">
                    <x-primary-button type="submit" class="btn btn-primary">
                        {{ __('Reageer') }}
                    </x-primary-button>
                </a>
            @endif
        </div>
    </div>
</div>
