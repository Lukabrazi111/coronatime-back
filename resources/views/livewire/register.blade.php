<form wire:submit.prevent='register' action="#" method="post" class="flex flex-col w-full mt-4 md:w-6/12">
    @csrf

    <label for="username" class="mb-2">Username</label>
    <input wire:model='username'
        class="px-4 py-4 rounded-lg border @error('username') border-red-600 @enderror border-gray-200 mb-1 placeholder-dark"
        type="text" name="username" placeholder="Enter unique username or email">
    @error('username')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/error/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @else
        <small class="text-dark mb-2 text-sm">Username should be unique, min 3 symbols</small>
    @enderror


    <label for="email" class="mb-2">Email</label>
    <input wire:model='email'
        class="px-4 py-4 rounded-lg border @error('email') border-red-600 @enderror border-gray-200 mb-2 placeholder-dark"
        type="text" name="email" placeholder="Enter your email">
    @error('email')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/error/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <label for="password" class="mb-2">Password</label>
    <input wire:model='password'
        class="px-4 py-4 rounded-lg border @error('password') border-red-600 @enderror border-gray-200 mb-2 placeholder-dark"
        type="password" name="password" id="password" placeholder="Fill in password">
    @error('password')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/error/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <label for="password_confirmation" class="mb-2">Repeat password</label>
    <input wire:model.lazy='password_confirmation' id="password_confirmation"
        class="px-4 py-4 rounded-lg border border-gray-200 mb-2 placeholder-dark" type="password"
        name="password_confirmation" placeholder="Repeat password">
    @error('password_confirmation')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/error/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <div>
        <input type="checkbox" id="remember" name="remember"
            class="border border-gray-200 text-success transition duration-100 ease-in rounded-4 form-checkbox">
        <label class="ml-1" for="remember">Remember this device</label>
    </div>
    <div>
        <button type="submit"
            class="py-4 transition duration-150 ease-in text-white font-semibold
             uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Sign
            Up</button>
    </div>

    <div class="flex items-center justify-center space-x-2">
        <p class="text-dark">Already have an account?</p>
        <a class="font-semibold hover:underline" href="{{ route('login') }}">Log in</a>
    </div>
</form>
