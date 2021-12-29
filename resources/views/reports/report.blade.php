@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <div class="max-w-3xl mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow">
            @auth
                <div class="flex justify-center sm:justify-end fa-md">
                    @if ($report->ownedByUser() || auth()->user()->isAdmin())
                        <a class="p-2 mr-1 bg-blue-500 hover:bg-blue-600 text-white rounded" href="{{ route('report.edit', $report) }}"><i class="fas fa-wrench"></i></a>
                        <form class="mb-0" action="{{ route('report', $report) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="p-2 ml-1 bg-red-500 text-white rounded hover:bg-red-600" type="submit" onclick="return confirm('Ar tikrai norite šalinti šį skelbimą?')"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                    @if (!$report->ownedByUser())
                        @if (!$report->savedByUser())
                            <form class="mb-0" action="{{ route('save', $report) }}" method="post">
                                @csrf
                                <button class="ml-2 p-2 bg-green-500 text-white rounded hover:bg-green-600" type="submit"><i class="fas fa-save"></i></button>
                            </form>
                        @else
                            <form class="mb-0" action="{{ route('save', $report) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="ml-2 p-2 bg-red-500 text-white rounded hover:bg-red-600" type="submit"><i class="fas fa-save"></i></button>
                            </form>
                        @endif
                    @endif
                </div>
                <hr class="my-2 sm:my-3">
            @endauth
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 ">
                <div>
                    <img src={{ url("/pictures/$report->user_id/$report->picture") }} alt="Augintinio nuotrauka" class="rounded w-full">
                </div>
                <div>
                    <h1 class="text-center text-base sm:text-lg">
                        {{ $report->name }}
                    </h1>
                    <div class="text-sm sm:text-base">
                        <ul>
                            @if (($report->status_id != 1) || ($report->status_id == 2) || ($report->status_id == 3))
                                <li>
                                    <i class="fas fa-angle-right text-indigo-500"></i> Statusas: {{ $report->status->name }}
                                </li>
                            @elseif ($report->status_id == 3)
                                <li>
                                    <i class="fas fa-angle-right text-indigo-500"></i> Pas šeimininką
                                </li>
                            @else
                                <li>
                                    <i class="fas fa-angle-right text-indigo-500"></i> Kada @if($report->status_id == 1) pasimetė: @else rastas: @endif {{ $report->date }}
                                </li>
                                <li>
                                    <i class="fas fa-angle-right text-indigo-500"></i> @if($report->status_id == 1) Pasimetė iš: @else Rastas prie: @endif {{ $report->address }}
                                </li>
                                <li>
                                    <i class="fas fa-angle-right text-indigo-500"></i> Aprašymas: {{ $report->description }}
                                </li>
                            @endif
                        </ul>
                    </div>
                    <hr class="my-2 sm:my-3">
                    <h2 class="text-center text-base sm:text-lg">
                        Skelbėjo informacija
                    </h2>
                    <div class="text-sm sm:text-base">
                        <ul>
                            <li>
                                <i class="fas fa-angle-right text-indigo-500"></i> Vardas: {{ $report->user->name }}
                            </li>
                            <li>
                                <i class="fas fa-angle-right text-indigo-500"></i> El. paštas: {{ $report->user->email }}
                            </li>
                            <li>
                                <i class="fas fa-angle-right text-indigo-500"></i> Telefono nr: {{ $report->user->phone_number }}
                            </li>
                            <li>
                                <i class="fas fa-angle-right text-indigo-500"></i> Miestas: {{ $report->user->town }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-2 sm:my-3">
            <div>
                <h2 class="text-center text-base sm:text-lg">Komentarai</h2>
                @auth
                    <form class="mt-2 sm:mt-3 mb-0" action="{{ route('report', $report) }}" method="post">
                        @csrf
                        <div class="bg-gray-200 rounded p-1 flex">
                            <label for="comment" class="sr-only">Naujas komentaras</label>
                            <input id="comment" name="comment" type="text" class="text-sm sm:text-base w-full p-1 border rounded @error('comment') border-red-500 @enderror" placeholder="Naujas komentaras...">
                            <button type="submit" class="bg-indigo-400 hover:bg-indigo-500 rounded text-white text-sm sm:text-base ml-1 p-1">Įrašyti</button>
                        </div>
                        @error('comment')
                            <div class="text-red-500 text-xs sm:text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                @endauth

                @if ($comments->count())
                    @foreach ($comments as $comment)
                        <div class="bg-gray-200 rounded mt-3 sm:mt-4 p-1">
                            <i class="text-sm sm:text-base"><i class="far fa-comment"></i> {{ $comment->user->name }}</i> <small class="text-xs sm:text-sm">{{ $comment->created_at->diffForHumans() }}</small>
                            @if (Auth::check() && ($comment->ownedByUser() || $report->ownedByUser() || auth()->user()->isAdmin()))
                                <form class="float-right" action="{{ route('comment', [$report, $comment]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 text-red-500 hover:text-red-600" onclick="return confirm('Ar tikrai norite šalinti šį komentarą?')"><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{ route('comment', [$report, $comment]) }}" class="float-right p-1 text-blue-500 hover:text-blue-600"><i class="fas fa-wrench"></i></a>
                            @endif
                            <div class="pl-3 text-sm sm:text-base">{{ $comment->text }}</div>
                        </div>
                    @endforeach
                    <div class="flex flex-col items-center @if($comments->total() > 5) mt-3 sm:mt-4 @endif">
                        {{ $comments->onEachSide(2)->links() }}
                    </div>
                @else
                    <div class="text-center text-sm sm:text-base mt-2 sm:mt-3">Šis skelbimas komentarų neturi</div>
                @endif
            </div>
        </div>
    </div>
@endsection
