<x-layout>
    <main class="flex justify-center w-full max-h-screen font-intern">
        <div class="flex flex-col py-10 px-4 w-full">
            <div class="mb-12 min-w-full flex flex-col justify-center items-center text-center">
                <div class="mb-64">
                    <img src="{{ asset('img/Group 1.png') }}" alt="coronaImg">
                </div>

                <div class="mb-5">
                    <img src="{{ asset('img/icons8-checked 1.png') }}" alt="iconChecked">
                </div>

                <div class="mb-14">
                    <p>Your account is confirmed, you can sign in</p>
                </div>

                <div class="flex flex-col mt-4 w-full max-w-lg">
                        <a href="{{ route('login') }}"
                            class="py-4 cursor-pointer transition duration-150 ease-in text-white font-semibold
                                 uppercase hover:bg-hover-success bg-success my-5 w-full rounded-md">
                            Sign In</a>
                </div>
            </div>
        </div>
    </main>
</x-layout>
