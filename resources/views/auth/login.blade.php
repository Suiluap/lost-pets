@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <form class="max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow" action="{{ route('login') }}" method="post" novalidate>
            @csrf
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Prisijungimas</h1>
            <div class="text-sm sm:text-base">
                <div class="mb-2 sm:mb-4">
                    <label for="email" class="sr-only">El. paštas</label>
                    <input id="email" name="email" type="email" class="w-full p-2 border rounded @if($errors->has('email') || session('status')) border-red-500 @endif" placeholder="El. paštas" required>
                    @error('email')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Slaptažodis</label>
                    <input id="password" name="password" type="password" class="w-full p-2 border rounded @if($errors->has('email') || session('status')) border-red-500 @endif" placeholder="Slaptažodis" required>
                    @error('password')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (session('status'))
                    <div class="text-red-500 text-xs sm:text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                <button type="submit" class="mt-2 sm:mt-4 block mx-auto px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white">Pateikti</button>
            </div>
        </form>
    </div>
@endsection
