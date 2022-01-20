@extends('layouts.app')

@section('content')

    <section class="min-h-screen flex flex-col">

        <div class="flex flex-1 items-center justify-center mt-24">
            <div
                class="rounded-lg sm:border-2 px-4 lg:px-24 py-16 lg:max-w-xl sm:max-w-md w-full text-center bg-gradient-to-r from-blue-100 to-blue-300 shadow-2xl">
                <form action="{{ route('register') }}" method="post" class="text-center">
                    @csrf
                    <input type="number" name="admin" value="0" hidden>
                    <h1 class="font-bold tracking-wider text-3xl mb-8 w-full text-gray-600">
                        Sign Up
                    </h1>
                    <div class="py-3 text-left">
                        <input type="name" name="name"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}" placeholder="Name" />
                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="py-3 text-left">
                        <input type="username" name="username"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('username') border-red-500 @enderror"
                            value="{{ old('username') }}" placeholder="Username" />
                        @error('username')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="py-2 text-left">
                        <input type="email" name="email"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}" placeholder="Email" />
                        @error('email')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="py-2 text-left">
                        <input type="password" name="password"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('password') border-red-500 @enderror"
                            value="{{ old('password') }}" placeholder="Password" />
                        @error('password')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="py-2 text-left">
                        <input type="password" name="password_confirmation"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('confirm_password') border-red-500 @enderror"
                            value="{{ old('password') }}" placeholder="Confirm password" />
                        @error('password_confirmation')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="py-2 text-left">
                        <select name="schlyr_id"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 ">
                            <option value="">Your School Year</option>
                            @foreach ($schlyrs as $schlyr)
                                <option value="{{ $schlyr->id }}">{{ $schlyr->schlyr }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-2 text-left">
                        <select name="organization_id"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 ">
                            <option value="">Your organization</option>
                            @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="py-2 text-left">
                        <select name="position"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 ">
                            <option value="">Your Position</option>
                            <option value="President">President</option>
                            <option value="Vice President">Vice President</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Auditor">Auditor</option>
                            <option value="P.I.O.">P.I.O.</option>
                        </select>
                    </div>
                    <input type="number" name="status" value="0" hidden>
                    <div class="py-2">
                        <button type="submit"
                            class="border-2 border-white-100 focus:outline-none bg-blue-600 text-white font-bold tracking-wider block w-full py-2 rounded-full focus:border-gray-700 hover:bg-blue-700">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>


@endsection
