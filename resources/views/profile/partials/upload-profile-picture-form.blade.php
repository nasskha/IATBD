<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Upload profielfoto') }}
        </h2>

        {{--        <p class="mt-1 text-sm text-gray-600">--}}
        {{--            {{ __("Update jouw account's profiel informatie en e-mail address.") }}--}}
        {{--        </p>--}}
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.uploadProfilePicture') }}" enctype="multipart/form-data"
          class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="picture" :value="__('Picture')"/>
            <x-profile-picture />
            <x-text-input id="picture" name="picture" type="file" class="mt-1 block w-full" :value="old('profile_picture', $user->profile_picture)"
                          required autofocus autocomplete="picture"/>
            <x-input-error class="mt-2" :messages="$errors->get('picture')"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Upload') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Opgeslagen.') }}</p>
            @endif
        </div>
    </form>
</section>
