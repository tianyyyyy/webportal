@extends('layouts.app')

@section('content')



<section class="min-h-screen flex flex-col">

    <div class="flex flex-1 items-center justify-center">


        <div class="rounded-lg sm:border-2 px-4 lg:px-24 py-16 lg:max-w-xl sm:max-w-md w-full text-center bg-gradient-to-r from-blue-100 to-blue-300 shadow-2xl">

            <div class="flex justify-center mt-0">
                @if (session('message'))
                    <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md" >
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-10 bg-red-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md" >
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <form action="{{ route('login') }}" method="post" class="text-center">
                @csrf
                <h1 class="font-bold tracking-wider text-3xl mb-8 w-full text-gray-600">
                    Log in
                </h1>
                <div class="py-2 text-left">
                    <input type="email" name="email" class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('email') border-red-500 @enderror" value="{{ old('email') }}" placeholder="Email" />

                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="py-2 text-left">
                    <input type="password" name="password" class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('password') border-red-500 @enderror" placeholder="Password" />

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="py-2">
                    <button type="submit" class="border-2 border-gray-100 focus:outline-none bg-blue-600 text-white font-bold tracking-wider block w-full py-2 rounded-full focus:border-gray-700 hover:bg-blue-700">
                        Log In
                    </button>
                </div>
            </form>
            <div class="text-center">
                <a href="#" class="hidden">Forgot password?</a>
            </div>
        </div>
    </div>
</section>


@endsection
