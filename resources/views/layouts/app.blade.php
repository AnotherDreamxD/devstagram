<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('style') {{-- @stack sirve para reservar un espacio en el cual se colocara una hoja de estilo --}}
    <title>DevStagram - @yield('titulo')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles

</head>
<body class="bg-gray-100">

    <header class="p-5 border-b bg-white shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home')}}" class="text-3x; font-black">Devstagram</a>
            <nav class="flex gap-2 items-center">
                @auth
                <a href="{{ route('post.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                      </svg>
                    Crear
                </a>
                <a href="{{ route('post.index',auth()->user()->username) }}" class="fond-bold  text-gray-600 text-sm ">Hola: <span>{{ auth()->user()->username }}</span></a>
                <form method="post" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="fond-bold uppercase text-gray-600 text-sm ">Cerrar Session</button>
                </form>
                
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="fond-bold uppercase text-gray-600 text-sm ">Login</a>
                    <a href="{{ route('register') }}" class="fond-bold uppercase text-gray-600 text-sm ">Crear Cuenta</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-10">
        <h2 class="font-black text-center text-3xl">@yield('titulo')</h2><br>
        @yield('contenido')
    </main>
    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados {{ now()->year }}
    </footer>

    @livewireScripts
</body>
</html>
