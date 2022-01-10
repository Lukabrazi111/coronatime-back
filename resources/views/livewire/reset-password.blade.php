<form wire:submit.prevent='resetPassword' method="post" class="flex flex-col mt-4 w-full max-w-lg">
    @csrf

    <label for="password" class="mb-2 text-left font-semibold">New password</label>
    <input wire:model='password'
        class="px-4 py-4 rounded-lg border border-gray-200 mb-6 @error('password') mb-2 @enderror placeholder-dark"
        type="password" name="password" id="password" placeholder="Enter new password">
    @error('password')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <label for="repeat_password" class="mb-2 text-left font-semibold">Repeat password</label>
    <input wire:model='repeat_password'
        class="px-4 py-4 rounded-lg border border-gray-200 mb-6 @error('password') mb-2 @enderror placeholder-dark"
        type="password" name="repeat_password" id="repeat_password" placeholder="Repeat password">
    @error('repeat_password')
        <span class="text-sm text-red-600 flex mb-2 mt-1">
            <img class="mr-1 w-5 h-5" src="{{ asset('img/validation/error-warning-fill.png') }}" alt="error">
            {{ $message }}
        </span>
    @enderror

    <div>
        <button type="submit"
            class="py-4 transition duration-150 ease-in text-white font-semibold
                 uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Save
            Changes</button>
    </div>
</form>
