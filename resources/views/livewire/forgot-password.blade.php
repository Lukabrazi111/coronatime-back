<form wire:submit.prevent='send' method="post" class="flex flex-col mt-4 w-full max-w-lg">
    @csrf
    <label for="email" class="mb-2 text-left font-semibold">{{ __('Email') }}</label>
    <input wire:model='email'
        class="px-4 py-4 rounded-lg border border-gray-200 mb-6 @error('email') mb-3 @enderror placeholder-dark"
        type="text" name="email" id="email" placeholder="{{ __('Enter your email') }}">
    @error('email')
        <span class="text-sm text-red-600 flex">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
            {{ __($message) }}
        </span>
    @enderror

    <div>
        <button type="submit"
            class="py-4 transition duration-150 ease-in text-white font-semibold
                 uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">{{ __('Reset Password') }}</button>
    </div>
</form>
