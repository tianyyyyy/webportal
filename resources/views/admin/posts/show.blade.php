@extends('layouts.adminlayout')

@section('content')
    <section class="bg-white container mx-auto px-5">
        <div class="flex flex-col items-center py-8">
        <div class="flex flex-col w-full mb-5 text-left">
            <div class="w-full mx-auto lg:w-1/2">
            <h1 class="mx-auto mb-6 text-2xl font-semibold text-black lg:text-3xl"><a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span></h1>

            <h3 class="mx-auto mt-4 mb-4 text-xl font-semibold text-black">{{ $post->body }}</h3>

            <img class="rounded-sm" src="{{asset('storage/images/' . $post->file)}}" />

            </div>
        </div>
        </div>
</section>

@endsection
