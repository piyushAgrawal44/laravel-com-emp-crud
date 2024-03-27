<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Edit Company') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update company details.") }}
        </p>
    </header>

    <form method="post" action="{{ route('company.edit', $company->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('post') 

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$company->name" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$company->email" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="logo" :value="__('Logo')" />
            <input id="logo" name="logo" type="file" class="mt-1 block w-full" accept="image/*" />
            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
            @if($company->logo)
                <img src="{{ asset($company->logo) }}" alt="Company Logo" class="mt-2 h-20 w-auto rounded">
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Update') }}</x-primary-button>
        </div>
    </form>
</section>
