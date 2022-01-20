@extends('layouts.adminlayout')

@section('content')


    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="mx-48 my-11">
        <form action="{{ route('admin.organization.update', $organization) }}" method="post"
            enctype="multipart/form-data">
            <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700 text-center">Edit
                {{ $organization->name }}
            </div>
            @csrf
            <div class="py-3 text-left">
                <input type="name" name="name"
                    class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('name') border-red-500 @enderror"
                    placeholder="Name" value="{{ $organization->name }}" />
                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="py-2 text-left">
                <input type="file" name="image"
                    class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('image') border-red-500 @enderror" />
                @error('image')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="py-2 text-left">
                <select name="schlyr_id"
                    class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                    value="{{ $organization->schlyr }}">

                    @foreach ($schlyrs as $schlyr)
                        <option value="{{ $schlyr->id }}">{{ $schlyr->schlyr }}</option>
                    @endforeach
                </select>
            </div>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-blue-400">Submit</button>
            </div>
        </form>
    </div>
@endsection
