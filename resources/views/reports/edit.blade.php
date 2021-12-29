@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <form action="{{ route('report.edit', $report) }}" method="post" class="max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow" enctype="multipart/form-data" novalidate>
            @csrf
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Skelbimo redagavimas</h1>
            <div class="text-sm sm:text-base">
                <div class="mb-2 sm:mb-4">
                    <label for="name" class="sr-only">Augintinio vardas</label>
                    <input id="name" name="name" type="text" class="w-full p-2 border rounded @error('name') border-red-500 @enderror" placeholder="Augintinio vardas" value="{{ old('name', $report->name) }}" required>
                    @error('name')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <fieldset class="border rounded @error('status') border-red-500 @enderror py-1 px-2">
                        <legend class="@error('status') text-red-500 @enderror">Statusas</legend>
                        @foreach($statuses as $status)
                            <label class="block" for="{{ $status->name }}"><input type="radio" id="{{ $status->name }}" name="status" value="{{ $status->id }}" @if(old('status') == $status->id || $report->status_id == $status->id) checked @endif> {{ $status->name }}</label>
                        @endforeach
                    </fieldset>
                    @error('status')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="picture" class="@error('picture') text-red-500 @enderror">Nuotrauka</label>
                    <input type="file" id="picture" name="picture" accept="image/*" class="block">
                    @error('picture')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <small>Naują nuotrauką įkelkite tik tuo atveju, jei norite keisti esamą</small>
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="description" class="sr-only">Aprašymas</label>
                    <input id="description" name="description" type="text" class="w-full p-2 border rounded @error('description') border-red-500 @enderror" placeholder="Aprašymas" value="{{ old('description', $report->description) }}" required>
                    @error('description')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <small>Nurodykite svarbiausius bei išskirtinius augintinio bruožus</small>
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="address" class="sr-only">Adresas</label>
                    <input id="address" name="address" type="text" class="w-full p-2 border rounded @error('address') border-red-500 @enderror" placeholder="Adresas" value="{{ old('address', $report->address) }}" required>
                    @error('address')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <small>Kur pasimetė ar kur radote augintinį? Nurodykite miestą, gatvę, šalia esančias įstaigas</small>
                </div>
                <div class="mb-2 sm:mb-4">
                    <label for="date" class="@error('date') text-red-500 @enderror">Data</label>
                    <input type="date" id="date" name="date" class="block w-full p-2 border rounded bg-white @error('date') border-red-500 @enderror" value="{{ old('date', $report->date) }}" required>
                    @error('date')
                        <div class="text-red-500 text-xs sm:text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                    <small>Diena, kai pasimetė ar radote augintinį</small>
                </div>
                <button type="submit" class="block mx-auto px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white">Pateikti</button>
            </div>
        </form>
    </div>
@endsection
