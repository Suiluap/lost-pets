@extends('layouts.main')

@section('content')
    <div class="bg-white">
        <div class="mx-2 my-24 sm:my-36 py-16 sm:py-36 text-center">
            @if(session('status'))
                <div class="text-sm sm:text-base text-green-500 text-center">
                    {{ session('status') }}
                </div>
            @endif
            <h1 class="text-lg sm:text-3xl pb-1 sm:pb-3"><i class="fas fa-cat"></i> Pasimetusių augintinių skelbimų portalas <i class="fas fa-dog"></i></h1>
            <h2 class="text-sm sm:text-lg">Praneškite apie <a class="text-indigo-500 hover:underline" @guest href="{{ route('register') }}" @endguest @auth href="{{ route('add') }}" @endauth>rastą</a> ar <a class="text-indigo-500 hover:underline" @guest href="{{ route('register') }}" @endguest @auth href="{{ route('add') }}" @endauth>paklydusį</a> augintinį!</h2>
        </div>
    </div>
@endsection
