<form wire:submit.prevent='store' action="#" method="post" class="flex flex-col w-full mt-2 md:w-6/12">
    @csrf

    
    <div class="flex flex-col relative">
        <label for="username" class="mb-2">Username</label>
        <input wire:model='username' class="px-4 py-4 rounded-lg border @if ($username) @error('username') border-red-600 @else border-green-600 @enderror @else border-gray-200 @endif mb-1 placeholder-dark"
            type="text" name="username" placeholder="Enter unique username">
    </div>
    @error('username')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <div class="flex flex-col relative">
        <label for="password" class="mb-2">Password</label>
        <input wire:model='password' class="px-4 py-4 rounded-lg border @if ($password) @error('password') border-red-600 @else border-green-600 @enderror @else border-gray-200 @endif mb-2 placeholder-dark"
            type="password" name="password" id="password" placeholder="Fill in password">

        @error('password')
            <span class="text-sm text-red-600 flex mb-2 mt-1">
                <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
                {{ $message }}
            </span>
        @enderror
    </div>
    
    <div>
        <input type="checkbox" id="remember" name="remember"
            class="border border-gray-200 text-success transition duration-100 ease-in rounded-4 form-checkbox">
        <label class="ml-1" for="remember">Remember this device</label>
    </div>
    <div>
        <button type="submit"
            class="py-4 transition duration-150 ease-in text-white font-semibold
             uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Log
            In</button>
    </div>

    <div class="flex items-center justify-center space-x-2">
        <p class="text-dark">Don't have an account?</p>
        <a class="font-semibold hover:underline" href="{{ route('register') }}">Sign Up for free</a>
    </div>
</form>
