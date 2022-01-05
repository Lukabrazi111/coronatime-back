<x-layout>
    <main class="flex justify-center w-full max-h-screen font-intern">
        <div class="flex flex-col py-10 px-4 w-full">
            <div class="mb-12 min-w-full flex flex-col justify-center items-center text-center">
                <div class="mb-32">
                    <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
                </div>

                <div class="mb-8">
                    <h1 class="font-semibold text-black text-2xl">Reset Password</h1>
                </div>

                {{-- Form --}}
                <form action="#" method="post" class="flex flex-col mt-4 w-full max-w-lg">
                    <label for="username" class="mb-2 text-left font-semibold">Email</label>
                    <input class="px-4 py-4 rounded-lg border border-gray-200 mb-6 placeholder-dark" type="text"
                        name="email" placeholder="Enter your email">

                    <div>
                        <button type="submit"
                            class="py-4 transition duration-150 ease-in text-white font-semibold
                                 uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">Reset Password</button>
                    </div>
                </form>
            </div>



        </div>
    </main>
</x-layout>
