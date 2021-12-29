<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasimetę augintiniai</title>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 relative pb-6 sm:pb-8">
    <header>
        <nav class="bg-indigo-100 shadow">
            <div class="max-w-6xl mx-auto">
                <div class="flex justify-between p-1">
                    <div class="hidden sm:flex items-center space-x-1">
                        <i class="fas fa-paw fa-2x pl-1 pr-2"></i>
                        <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('list', ['status' => '1']) }}">Pasimetę</a>
                        <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('list', ['status' => '2']) }}">Rasti</a>
                        @auth
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('saved') }}">Įsiminti</a>
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('my') }}">Mano</a>
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('add') }}">Įkelti</a>
                        @endauth
                    </div>

                    <div class="hidden sm:flex items-center space-x-1">
                        @guest
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('login') }}">Prisijungti</a>
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('register') }}">Registruotis</a>
                        @endguest

                        @auth
                            @admin
                                <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('statuses') }}">Statusai</a>
                                <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('users') }}">Naudotojai</a>
                            @endadmin
                            <a class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" href="{{ route('me') }}">Aš</a>
                            <form class="m-0 p-0" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="px-3 py-2 hover:bg-indigo-200 rounded transition duration-300" type="submit">Atsijungti</button>
                            </form>
                        @endauth
                    </div>

                    <div class="flex sm:hidden items-center">
                        <i class="fas fa-paw fa-2x"></i>
                    </div>

                    <div class="flex sm:hidden items-center">
                        <button id="mobile-menu-button" class="mr-2" onclick="triggerMenu();">
                            <i class="fas fa-bars fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="mobile-menu" class="hidden">
                <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('list', ['status' => '1']) }}">Pasimetę</a>
                <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('list', ['status' => '2']) }}">Rasti</a>
                @guest
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('login') }}">Prisijungti</a>
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('register') }}">Registruotis</a>
                @endguest

                @auth
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('saved') }}">Įsiminti</a>
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('my') }}">Mano</a>
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('add') }}">Įkelti</a>
                    @admin
                        <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('statuses') }}">Statusai</a>
                        <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('users') }}">Naudotojai</a>
                    @endadmin
                    <a class="block text-sm text-center px-3 py-2 hover:bg-indigo-200" href="{{ route('me') }}">Aš</a>
                    <form class="m-0 p-0 block" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="text-sm text-center px-3 py-2 w-full hover:bg-indigo-200" type="submit">Atsijungti</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <body>
        @yield('content')
    </body>

    <footer class="absolute left-0 bottom-0 w-full h-6 leading-6 sm:h-8 sm:leading-8 bg-gray-300 text-center text-sm sm:text-base">
        © Paulius Mackevičius IFE-8
    </footer>
</body>
</html>
