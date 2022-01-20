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
            </div>
            <form action="{{ route('orgregistration') }}" method="post" class="text-center" enctype="multipart/form-data">
                @csrf
                <h1 class="font-bold tracking-wider text-3xl mb-8 w-full text-gray-600">
                    Register your Organization
                </h1>
                <div class="py-2 text-left">
                    <input type="file" name="file" class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('file') border-red-500 @enderror" />

                    @error('file')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="py-2">
                    <button type="submit" class="border-2 border-gray-100 focus:outline-none bg-blue-600 text-white font-bold tracking-wider block w-full py-2 rounded-full focus:border-gray-700 hover:bg-blue-700">
                        Register
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
