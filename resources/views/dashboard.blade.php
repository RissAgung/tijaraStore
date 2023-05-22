@extends('layout.main')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- main container --}}
    <div class="flex flex-col w-full h-full lg:h-[85vh] p-3 min-[400px]::p-6">

        {{-- top --}}
        <h2 class="mb-3 poppins-medium">Informasi Terkini</h2>

        <div class="flex flex-col lg:flex-row w-full h-full gap-3">
            {{-- left --}}
            <div class="flex flex-col w-full h-full gap-3 lg:w-[70%]">

                {{-- Informasi terkini --}}
                <div class="w-full flex flex-col lg:h-1/2">
                    {{-- chart bar --}}
                    <div id="container_chart"
                        class="flex items-center justify-center w-full max-lg:aspect-square bg-white lg:h-full border-[1px] border-[#DCDADA] rounded-md">
                        <div id="chart" class=""></div>
                    </div>
                </div>

                {{-- produk stok menipis --}}
                <div class="flex flex-col justify-between w-full lg:h-1/2">
                    <h2 class="poppins-medium mb-3">Produk Stok Menipis</h2>

                    <div
                        class="flex overflow-auto scrollbar-hide bg-white w-full max-md:h-64 max-lg:aspect-video lg:h-[90%] border-[1px] border-[#DCDADA] rounded-md px-3 md:px-5">

                        <table class="w-full text-xs">
                            <thead class="sticky top-0 bg-white">
                                <tr>
                                    <th class="p-5"></th>
                                    <th class="p-5">Kode Barang</th>
                                    <th class="p-5">Nama</th>
                                    <th class="p-5">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $index)
                                    <tr>
                                        <td class="text-center p-3 w-[5%]">
                                            <div class="w-10 aspect-square rounded-sm overflow-hidden">
                                                <img class="w-full h-full object-cover"
                                                    onError="this.onerror=null;this.src='https://oneshaf.com/wp-content/uploads/2022/12/placeholder-5-300x200.png';"
                                                    src="{{ asset('uploads/products/' . $index->gambar) }}"
                                                    alt="ini foto produk">
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $index->kode_br }}</td>
                                        <td class="text-center">{{ $index->nama_br }}</td>
                                        <td class="text-center">{{ $index->stok }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            {{-- right --}}
            <div class="flex w-full h-full lg:w-[30%]">

                {{-- pie chart --}}


                <div id="container_pie_chart"
                    class="bg-white flex flex-col items-center justify-center w-full max-lg:aspect-square border-[1px] border-[#DCDADA] rounded-md">
                    <div class="w-full px-8 py-5">
                        <h2 class="max-lg:text-center">Produk terlaris</h2>
                    </div>
                    <div class="flex justify-center items-center w-full h-full">
                        <div id="pie_chart_pria" class=""></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('otherjs')
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script src="{{ asset('js/controllers/dashboard.js') }}"></script>
@endsection
