@extends('layouts.main')

@section('content')
    @if ($users->count())
        <div class="mx-2">
            <div class="max-w-5xl mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow">
                @if(session('status'))
                    <div class="text-sm sm:text-base text-green-500 text-center">
                        {{ session('status') }}
                    </div>
                @endif
                <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">
                    Registruoti naudotojai
                </h1>

                <div class="overflow-x-auto @if($users->total() > 20) mb-2 sm:mb-4 @endif">
                    <table class="w-full text-sm sm:text-base">
                        <thead class="text-center">
                            <tr>
                                <th>Vardas</th>
                                <th>El. paštas</th>
                                <th>Tel. nr.</th>
                                <th>Miestas</th>
                                <th>Rolė</th>
                                <th>Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $user)
                                <tr class="border-t border-gray-300">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->town }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <div class="flex justify-center py-1">
                                            <a class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full" href="{{ route('user', $user) }}"><i class="fas fa-wrench"></i></a>
                                            <form class="mb-0" action="{{ route('user', $user) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 ml-1 bg-red-500 text-white rounded-full hover:bg-red-600" type="submit" onclick="return confirm('Ar tikrai norite šalinti šį naudotoją?')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col items-center">
                    {{ $users->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="bg-white">
            <div class="mx-2 my-24 sm:my-36 py-16 sm:py-36 text-center text-sm sm:text-lg">
                Šiuo metu registruotų naudotojų portale nėra <i class="far fa-frown"></i>
            </div>
        </div>
    @endif
@endsection
