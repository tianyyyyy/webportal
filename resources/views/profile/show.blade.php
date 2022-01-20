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

    {{-- organization list --}}

    <div class="flex flex-col gap-4 lg:p-4 p-2  rounde-lg m-2" style="margin-bottom: 300px">
        {{-- add member button --}}
        @auth
            <div class="float-right m-4 mt-16 md:mr-10">
                <button onclick="openModal()" class='bg-blue-500 hover:bg-blue-400 text-white p-3 rounded-md'>Add
                    Member</button>
            </div>
        @endauth

        <div style="margin-top: 50px" class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">
            Organizations</div>
        @foreach ($organizations as $organization)
            <a href="{{ route('organization.profile-org', $organization->name) }}"
                class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-200 transition duration-500 cursor-pointer border-2 rounded-lg">

                <div class="lg:flex md:flex items-center">
                    <div class="h-12 w-12 mb-2 lg:mb-0 border md:mb-0 rounded-full mr-3">
                        <img src="{{ url('storage/images/' . $organization->image) }}" alt="img"/>
                    </div>

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


    {{-- modal --}}
    @auth
        <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
            style="background: rgba(0,0,0,.7);">
            <div
                class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Add Member</p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <!--Body-->
                    <form action="{{ route('profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                            <input type="number" name="age"
                                class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('age') border-red-500 @enderror"
                                value="{{ old('age') }}" placeholder="Age" />
                            @error('age')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="py-2 text-left">
                            <input type="text" name="yrsec"
                                class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('yrsec') border-red-500 @enderror"
                                value="{{ old('yrsec') }}" placeholder="Year & Section" />
                            @error('yrsec')
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
                        <div class="hidden">
                            <input hidden type="number" value="{{ auth()->user()->organization_id }}" name="organization_id">
                        </div>
                        <div class="hidden">
                            <input hidden type="number" value="{{ auth()->user()->schlyr_id }}" name="schlyr_id">
                        </div>
                        <div class="py-2 text-left">
                            <select name="position"
                                class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 "
                                value="{{ old('position') }}">
                                <option value="">Your Position</option>
                                <option value="President">President</option>
                                <option value="Vice President">Vice President</option>
                                <option value="Secretary">Secretary</option>
                            </select>
                        </div>

                        <!--Footer-->
                        <div class="flex justify-end    pt-2">
                            <button type="submit"
                                class="focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-blue-400">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth


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
