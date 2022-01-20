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
                        Logo</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Organization Name</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Action</th>

                </tr>
            </thead>
            <tbody>
                {{-- FILES --}}
                @foreach ($organizations as $organization)
                    <div>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light"><img class="h-6 w-8"
                                    src="{{ asset('storage/images/' . $organization->image) }}" alt="no image"></td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $organization->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <a href="{{ route('admin.organization.edit', $organization) }}"
                                    class="text-green-400 border-none hover:text-green-600"> edit</a>
                        </tr>
                    </div>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
