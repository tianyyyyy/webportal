@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @if (session('message'))
            <div class="bg-green-500 text-center text-white px-6 py-3 rounded font-medium m-3 shadow-md"
                style="margin-top: 200px">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="flex justify-center pt-6">
        <div class="w-10/12 md:w-8/12 bg-white p-4 rounded-lg mt-24">

            <form action="{{ route('files') }}" method="post" class="mb-4" enctype="multipart/form-data">
                @csrf
                <input type="number" name="status" value="0" hidden>

                <div class="mb-4">
                    <label for="">File:</label>
                    <input type="file" class="bg-white border py-2 pl-3 rounded-md w-full" name="file" id="file">
                    @error('file')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="" name="type">Type:</label> <br>
                    <label for=""><input type="radio" name="optradio" value="Cover Letter"> Cover Letter </label><br>
                    <label for=""><input type="radio" name="optradio" value="Proposal"> Proposal </label><br>
                    <label for=""><input type="radio" name="optradio" value="Student Activity Form"> Student Activity Form
                    </label><br>
                    <label for=""><input type="radio" name="optradio" value="Evaluation Form"> Evaluation Form </label> <br>
                    <label for=""><input type="radio" name="optradio" value="Accomplishment Report"> Accomplishment Report
                    </label><br>
                    <label for=""><input type="radio" name="optradio" value="Program"> Program </label><br>
                    <label for=""><input type="radio" name="optradio" value="Other"> Other</label>
                    @error('optradio')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="hidden">
                        <input hidden type="number" value="{{ auth()->user()->organization_id }}" name="organization_id">
                    </div>
                    <div class="hidden">
                        <input hidden type="number" value="{{ auth()->user()->schlyr_id }}" name="schlyr_id">
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-8 py-3 rounded font-medium float-right mt-1">Send</button>
                </div>
            </form>
        </div>
    </div>

    <div class="md:w-full mx-auto lg:w-2/3 w-full mb-48 mt-10">
        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Pending Files</div>
        <div class="bg-white shadow-md rounded my-1">
            <table class="text-left w-full border-collapse">
                <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                    <tr>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            file name</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            type</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            date</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            delete</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            download</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- FILES --}}
                    @foreach ($files as $file)
                        @if (auth()->user()->organization_id === $file->organization_id)
                            @if ($file->status == 0)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $file->file }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $file->optradio }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        {{ $file->created_at->diffForHumans() }}
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <form action="{{ route('files.destroy', $file) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Do you want to delete this file {{ $file->file }}?')"
                                                class="bg-red-400 text-white px-5 py-1 rounded font-medium hover:bg-red-600">delete</button>
                                        </form>
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <div>
                                            <a href="{{ route('admin.file.download', $file) }}"
                                                class=" bg-blue-400 text-white px-5 py-1 rounded font-medium hover:bg-blue-600">download</a>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @if ($file->status == 0)
                                            Not approved
                                        @else
                                            Approved
                                        @endif

                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="lg:text-2xl md:text-xl text-lg lg:p-3 p-1 font-black text-gray-700">Successful Files</div>
        <div class="bg-white shadow-md rounded my-1">
            <table class="text-left w-full border-collapse">
                <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                <thead>
                    <tr>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            file name</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            type</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            date</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            delete</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            download</th>
                        <th
                            class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                            status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- FILES --}}
                    @foreach ($files as $file)
                        @if (auth()->user()->organization_id === $file->organization_id)
                            @if ($file->status == 1)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $file->file }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">{{ $file->optradio }}</td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        {{ $file->created_at->diffForHumans() }}
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <form action="{{ route('files.destroy', $file) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Do you want to delete this file {{ $file->file }}?')"
                                                class="bg-red-400 text-white px-5 py-1 rounded font-medium hover:bg-red-600">delete</button>
                                        </form>
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <div>
                                            <a href="{{ route('admin.file.download', $file) }}"
                                                class=" bg-blue-400 text-white px-5 py-1 rounded font-medium hover:bg-blue-600">download</a>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        @if ($file->status == 0)
                                            Not approved
                                        @else
                                            Approved
                                        @endif

                                    </td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
