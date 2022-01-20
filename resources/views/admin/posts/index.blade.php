@extends('layouts.adminlayout')

@section('content')

    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-gray-100 shadow-md rounded my-6 m-10">
        <table class="text-left w-full border-collapse">
            <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
                <tr>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Posted by</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        body</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        date</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Organization</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        action</th>

                </tr>
            </thead>
            <tbody>
                {{-- posts --}}
                @foreach ($posts as $post)
                    <div>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $post->user->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ Str::substr($post->body, 0, 60) . '...' }}
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $post->created_at->format('F/j/Y') }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $post->user->organization->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <a href="{{ route('admin.posts.show', $post->id) }}"
                                    class="text-green-400 border-none hover:text-green-600">view</a> <br>
                                @if ($post->published === 1)
                                    <a href="{{ route('admin.posts.publish', $post->id) }}"
                                        class="text-blue-400 hover:text-blue-500">unpublish</a>
                                @else
                                    <a href="{{ route('admin.posts.publish', $post->id) }}"
                                        class="text-blue-400 hover:text-blue-500">publish</a>
                                @endif
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this post?')"
                                        class="text-red-400 border-none hover:text-red-600">delete</button>
                                </form>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
