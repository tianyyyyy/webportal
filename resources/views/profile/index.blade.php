@extends('layouts.app')

@section('content')
    <div class="flex justify-center pt-9">
        <div class="w-10/12 md:w-8/12 bg-white-100 rounded-lg p-2 sm:p-6">
            <h1 class="hidden" style="margin-bottom: 300px; margin-top:200px">asd</h1>
        </div>
        <div class="w-10/12 md:w-8/12 bg-white-100 rounded-lg p-2 sm:p-6">
            <h1 class="hidden" style="margin-bottom: 400px; margin-top:200px">asd</h1>
        </div>

    </div>
    <div class="flex justify-center" style="margin-top: 50px">
        @if (session('message'))
            <div class="bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md"
                style="margin-top: 50px">
                {{ session('message') }}
            </div>
        @endif
    </div>


    {{-- organization list --}}

    <div class="flex flex-col gap-4 lg:p-4 p-2  rounde-lg m-2 mb-48" style="margin-bottom: 350px">

        <div style="margin-top: 50px" class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">
            Organizations</div>
        @foreach ($schlyrs as $schlyr)
            <a href="{{ route('organization.profile', $schlyr->schlyr) }}"
                class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-200 transition duration-500 cursor-pointer border-2 rounded-lg">

                <div class="lg:flex md:flex items-center">
                    <div class="ml-5 mb-2 lg:mb-0 md:mb-0 mr-5"> <img class="w-8"
                            src="{{ asset('storage/images/urslogo.png') }}" alt=""> </div>

                    <div class="flex flex-col">

                        <div class="text-sm leading-3 text-gray-700 font-bold w-full">{{ $schlyr->schlyr }}</div>

                        <div class="text-xs text-gray-600 w-full"></div>

                    </div>

                </div>

                <svg class="h-6 w-6 mr-1 invisible md:visible lg:visible xl:visible" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>

            </a>
        @endforeach
    </div>


@endsection
