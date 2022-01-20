@extends('layouts.app')

@section('content')
    <div class="flex justify-center pt-9">
        <div class="w-10/12 md:w-8/12 bg-white-100 rounded-lg p-2 sm:p-6">
            <h1 class="hidden" style="margin-bottom: 300px; margin-top:200px">asd</h1>
        </div>
        <div class="w-10/12 md:w-8/12 bg-white-100 rounded-lg p-2 sm:p-6">
            <h1 class="hidden" style="margin-bottom: 400px; margin-top:200px">asd</h1>
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

    <div class="flex justify-center mt-12">
        <img src="{{ asset('storage/images/' . $organizations->image) }}" alt="">
    </div>
    <div class="flex justify-center lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">
        <h1>{{ $organizations->name }}</h1>
    </div>
    {{-- cards --}}
    <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 m-5 mb-60">

        @foreach ($profiles as $profile)
            <div class="container mx-auto max-w-xs rounded-lg overflow-hidden shadow-lg my-2 bg-white">
                <div class=" mb-6">
                    <img style="height: 400px" class="w-full"
                        src="{{ asset('storage/images/' . $profile->image) }}" alt="Profile picture" />
                    <div class="text-center w-full">
                        <div class="___class_+?16___">
                            <p class="text-black tracking-wide uppercase text-lg font-bold">{{ $profile->name }}</p>
                            <p class="text-black-400 text-sm">{{ $profile->position }}</p>
                        </div>

                    </div>
                </div>
                <div class="py-10 px-7 text-center tracking-wide grid grid-cols-3 gap-6">
                    <div class="___class_+?20___">
                        <p class="text-lg">{{ $profile->yrsec }}</p>
                        <p class="text-gray-400 text-sm">Year & Section</p>
                    </div>
                    <div class="___class_+?23___">
                        <p class="text-lg">{{ $profile->age }}</p>
                        <p class="text-gray-400 text-sm">Age</p>
                    </div>
                    <div class="___class_+?26___">
                        <p class="text-lg"> {{ $profile->organization->name }} </p>
                        <p class="text-gray-400 text-sm">Organization</p>
                    </div>
                </div>
                @auth
                    @if (auth()->user()->organization_id === $profile->organization_id)
                        <form action="{{ route('profile.destroy', $profile) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this profile?')"
                                class='bg-red-500 hover:bg-red-400 text-white p-2 rounded-md float-right m-2'>delete</button>
                        </form>
                    @endif
                @endauth

            </div>

        @endforeach
    </div>

    <style>
        .animated {
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }

        .animated.faster {
            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;
        }

        .fadeIn {
            -webkit-animation-name: fadeIn;
            animation-name: fadeIn;
        }

        .fadeOut {
            -webkit-animation-name: fadeOut;
            animation-name: fadeOut;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

    </style>
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 500);
        }

        const openModal = () => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }

        for (let i = 0; i < closeButton.length; i++) {

            const elements = closeButton[i];

            elements.onclick = (e) => modalClose();

            modal.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
            }
        }
    </script>
@endsection
