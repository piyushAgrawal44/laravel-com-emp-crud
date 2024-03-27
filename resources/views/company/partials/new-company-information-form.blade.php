<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Add Company') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Fill required details.") }}
        </p>
    </header>


    <form method="post" action="{{ route('company.create') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="logo" :value="__('Logo')" />
            <input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" required  />
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'new-company')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
