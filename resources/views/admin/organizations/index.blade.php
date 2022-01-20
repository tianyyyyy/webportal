@extends('layouts.adminlayout')

@section('content')

    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="ml-auto mr-10 display-block mt-10">
        <button onclick="openModal()" class='bg-blue-500 hover:bg-blue-400 text-white p-3 rounded-md'>Add
            Organization</button>
        <button onclick="openSchoolyear()" class='bg-blue-500 hover:bg-blue-400 text-white p-3 rounded-md'>Add
            SchoolYear</button>
    </div>

    <div class="flex flex-col gap-4 lg:p-4 p-2  rounde-lg m-2">
        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Organizations</div>
        @foreach ($schlyrs as $schlyr)
            <div class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full  rounded-lg">
                <a href="{{ route('admin.schlyr.organization', $schlyr->schlyr) }}"
                    class="flex items-center justify-between w-full p-2 lg:rounded-full md:rounded-full hover:bg-gray-200 transition duration-500 cursor-pointer border-2 rounded-lg">

                    <div class="lg:flex md:flex items-center">
                        <div class="ml-5 mb-2 lg:mb-0 md:mb-0 mr-5"> <img class="w-8"
                                src="{{ asset('storage/images/urslogo.png') }}" alt=""> </div>

                        <div class="flex flex-col">

                            <div class="text-sm leading-3 text-gray-700 font-bold w-full">{{ $schlyr->schlyr }}</div>

                            <div class="text-xs text-gray-600 w-full"></div>

                        </div>

                    </div>
                    <svg class="h-6 w-6 mr-1 invisible md:visible lg:visible xl:visible" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>

                </a>
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="float-right flex flex-row items-center text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900  focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <span></span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
                            <form action="{{ route('admin.schlyr.destroy', $schlyr) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this school year?')"
                                    class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-red-900 focus:text-gray-900 hover:bg-red-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline w-full">Delete</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- organization modal --}}
    <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add Organization</p>
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
                <form action="{{ route('admin.organizations') }}" method="post" enctype="multipart/form-data">
                    <form action="{{ route('admin.organizations') }}" method="post" class="text-center">
                        @csrf
                        <div class="py-3 text-left">
                            <input type="name" name="name"
                                class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 @error('name') border-red-500 @enderror"
                                placeholder="Name" />
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
                                class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700 ">

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
        </div>
    </div>
    {{-- schoolyear modal --}}
    <div class="schoolyear-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add School Year</p>
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
                <form action="{{ route('admin.schoolyear') }}" method="post" class="text-center">
                    @csrf
                    <div class="py-3 text-left">
                        <label for="">(for example: 2000 - 2001)</label>
                        <input type="name" name="schlyr"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="School Year" />
                    </div>

                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-blue-400">Submit</button>
                    </div>
                </form>
            </div>
        </div>
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
        const schoolyear = document.querySelector('.schoolyear-modal');
        const closeButton = document.querySelectorAll('.modal-close');

        const modalClose = () => {
            modal.classList.remove('fadeIn');
            modal.classList.add('fadeOut');
            schoolyear.classList.remove('fadeIn');
            schoolyear.classList.add('fadeOut');
            setTimeout(() => {
                modal.style.display = 'none';
                schoolyear.style.display = 'none';
            }, 500);
        }

        const openModal = () => {
            modal.classList.remove('fadeOut');
            modal.classList.add('fadeIn');
            modal.style.display = 'flex';
        }

        const openSchoolyear = () => {
            schoolyear.classList.remove('fadeOut');
            schoolyear.classList.add('fadeIn');
            schoolyear.style.display = 'flex';
        }
        for (let i = 0; i < closeButton.length; i++) {

            const elements = closeButton[i];

            elements.onclick = (e) => modalClose();

            modal.style.display = 'none';
            schoolyear.style.display = 'none';

            window.onclick = function(event) {
                if (event.target == modal) modalClose();
                if (event.target == schoolyear) modalClose();
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



@endsection
