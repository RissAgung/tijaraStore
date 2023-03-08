<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/output/main.css') }}">
    <title>Document</title>
</head>

<body class="bg-[#F7F7F7] w-screen h-screen">
    <div class="flex flex-row w-full h-full justify-between">

        {{-- sidebar --}}
        <div>
            @include('layout.sidebar')
        </div>
        {{-- end sidebar --}}

        {{-- content --}}
        <div class="flex flex-col w-full">

            {{-- top bar --}}
            <div>
                @include('layout.topBar')
            </div>
            {{-- end top bar --}}

            {{-- main content --}}
            <div>
                @yield('content')
            </div>
            {{-- main content --}}

        </div>
        {{-- end content --}}


    </div>
    <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
