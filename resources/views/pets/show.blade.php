{{-- een dier en zijn advertentie --}}

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-4">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="">
                @include('pets.partials.one-pet', ['pet' => $pet])
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="">
                @include('pets.partials.pet-advert', ['pet' => $pet])
            </div>
        </div>
    </div>
</div>

