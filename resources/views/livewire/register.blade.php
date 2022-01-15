<form wire:submit.prevent='store' action="#" method="post" class="flex flex-col w-full mt-4 md:w-6/12">
    @csrf

    <div class="flex flex-col relative">
        <label for="username" class="mb-2">{{ __('Username') }}</label>
        <input wire:model='username' class="px-4 py-4 rounded-lg border @if ($username) @error('username') border-red-600 @else border-green-600 @enderror @else border-gray-200 @endif mb-1 placeholder-dark"
            type="text" name="username" placeholder="{{ __('Enter unique username or email') }}">

        @if ($username && !$errors->has('username'))
            <span>
                <img class="w-6 h-6 absolute top-12 right-4"
                    src="{{ asset('img/validation/checkbox-circle-fill.png') }}" alt="checked">
            </span>
        @endif
    </div>
    @error('username')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @else
        <small class="text-dark mb-2 text-sm">{{ __('Username should be unique, min 3 symbols') }}</small>
    @enderror


    <div class="flex flex-col relative">
        <label for="email" class="mb-2">{{ __('Email') }}</label>
        <input wire:model='email' class="px-4 py-4 rounded-lg border @if ($email) @error('email') border-red-600 @else border-green-600 @enderror @else border-gray-200 @endif mb-2 placeholder-dark"
            type="text" name="email" placeholder="{{ __('Enter your email') }}">

        @if ($email && !$errors->has('email'))
            <span>
                <img class="w-6 h-6 absolute top-12 right-4"
                    src="{{ asset('img/validation/checkbox-circle-fill.png') }}" alt="checked">
            </span>
        @endif

        @error('email')
            <span class="text-sm text-red-600 flex mb-2 mt-1">
                <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="flex flex-col relative">
        <label for="password" class="mb-2">{{ __('Password') }}</label>
        <input wire:model='password' class="px-4 py-4 rounded-lg border @if ($password) @error('password') border-red-600 @else border-green-600 @enderror @else border-gray-200 @endif mb-2 placeholder-dark"
            type="password" name="password" id="password" placeholder="{{ __('Fill in password') }}">

        @error('password')
            <span class="text-sm text-red-600 flex mb-2 mt-1">
                <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="flex flex-col relative">
        <label for="password_confirmation" class="mb-2">{{ __('Repeat password') }}</label>
        <input wire:model.lazy='password_confirmation' id="password_confirmation"
            class="px-4 py-4 rounded-lg border border-gray-200 mb-2 placeholder-dark" type="password"
            name="password_confirmation" placeholder="{{ __('Repeat password') }}">

        @error('password_confirmation')
            <span class="text-sm text-red-600 flex mb-2 mt-1">
                <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="flex items-center gap-1">
        <input wire:model='remember' type="checkbox" id="remember" name="remember"
            class="border border-gray-200 text-success transition duration-100 ease-in rounded-4 form-checkbox">
        <label class="ml-1" for="remember">{{ __('Remember this device') }}</label>
    </div>
    <div>
        <button type="submit"
            class="py-4 transition duration-150 ease-in text-white font-semibold
        uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">{{ __('Sign Up') }}</button>
    </div>

    <div class="flex items-center justify-center space-x-2">
        <p class="text-dark">{{ __('Already have an account?') }}</p>
        <a class="font-semibold hover:underline" href="{{ route('login') }}">{{ __('Log In') }}</a>
    </div>
</form>
