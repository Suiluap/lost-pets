@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <form class="max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow" action="{{ route('user', $user) }}" method="post" novalidate>
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Profilio redagavimas</h1>
            <div class="text-sm sm:text-base">
                @csrf
                <div class="mb-2 sm:mb-4">
                    <label for="name" class="sr-only">Vardas</label>
                    <input id="name" name="name" type="text" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Vardas" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="email" class="sr-only">El. paštas</label>
                    <input id="email" name="email" type="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" placeholder="El. paštas" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="phone" class="sr-only">Telefono nr.</label>
                    <input id="phone" name="phone" type="tel" pattern="\+370[0-9]{8}" class="w-full p-2 border rounded @error('phone') border-red-500 @enderror" placeholder="Telefono nr." value="{{ old('phone', $user->phone_number) }}" required>
                    @error('phone')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="text-xs sm:text-sm">+370xxxxxxxx</div>
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="town" class="sr-only">Miestas</label>
                    <input id="town" name="town" type="text" class="w-full p-2 border rounded @error('town') border-red-500 @enderror" placeholder="Miestas" value="{{ old('town', $user->town) }}" required>
                    @error('town')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'users')
                    <div class="mb-2 sm:mb-4">
                        <fieldset class="border rounded @error('role') border-red-500 @enderror py-1 px-2">
                            <legend class="@error('role') text-red-500 @enderror">Rolė</legend>
                            <label class="block" for="user"><input type="radio" id="user" name="role" value="user" @if(old('role') == 'user' || $user->role =='user') checked @endif> Naudotojas</label>
                            <label class="block" for="admin"><input type="radio" id="admin" name="role" value="admin" @if(old('role') == 'admin' || $user->role =='admin') checked @endif> Administratorius</label>
                        </fieldset>
                        @error('role')
                            <div class="text-red-500 text-xs sm:text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                <button type="submit" class="block mx-auto px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white">Pateikti</button>
            </div>
        </form>
    </div>
@endsection
