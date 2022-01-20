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
                        Name</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Username</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Email</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Organization</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Status</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Admin</th>
                </tr>
            </thead>
            <tbody>
                {{-- FILES --}}
                @foreach ($users as $user)
                    @if ($user->id === 2)

                    @else
                        <div>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->username }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->email }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $user->organization->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    @if ($user->status === 1)
                                        <a href="{{ route('admin.users.status', $user->id) }}"
                                            class="text-red-400 hover:text-red-500">disable</a>
                                    @else
                                        <a href="{{ route('admin.users.status', $user->id) }}"
                                            class="text-blue-400 hover:text-blue-500">activate</a>
                                    @endif
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    @if ($user->admin === 1)
                                        <a href="{{ route('admin.users.admin', $user) }}"
                                            class="text-green-500 hover:text-green-600">make
                                            officer</a>
                                    @else
                                        <a href="{{ route('admin.users.admin', $user) }}"
                                            class="text-blue-400 hover:text-blue-500">make
                                            admin</a>
                                    @endif
                                </td>
                            </tr>
                        </div>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
