@extends('layouts.adminlayout')

@section('content')

    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="flex flex-col gap-4 lg:p-4 p-2  rounde-lg m-2">
        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">School Year</div>
        @foreach ($schlyrs as $schlyr)
            <a href="{{ route('admin.organization.list', $schlyr) }}"
                class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-200 transition duration-500 cursor-pointer border-2 rounded-lg">

                <div class="lg:flex md:flex items-center">
                    <div class="ml-5 mb-2 lg:mb-0 md:mb-0 mr-5"> <img class="w-8"
                            src="{{ asset('storage/images/urslogo.png') }}" alt=""> </div>

                    <div class="flex flex-col">

                        <div class="text-sm leading-3 text-gray-700 font-bold w-full">{{ $schlyr->schlyr }}</div>

                        <div class="text-xs text-gray-600 w-full"></div>

                    </div>

                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @endforeach
    </div>



@endsection
