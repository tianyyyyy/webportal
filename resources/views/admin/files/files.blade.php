@extends('layouts.adminlayout')

@section('content')

    {{-- message --}}
    <div class="flex justify-center mt-0 mb-0">
        @if (session('message'))
            <div class="mb-10 bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="flex justify-center mt-12">
        <img src="{{ asset('storage/images/' . $organizations->image) }}" alt="noimage">
    </div>
    <div class="flex justify-center lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">
        <h1>{{ $organizations->name }}</h1>
    </div>

    <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700 ml-8">New Files</div>


    <div class="bg-gray-100 shadow-md rounded my-2 m-10">
        <table class="text-left w-full border-collapse">
            <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
                <tr>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Submit by</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        File</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Type</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Date</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Organization</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- FILES --}}

                @foreach ($files as $file)
                    @if ($file->status === 0)
                        <div>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->user->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->file }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->optradio }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{ date('F j Y', strtotime($file->created_at)) }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->user->organization->name }}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <a href="{{ route('admin.file.download', $file->file) }}"
                                        class="text-blue-500 hover:text-blue-700">download</a> <br>
                                    <a href="{{ route('admin.file.status', $file) }}"
                                        onclick="return confirm('Do you want to archive {{ $file->file }}')"
                                        class="text-green-500 hover:text-green-600">archive</a>
                                    <form action="{{ route('files.destroy', $file) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Do you want to delete {{ $file->file }}')"
                                            class="text-red-500 hover:text-red-600">delete</button>
                                    </form>

                                </td>
                            </tr>
                        </div>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700 ml-8">Successful Files</div>

    <div class="bg-gray-100 shadow-md rounded my-2 m-10 mb-5">
        <table class="text-left w-full border-collapse">
            <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
                <tr>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Submit by</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        File</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Type</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Date</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Organization</th>
                    <th
                        class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- FILES --}}

                @foreach ($files as $file)
                    @if ($file->status === 1)
                        <div>
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->user->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->file }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $file->optradio }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{ date('F j Y', strtotime($file->created_at)) }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    {{ $file->user->organization->name }}
                                </td>
                                <td class="py-4 px-6 border-b border-grey-light">
                                    <a href="{{ route('admin.file.download', $file->file) }}"
                                        class="text-blue-500 hover:text-blue-700">download</a>
                                    <form action="{{ route('files.destroy', $file) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Do you want to delete {{ $file->file }}')"
                                            class="text-red-500 hover:text-red-700">delete</button>
                                    </form>

                                </td>
                            </tr>
                        </div>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
