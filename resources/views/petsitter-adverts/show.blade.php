<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="">

                <div class="p-6 flex space-x-2">

                    <div class="flex-1">
                        <div class="flex items-center">
                            <div class=" mt-4 space-y-6">
                                <div class="text-xl"><strong>{{ $petsitterAdvert->name }}</strong></div>
                                <div>
                                    <x-picture
                                        :source="$petsitterAdvert->picture"
                                        :alt="'picture of ' . $petsitterAdvert->name"/>
                                </div>
                                <div class="bg-gray-100 p-4 rounded w-full">
                                    <h6 class="font-bold text-lg">
                                        <strong>Beschrijving</strong>
                                    </h6>
                                    <p>
                                        {!!nl2br($petsitterAdvert->description)!!}
                                    </p>
                                </div>

                                <div class=" mt-4 p-4">
                                    <p><strong>Locatie:</strong> {{ $petsitterAdvert->city }}</p>
                                </div>


                                @if(!$petsitterAdvert->user->is(auth()->user()))
                                    <a href="{{ route('petsitter-adverts.respond', $petsitterAdvert) }}">
                                        <x-primary-button type="submit" class="btn btn-primary">
                                            {{ __('Reageer') }}
                                        </x-primary-button>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg space-y-6">
            <div>
                <h6 class="font-bold text-lg"><strong>{{ $petsitterAdvert->name }}'s huis</strong></h6>
            </div>

            @if($petsitterAdvert->house_pictures)
                <div class="grid grid-cols-2 gap-4">
                    @foreach( $petsitterAdvert->house_pictures as $picture)
                        <x-picture :source="$picture"
                                   :alt="'foto van' . $petsitterAdvert->name . '\'s huis'"/>
                    @endforeach
                </div>
            @endif

            @if($petsitterAdvert->reviews)

                <div>
                    <h6 class="font-bold text-lg">Reviews</h6>

                    @foreach( $petsitterAdvert->reviews as $review)

                        <div class="bg-gray-100 p-4 rounded w-full mt-4">
                            <p>
                                {!!nl2br($review)!!}
                            </p>
                        </div>
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</div>
