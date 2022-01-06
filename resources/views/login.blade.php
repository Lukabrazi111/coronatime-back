<x-layout>
    {{-- Main --}}
    <main class="flex justify-between w-full max-h-screen font-intern pb-6">
        <div class="flex flex-col pt-10 px-4 w-full md:pl-32 md:w-7/12">
            <div class="mb-12">
                <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
            </div>
            <div>
                <h1 class="text-2xl font-bold mb-2">Welcome back</h1>
                <h2 class="text-xl font-normal text-dark">Welcome back! Please enter your details</h1>
            </div>
            {{-- Form --}}
            <form action="#" method="post" class="flex flex-col w-full mt-4 md:w-6/12">

                <label for="username" class="mb-2">Username</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-4 placeholder-dark" type="text"
                    name="username" placeholder="Enter unique username or email">

                <label for="password" class="mb-2">Password</label>
                <input class="px-4 py-4 rounded-lg border border-gray-200 mb-4 placeholder-dark" type="password"
                    name="password" placeholder="Fill in password">

                <div class="flex justify-between items-center">
                    <div>
                        <input type="checkbox" id="remember" name="remember"
                            class="border border-gray-200 text-success transition duration-100 ease-in rounded-4 form-checkbox">
                        <label class="ml-1" for="remember">Remember this device</label>
                    </div>
                    <div>
                        <a class="hover:underline text-link" href="{{ route('forgot.password') }}">Forgot password?</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="py-4 transition duration-150 ease-in text-white font-semibold
                         uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Log
                        In</button>
                </div>

                <div class="flex items-center justify-center space-x-2">
                    <p class="text-dark">Don't have and account?</p>
                    <a class="font-semibold hover:underline" href="{{ route('register') }}">Sign up for free</a>
                </div>
            </form>
        </div>

        {{-- Main page image --}}
        <div>
            <img class="h-screen md:block hidden" src="{{ asset('img/Rectangle 1.png') }}" alt="capsuleImg">
        </div>
    </main>
</x-layout>