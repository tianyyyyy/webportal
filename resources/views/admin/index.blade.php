@extends('layouts.adminlayout')

@section('content')
@auth

    <div class="w-full bg-white p-4 rounded-lg mt-5 ">

        <div class="h-full grid grid-rows-3 grid-flow-col gap-x-10">
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/dpc.webp') }}" alt="dpc"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-56 " src="{{ asset('img/jfnex.png') }}" alt="jfnex"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/iconnect.png') }}" alt="iconnect"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/jma.png') }}" alt="jma"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/joa.png') }}" alt="joa"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/presidentsleague1.png') }}" alt="isps"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-48" src="{{ asset('img/presidentsleague.png') }}" alt="itps"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-72" src="{{ asset('img/sb.png') }}" alt="sb"></div>
            <div class="ml-auto mr-auto display-block"><img class="w-64" src="{{ asset('img/ps.webp') }}" alt="ps"></div>
          </div>

    </div>

@endauth
@endsection
