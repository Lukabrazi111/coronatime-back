<x-layout>
    {{-- Main --}}
    <main class="flex justify-between w-full max-h-screen font-intern">
        <div class="flex flex-col py-10 px-4 w-full md:pl-32 md:w-7/12">
            <div class="mb-12">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome to Coronatime</h1>
                <h2 class="text-xl font-normal text-dark">Please enter required info to sign up</h1>
            </div>
            {{-- Form --}}
            <form action="#" method="post" class="flex flex-col w-full mt-4 md:w-6/12">

                <label for="username" class="mb-2">Username</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-1 placeholder-dark" type="text" name="username"
                    placeholder="Enter unique username or email">
                <small class="text-dark mb-2 text-sm">Username should be unique, min 3 symbols</small>

                <label for="username" class="mb-2">Email</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-4 placeholder-dark" type="text"
                    name="username" placeholder="Enter your email">

                <label for="password" class="mb-2">Password</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-4 placeholder-dark" type="password"
                    name="password" placeholder="Fill in password">

                <label for="password" class="mb-2">Repeat password</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-4 placeholder-dark" type="password"
                    name="repeat_password" placeholder="Repeat password">

                <div>
                    <input type="checkbox" id="remember" name="remember"
                        class="border border-gray-200 text-success rounded-4 form-checkbox">
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
        </div>

        {{-- Main page image --}}
        <div>
            <img class="h-screen md:block hidden" src="{{ asset('img/Rectangle 1.png') }}" alt="capsuleImg">
        </div>
    </main>
</x-layout>
