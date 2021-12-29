@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <form class="max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow" action="{{ route('register') }}" method="post" novalidate>
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Registracija</h1>
            <div class="text-sm sm:text-base">
                @csrf
                <div class="mb-2 sm:mb-4">
                    <label for="name" class="sr-only">Vardas</label>
                    <input id="name" name="name" type="text" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Vardas" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="email" class="sr-only">El. paštas</label>
                    <input id="email" name="email" type="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" placeholder="El. paštas" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="phone" class="sr-only">Telefono nr.</label>
                    <input id="phone" name="phone" type="tel" pattern="\+370[0-9]{8}" class="w-full p-2 border rounded @error('phone') border-red-500 @enderror" placeholder="Telefono nr." value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="text-xs sm:text-sm">+370xxxxxxxx</div>
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="town" class="sr-only">Miestas</label>
                    <input id="town" name="town" type="text" class="w-full p-2 border rounded @error('town') border-red-500 @enderror" placeholder="Miestas" value="{{ old('town') }}" required>
                    @error('town')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="password" class="sr-only">Slaptažodis</label>
                    <input id="password" name="password" type="password" class="w-full p-2 border rounded @error('password') border-red-500 @enderror" placeholder="Slaptažodis" required>
                    @error('password')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="password_confirmation" class="sr-only">Slaptažodžio patvirtinimas</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="w-full p-2 border rounded @error('password_confirmation') border-red-500 @enderror" placeholder="Slaptažodžio patvirtinimas" required>
                    @error('password_confirmation')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="text-xs sm:text-sm">Pakartokite anksčiau įrašytą slaptažodį</div>
                </div>
                <button type="submit" class="block mx-auto px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white">Pateikti</button>
            </div>
        </form>
    </div>
@endsection
