@extends('layouts.main')

@section('content')
    @if ($reports->count())
        <div class="mx-2">
            <div class="max-w-5xl mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow">
                @if(session('status'))
                    <div class="text-sm sm:text-base text-green-500 text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">
                    @if (Route::current()->getName() == 'list')
                        @if ($status->id == 1)
                            Pasimetę augintiniai
                        @else
                            Rasti augintiniai
                        @endif
                    @elseif (Route::current()->getName() == 'my')
                        Mano skelbimai
                    @else
                        Įsiminti skelbimai
                    @endif
                </h1>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 sm:gap-4 @if($reports->total() > 9) mb-2 sm:mb-4 @endif">
                    @foreach ($reports as $report)
                        <div class="rounded border relative pb-10 sm:pb-12">
                            <img src="{{ url("/pictures/$report->user_id/$report->picture") }}" alt="Augintinio nuotrauka" class="rounded-t w-full">
                            <h2 class="text-center text-base sm:text-lg">{{ $report->name }}</h2>
                            <div class="px-2 text-sm sm:text-base">
                                @if ($report->status_id == 1)
                                    Pasimetė iš: {{ $report->address }}
                                @elseif ($report->status_id == 2)
                                    Rastas prie: {{ $report->address }}
                                @else
                                    Pas šeimininką
                                @endif
                            </div>
                            <a href="{{ route("report", $report) }}" class="absolute bottom-0 left-0 w-full text-center inline-block px-3 py-2 bg-indigo-400 hover:bg-indigo-500 rounded-b text-white text-sm sm:text-base">Daugiau</a>
                        </div>
                    @endforeach
                </div>
                <div class="flex flex-col items-center">
                    {{ $reports->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="bg-white">
            <div class="mx-2 my-24 sm:my-36 py-16 sm:py-36 text-center text-sm sm:text-lg">
                @if(session('status'))
                    <div class="text-sm sm:text-base text-green-500 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                @if (Route::current()->getName() == 'list')
                    @if ($status->id == 1)
                        Šiuo metu pasimetusių augintinių skelbimų nėra
                    @else
                        Šiuo metu rastų augintinių skelbimų nėra
                    @endif
                @elseif (Route::current()->getName() == 'my')
                    Neturite įkeltų skelbimų
                @else
                    Neturite įsimintų skelbimų
                @endif
                <i class="fas fa-paw"></i>
            </div>
        </div>
    @endif
@endsection
