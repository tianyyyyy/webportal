@extends('layouts.adminlayout')

@section('content')

    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md" >
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="bg-gray-100 shadow-md rounded my-6 m-10">
        <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
            <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">age</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Year & Section</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">position</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Organization</th>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">action</th>
            </tr>
            </thead>
            <tbody>
                {{-- profiles --}}
                @foreach ($profiles as $profile)
                    <div>
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">{{ $profile->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $profile->age }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $profile->yrsec }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $profile->position }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">{{ $profile->organization->name }}</td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <form action="{{ route('profile.destroy', $profile) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this profile?')" class="text-red-400 border-none hover:text-red-600">delete</button>
                                </form>
                        </tr>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
