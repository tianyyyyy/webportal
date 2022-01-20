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
        <button onclick="openModal()" class='float-right bg-blue-500 hover:bg-blue-400 text-white p-3 rounded-md'>Add
            Event</button>
    </div>
    <div class="m-14">

        <div id="calendar"></div>
    </div>



    <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700 ml-12">Upcoming Events</div>
    @foreach ($events as $event)
        @if ($event->status === 0)
            <div class="lg:flex shadow-md rounded-lg border mb-5 mx-14">
                <div class="bg-blue-600 rounded-lg lg:w-2/12 py-4 block h-full shadow-inner">
                    <div class="text-center tracking-wide">
                        <div class="text-white font-bold text-4xl ">{{ date('j', strtotime($event->start)) }}</div>
                        <div class="text-white font-normal text-2xl">{{ date('F', strtotime($event->start)) }}</div>
                    </div>
                </div>
                <div class="w-full  lg:w-11/12 xl:w-full px-1 bg-white py-5 lg:px-2 lg:py-2 tracking-wide">
                    <div class="flex flex-row lg:justify-start justify-center">
                        <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                            {{ date('H:i A', strtotime($event->start)) }} to {{ date('H:i A', strtotime($event->end)) }}
                        </div>
                    </div>
                    <div class="font-semibold text-gray-800 text-xl text-center lg:text-left px-2">
                        {{ $event->title }} @ {{ $event->venue }}
                    </div>

                    <div class="text-gray-600 font-medium text-sm pt-1 text-center lg:text-left px-2">
                        {{ $event->description }}
                    </div>
                </div>
                <div class="flex flex-row items-center w-full lg:w-1/3 bg-white lg:justify-end justify-center py-4 lg:px-0">

                    @if ($event->status === 1)
                        <a href="" class="text-red-400 hover:text-red-500">disable</a>
                    @else
                        <a href="{{ route('admin.events.status', $event->id) }}"
                            class="text-green-500 hover:text-green-700 transition delay-75">archive</a>
                    @endif

                    <form action="{{ route('admin.events.destroy', $event) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('are you sure you want to delete {{ $event->title }}?')"
                            class="text-red-500 mx-4 hover:text-red-700 transition delay-75">delete</button>
                    </form>

                </div>
            </div>
        @endif
    @endforeach


    <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700 ml-12">Successful Events</div>
    @foreach ($events as $event)
        @if ($event->status === 1)
            <div class="lg:flex shadow-md rounded-lg border mb-5 mx-14">
                <div class="bg-blue-600 rounded-lg lg:w-2/12 py-4 block h-full shadow-inner">
                    <div class="text-center tracking-wide">
                        <div class="text-white font-bold text-4xl ">{{ date('j', strtotime($event->start)) }}</div>
                        <div class="text-white font-normal text-2xl">{{ date('F', strtotime($event->start)) }}</div>
                    </div>
                </div>
                <div class="w-full  lg:w-11/12 xl:w-full px-1 bg-white py-5 lg:px-2 lg:py-2 tracking-wide">
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
                <div class="flex flex-row items-center w-full lg:w-1/3 bg-white lg:justify-end justify-center py-4 lg:px-0">
                    <form action="{{ route('admin.events.destroy', $event) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('are you sure you want to delete {{ $event->title }}?')"
                            class="text-red-500 mx-4 hover:text-red-700 transition delay-75">delete</button>
                    </form>

                </div>
            </div>
        @endif
    @endforeach


    {{-- add event modal --}}
    <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
        style="background: rgba(0,0,0,.7);">
        <div
            class="border border-teal-500 modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Add Event</p>
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
                <form action="{{ route('admin.events.store') }}" method="post" class="text-center">
                    @csrf
                    <div class="py-2 text-left">
                        <label for="title">Title</label>
                        <input type="name" name="title"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="Input event name" />
                    </div>
                    <div class="py-2 text-left">
                        <label for="description">Desciption</label>
                        <textarea name="description" id="description" cols="30" rows="4"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="Input description"></textarea>
                    </div>
                    <div class="py-2 text-left">
                        <label for="venue">Venue</label>
                        <input type="text" name="venue"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="Input Venue">
                    </div>
                    <div class="py-2 text-left">
                        <label for="start">Starting date</label>
                        <input type="datetime-local" name="start"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="Starting date" />
                    </div>
                    <div class="py-2 text-left">
                        <label for="end">Ending date</label>
                        <input type="datetime-local" name="end"
                            class="bg-white-200 border-2 border-white-100 focus:outline-none bg-gray-100 block w-full py-2 px-4 rounded-lg focus:border-gray-700"
                            placeholder="Ending date" />
                    </div>
                    <input type="number" name="status" value="0" hidden>
                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="focus:outline-none px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-blue-400">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '/full-calender',
                selectable: true,
                selectHelper: true,
            });

        });
    </script>

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
                schoolyear.style.display = 'none';
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
