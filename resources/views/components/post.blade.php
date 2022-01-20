@props(['post' => $post])
@auth
    <section class="bg-white container mx-auto px-1">
        <div class="flex flex-col items-center py-8">
            <div class="flex flex-col w-full mb-8 text-left">
                <div class="w-full mx-auto lg:w-1/2">

                    @if ($post->ownedBy(auth()->user()))
                        <div @click.away="open = false" class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="float-right flex flex-row items-center text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900  focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                <span></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">

                                <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this post?')"
                                            class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-red-900 focus:text-gray-900 hover:bg-red-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline w-full">Delete</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endif
                    <h1 class="mx-auto text-2xl font-semibold text-black lg:text-3xl"><a
                            href="{{ route('users.posts', $post->user) }}"
                            class="font-bold">{{ $post->user->name }}</a> <span
                            class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span></h1>
                    <span class="text-gray-600 text-sm">{{ $post->user->organization->name }}</span>

                    <h3 class="mx-auto mt-4 mb-4 text-xl font-semibold text-black">{{ $post->body }}</h3>
                    <img class="rounded-sm mb-5" width="500px" src="{{ asset('storage/images/' . $post->file) }}" />

                    <div class="flex items-center my-1 justify-between">

                        @if (!$post->likedBy(auth()->user()))
                            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                                @csrf
                                <button type="submit"
                                    class="text-black border border-blue-500 rounded-md py-2 px-5 hover:bg-blue-500">Like</button>
                                <span>{{ $post->likes->count() }}
                                    {{ Str::plural('like', $post->likes->count()) }}</span>
                            </form>
                        @else
                            <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-black border border-blue-500 rounded-md py-2 px-5 hover:bg-blue-500">Unlike</button>
                                <span>{{ $post->likes->count() }}
                                    {{ Str::plural('like', $post->likes->count()) }}</span>
                            </form>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </section>

@endauth
