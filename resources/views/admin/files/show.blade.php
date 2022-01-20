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
        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Organizations</div>
        @foreach ($organizations as $organization)
            <a href="{{ route('admin.organization.files', $organization) }}"
                class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-200 transition duration-500 cursor-pointer border-2 rounded-lg">

                <div class="lg:flex md:flex items-center">
                    <div class="h-12 w-12 mb-2 lg:mb-0 border md:mb-0 rounded-full mr-3"> <img
                            src="{{ asset('storage/images/' . $organization->image) }}" alt=""> </div>

                    <div class="flex flex-col">

                        <div class="text-sm leading-3 text-gray-700 font-bold w-full">{{ $organization->name }}</div>

                        <div class="text-xs text-gray-600 w-full">{{ $organization->schlyr->schlyr }}</div>

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
