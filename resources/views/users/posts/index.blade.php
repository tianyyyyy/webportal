@extends('layouts.app')

@section('content')
    <div class="flex justify-center pt-6">
        <div class="w-10/12 md:w-8/12">

            <div class="p-6" style="margin-top: 100px">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count()) }} and received {{ $user->receivedLikes->count() }} likes</p>
            </div>


                @if ($posts->count())
                    @foreach ( $posts as $post )
                    <div class="bg-white p-6 rounded-lg" style="margin-top: 20px">
                        <div>
                            <x-post :post="$post" />
                        </div>
                    </div>
                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p>No posts yet</p>
                @endif


        </div>
    </div>

@endsection
