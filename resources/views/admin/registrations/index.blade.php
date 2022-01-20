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
                        File Name</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Date</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        download</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        delete</th>

                </tr>
            </thead>
            <tbody>
                {{-- posts --}}
                @foreach ($registrations as $registration)
                    <div>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $registration->file }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                {{ date('F j Y', strtotime($registration->created_at)) }}
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light"><a
                                    href="{{ route('admin.registration.download', $registration->file) }}"
                                    class="text-blue-500 hover:text-blue-700">download</a></td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <form action="{{ route('admin.registration.destroy', $registration) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Do you want to delete {{ $registration->file }}')"
                                        class="text-red-500 hover:text-red-600">delete</button>
                                </form>
                            </td>

                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
