@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <form class="max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow" action="{{ route("status", $status) }}" method="post" novalidate>
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Statuso redagavimas</h1>
            <div class="text-sm sm:text-base">
                @csrf
                <div class="mb-2 sm:mb-4">
                    <label for="status" class="sr-only">Statusas</label>
                    <input id="status" name="status" type="text" class="w-full p-2 border rounded @error('status') border-red-500 @enderror" placeholder="Statusas" value="{{ old('status', $status->name) }}" required>
                    @error('status')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="block mx-auto px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white">Išsaugoti</button>
            </div>
        </form>
    </div>
@endsection
