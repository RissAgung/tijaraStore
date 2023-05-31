<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/output/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/Logo_App.png') }}">
    @yield('othercss')
    <title>@yield('title') | Tijara Store</title>
    @vite([])
</head>

<body class="bg-[#F7F7F7] w-full h-full box-border">
    <div class="flex flex-row w-full h-full justify-between">

        <div class="z-[100]">
            @yield('modal')
        </div>

        {{-- sidebar --}}
        <div>
            @include('layout.sidebar')
        </div>
        {{-- end sidebar --}}

        {{-- content --}}
        <div class="flex flex-col w-full lg:pl-[290px]">

            {{-- top bar --}}
            <div>
                @include('layout.topBar')
            </div>
            {{-- end top bar --}}

            {{-- main content --}}
            <div class="lg:h-full">
                @yield('content')
            </div>
            {{-- main content --}}

        </div>
        {{-- end content --}}


    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('otherjs')
</body>

</html>
