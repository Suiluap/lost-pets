@extends('layouts.main')

@section('content')
    <div class="mx-2">
        <div class="mx-2 max-w-lg mx-auto bg-white rounded p-4 sm:p-6 my-12 sm:my-24 shadow">
            <h1 class="text-center text-lg sm:text-2xl mb-2 sm:mb-4">Statusai</h1>
            <table class="w-full text-sm sm:text-base">
                <thead class="text-center">
                    <tr>
                        <th>Statusas</th>
                        <th>Veiksmai</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($statuses as $status)
                        <tr class="border-t border-gray-300">
                            <td>{{ $status->name }}</td>
                            @if ($status->id == 1 || $status->id == 2 || $status->id == 3)
                                <td>
                                    <i class="fas fa-times text-gray-500"></i>
                                </td>
                            @else
                                <td>
                                    <div class="flex justify-center py-1">
                                        <a class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-full" href="{{ route("status", $status) }}"><i class="fas fa-wrench"></i></a>
                                        <form class="mb-0" action="{{ route("status", $status) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="p-2 ml-1 bg-red-500 text-white rounded-full hover:bg-red-600" type="submit" onclick="return confirm('Ar tikrai norite šalinti šį statusą?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-6 text-center">
                <a class="px-3 py-2 bg-green-500 hover:bg-green-600 rounded text-white" href="{{ route("status.add") }}">Pridėti</a>
            </div>
        </div>
    </div>
@endsection
