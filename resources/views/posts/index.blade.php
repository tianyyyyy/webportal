@extends('layouts.app')

@section('content')
    <div class="flex justify-center pt-6">
        <div class="w-10/12 md:w-8/12 bg-white-100 rounded-lg p-2 sm:p-6">
            <h1 class="hidden" style="margin-bottom: 200px; margin-top:100px">asd</h1>
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
    @auth
        <div class="flex justify-center pt-6">
            <div class="w-10/12 md:w-8/12 bg-white p-4 rounded-lg mt-5">

                <form action="{{ route('posts') }}" method="post" class="mb-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="sr-only">Body</label>
                        <textarea name="body" id="body" cols="30" rows="4"
                            class="bg-white-100 border-2 w-full p-4 rounded-lg
                            @error('body')
                                border-red-500
                            @enderror
                            "
                            placeholder="Post Something!"></textarea>

                        @error('body')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="number" name="published" value="0" hidden>

                    </div>
                    <div class="mb-4">
                        <input type="file" class="bg-white border py-2 pl-3 rounded-md w-full @error('body')
                        border-red-500
                    @enderror" name="file" id="file">

                        @error('file')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="bg-blue-500 text-white px-8 py-3 rounded font-medium float-right">Post</button>
                        <select name="status"
                            class="mr-8 float-right mx-4 bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 py-3 px-4 rounded-lg focus:border-gray-700 "
                            value="">
                            <option value="0">Public</option>
                            <option value="{{ auth()->user()->organization_id }}">
                                Organization Only
                            </option>
                        </select>
                        <select name="topic"
                            class="float-right mx-4 bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 py-3 px-4 rounded-lg focus:border-gray-700 "
                            value="">
                            <option value="Announcement">Announcement</option>
                            <option value="Award">Award</option>
                            <option value="Meeting">Meeting</option>
                        </select>
                    </div>
                </form>

            </div>
        </div>
    @endauth

    @if ($posts->count())
        <div style="margin-top: 50px">
            @foreach ($posts as $post)
                @auth
                    @if ($post->published === 1)
                        @if ($post->status === 0)
                            <div class="flex justify-center pt-6">
                                <div class="w-10/12 md:w-8/12 bg-white rounded-lg p-2 sm:p-6">
                                    <x-post :post="$post" />
                                </div>
                            </div>
                        @endif
                        @if (auth()->user()->organization_id === $post->status)
                            <div class="flex justify-center pt-6">
                                <div class="w-10/12 md:w-8/12 bg-white rounded-lg p-2 sm:p-6">
                                    <x-post :post="$post" />
                                </div>
                            </div>
                        @endif
                    @endif
                @endauth
                @guest
                    @if ($post->published === 1)
                        @if ($post->status === 0)
                            <div class="flex justify-center pt-6">
                                <div class="w-10/12 md:w-8/12 bg-white rounded-lg p-2 sm:p-6">
                                    <section class="bg-white container mx-auto px-5">
                                        <div class="flex flex-col items-center py-8">
                                            <div class="flex flex-col w-full mb-5 text-left">
                                                <div class="w-full mx-auto lg:w-1/2">
                                                    <h1 class="mx-auto mb-6 text-2xl font-semibold text-black lg:text-3xl"><a
                                                            href="{{ route('users.posts', $post->user) }}"
                                                            class="font-bold">{{ $post->user->name }}</a> <span
                                                            class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                                                    </h1>

                                                    <h3 class="mx-auto mt-4 mb-4 text-xl font-semibold text-black">
                                                        {{ $post->body }}</h3>

                                                    <img class="rounded-sm" width="500px"
                                                        src="{{ asset('storage/images/' . $post->file) }}" />

                                                    <div class="flex items-center my-1 justify-between">

                                                        <span class="font-bold">{{ $post->likes->count() }}
                                                            {{ Str::plural('like', $post->likes->count()) }}</span>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        @endif
                    @endif
                @endguest

            @endforeach
        </div>
        {{ $posts->links() }}
    @else
        <div class="flex justify-center pt-6">
            <div class="w-8/12 bg-white p-6 rounded-lg">
                <p>There is no post</p>
            </div>
        </div>
    @endif






    <div class="mx-5 mt-52 md:mx-20 lg:mx-48">
        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Upcoming Events</div>
        @foreach ($events as $event)
            @if ($event->status === 0)
                <div class="lg:flex shadow-md rounded-lg border mb-1 w-full">
                    <div class="bg-blue-600 rounded-lg lg:w-2/12 py-4 block h-full shadow-inner">
                        <div class="text-center tracking-wide">
                            <div class="text-white font-bold text-4xl ">{{ date('j', strtotime($event->start)) }}
                            </div>
                            <div class="text-white font-normal text-2xl">{{ date('F', strtotime($event->start)) }}
                            </div>
                        </div>
                    </div>
                    <div class="w-full  lg:w-11/12 xl:w-full px-1 bg-white py-5 lg:px-2 lg:py-2 tracking-wide rounded-lg">
                        <div class="flex flex-row lg:justify-start justify-center">
                            <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                                {{ date('H:i A', strtotime($event->start)) }} to
                                {{ date('H:i A', strtotime($event->end)) }}
                            </div>
                        </div>
                        <div class="font-semibold text-gray-800 text-xl text-center lg:text-left px-2">
                            {{ $event->title }}
                        </div>

                        <div class="text-gray-600 font-medium text-sm pt-1 text-center lg:text-left px-2">
                            {{ $event->description }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

@endsection
