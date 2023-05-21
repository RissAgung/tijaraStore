@extends('layout.main')

@section('title')
    Master Data Diskon
@endsection

@section('othercss')
@endsection

@section('modal')
    @include('discount.tambah_discount')
    @include('discount.ubah_discount')
    @include('discount.data')
@endsection

@section('content')
    <div class=" h-fit bg-white border-b-2">
        <div class="flex flex-row px-4 md:px-8 justify-between gap-0 mt-0 md:flex-row py-2">

            <div class=" flex flex-row justify-between w-full">
                <div class="flex flex-row px-2 gap-4 mb-2 poppins-medium cursor-default relative">
                    <p class="px-1 py-3">Diskon</p>
                    <a href="/voucher"><p class="text-[#8F8F8F]  px-1 py-3 hover:bg-gray-200 rounded-md">Voucher</p></a>
                    <div class="h-[4px] w-16 bg-primary absolute bottom-0">

                    </div>
                </div>
                <div class="flex flex-row gap-2 items-center">
                    <div id="btn_hapus"
                        class="bg-[#000000] w-[46px] md:w-fit px-4 rounded-md flex gap-2 justify-center items-center drop-shadow-sm cursor-pointer h-fit py-3">
                        <svg class="mt-0" width="14" height="17" viewBox="0 0 14 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.3 2.8H11.13C10.9675 2.00999 10.5377 1.30014 9.91288 0.790103C9.28808 0.280063 8.50654 0.00101817 7.7 0L6.3 0C5.49346 0.00101817 4.71192 0.280063 4.08712 0.790103C3.46233 1.30014 3.03247 2.00999 2.87 2.8H0.7C0.514348 2.8 0.336301 2.87375 0.205025 3.00503C0.0737498 3.1363 0 3.31435 0 3.5C0 3.68565 0.0737498 3.8637 0.205025 3.99497C0.336301 4.12625 0.514348 4.2 0.7 4.2H1.4V13.3C1.40111 14.2279 1.77022 15.1175 2.42635 15.7736C3.08249 16.4298 3.97208 16.7989 4.9 16.8H9.1C10.0279 16.7989 10.9175 16.4298 11.5736 15.7736C12.2298 15.1175 12.5989 14.2279 12.6 13.3V4.2H13.3C13.4857 4.2 13.6637 4.12625 13.795 3.99497C13.9263 3.8637 14 3.68565 14 3.5C14 3.31435 13.9263 3.1363 13.795 3.00503C13.6637 2.87375 13.4857 2.8 13.3 2.8ZM6.3 1.4H7.7C8.13419 1.40053 8.55759 1.53536 8.91213 1.78601C9.26667 2.03666 9.53499 2.39084 9.6803 2.8H4.3197C4.46501 2.39084 4.73333 2.03666 5.08787 1.78601C5.44241 1.53536 5.86581 1.40053 6.3 1.4ZM11.2 13.3C11.2 13.857 10.9788 14.3911 10.5849 14.7849C10.1911 15.1788 9.65695 15.4 9.1 15.4H4.9C4.34305 15.4 3.8089 15.1788 3.41508 14.7849C3.02125 14.3911 2.8 13.857 2.8 13.3V4.2H11.2V13.3Z"
                                fill="white" />
                            <path
                                d="M5.60002 12.6C5.78568 12.6 5.96372 12.5263 6.095 12.395C6.22627 12.2637 6.30002 12.0857 6.30002 11.9V7.7C6.30002 7.51435 6.22627 7.3363 6.095 7.20503C5.96372 7.07375 5.78568 7 5.60002 7C5.41437 7 5.23633 7.07375 5.10505 7.20503C4.97377 7.3363 4.90002 7.51435 4.90002 7.7V11.9C4.90002 12.0857 4.97377 12.2637 5.10505 12.395C5.23633 12.5263 5.41437 12.6 5.60002 12.6Z"
                                fill="white" />
                            <path
                                d="M8.40001 12.6C8.58566 12.6 8.76371 12.5263 8.89499 12.395C9.02626 12.2637 9.10001 12.0857 9.10001 11.9V7.7C9.10001 7.51435 9.02626 7.3363 8.89499 7.20503C8.76371 7.07375 8.58566 7 8.40001 7C8.21436 7 8.03631 7.07375 7.90504 7.20503C7.77376 7.3363 7.70001 7.51435 7.70001 7.7V11.9C7.70001 12.0857 7.77376 12.2637 7.90504 12.395C8.03631 12.5263 8.21436 12.6 8.40001 12.6Z"
                                fill="white" />
                        </svg>
                        <p class="text-white poppins-regular hidden lg:flex">Hapus</p>
                    </div>
                    <div onclick="showModalTambah()" id="btn_tambah"
                        class="bg-[#FFB015] hover:bg-[#e7a013] w-[46px] md:w-fit px-4 gap-2 rounded-md items-center flex justify-center drop-shadow-sm cursor-pointer h-fit py-3">
                        <svg class="mt-0" width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.497057 7.69705C0.497055 8.35979 1.03432 8.89705 1.69706 8.89705L6.49706 8.89705L6.49706 13.697C6.49706 14.3598 7.03432 14.8971 7.69704 14.897C8.35977 14.897 8.89702 14.3598 8.89704 13.697L8.89706 8.89705L13.697 8.89704C14.3598 8.89699 14.8971 8.35973 14.8971 7.69703C14.8971 7.03433 14.3598 6.49707 13.6971 6.49704L8.89705 6.49705L8.89707 1.69704C8.89705 1.03432 8.35979 0.497062 7.69707 0.497041C7.03435 0.497022 6.49709 1.03428 6.49706 1.69705L6.49706 6.49705L1.69705 6.49705C1.03431 6.49706 0.497059 7.03431 0.497057 7.69705Z"
                                fill="black" />
                        </svg>
                        <p class="text-black poppins-regular hidden lg:flex">Tambah</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row w-full flex-wrap h-fit justify-between bg-white border-b-2 items-center px-4 md:px-8 pt-4 md:pt-0">
        <div id="btn_filter_tags" class="flex h-full py-3 px-4 flex-row w-8 cursor-pointer items-center gap-4 order-2 flex-grow">
            <p class="poppins-semibold">Jenis</p>
            <select
                class="h-full py-2 px-4 outline-none rounded-lg appearance-none w-full max-w-[150px] border-2 border-dotted"
                name="select" id="filter_kategori">
                <option hidden></option>
                <option
                    @isset($_GET['value'])
                @if ($_GET['value'] == 'persen')
                    selected
                @endif
            @endisset
                    value="persen">Potongan Persen</option>
                <option
                    @isset($_GET['value'])
                @if ($_GET['value'] == 'nominal')
                    selected
                @endif
            @endisset
                    value="nominal">Nominal</option>
                <option
                    @isset($_GET['value'])
                @if ($_GET['value'] == 'free')
                    selected
                @endif
            @endisset
                    value="free">Free Product</option>
            </select>
        </div>

        <div class="flex-row flex px-4 rounded-md gap-2 items-center order-1 w-full md:w-[310px]">
            <div class="h-8 w-12">
                <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.1157 19.7368C15.9968 19.7368 19.9537 15.8252 19.9537 11C19.9537 6.17477 15.9968 2.26315 11.1157 2.26315C6.23466 2.26315 2.27777 6.17477 2.27777 11C2.27777 15.8252 6.23466 19.7368 11.1157 19.7368Z"
                        fill="white" stroke="black" stroke-width="3" />
                    <path d="M17.3374 17.7682L23.0022 24.1682" stroke="black" stroke-width="3" />
                </svg>
            </div>
            <form class="w-full" action="/diskon/search" method="GET">
                {{-- @csrf --}}
                <input value="@isset($_GET['find']){{ $_GET['find'] }}@endisset" name="find"
                    class=" py-2 px-2 w-full flex-grow outline-none" type="text"
                    placeholder="Masukkan kode diskon">
            </form>
        </div>
        <div class="flex overflow-x-scroll gap-3 scrollbar-hide flex-row h-full justify-end w-fit order-3 bg-red-400">
            {{-- isi --}}
            <a href="/diskon" id="btn_reset"
                class="bg-[#000000] px-4 rounded-md flex justify-center items-center drop-shadow-sm h-full py-3">
                <svg width="15" height="15" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3.28381 6.93195C4.48234 4.86345 6.39176 3.30101 8.65655 2.53555C10.9213 1.77009 13.3871 1.85378 15.5948 2.77105C17.8025 3.68832 19.6015 5.37664 20.657 7.52165C21.7125 9.66667 21.9525 12.1222 21.3323 14.431C20.7121 16.7398 19.274 18.7445 17.2857 20.0718C15.2974 21.3992 12.8945 21.9588 10.5244 21.6463C8.15425 21.3339 5.97843 20.1707 4.40207 18.3734C2.82571 16.5761 1.95625 14.2672 1.95557 11.8765"
                        stroke="white" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M8.11631 6.9481L3.18774 6.9481L3.18774 2.01953" stroke="white" stroke-width="2.3"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        </div>
    </div>


    <div class="h-[70vh] flex flex-col px-6 py-4">
        @if (count($barang->items()) != 0)
            <div class="h-full w-full overflow-x-auto">
                <table class=" w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="" class="" id="checkAll"></th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Kode Diskon</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Nama Barang</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Nominal</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="form_delete" action="/diskon/delete_selected" method="post">
                            @csrf
                            @foreach ($barang as $item)
                                <tr class="bg-white border-2 ">
                                    <td class="tracking-wide text-center p-3">
                                        <div class="flex flex-row justify-center gap-4">
                                            <input class="mt-2 idcheck" type="checkbox" name="ids[]" id=""
                                                value="{{ $item->kode_diskon }}">
                                        </div>
                                    </td>

                                    <td class="tracking-wide text-center p-3">{{ $item->kode_diskon }}</td>
                                    <td class="tracking-wide text-center p-3">{{ $item->nama_br }}</td>
                                    <td class="tracking-wide text-center p-3">
                                        @if ($item->diskon->kategori == 'nominal')
                                            @money($item->diskon->nominal)
                                        @elseif($item->diskon->kategori == 'persen')
                                            {{ $item->diskon->nominal . '%' }}
                                        @else
                                            {{ 'Beli ' . $item->diskon->buy . ' Gratis ' . $item->diskon->free }}
                                        @endif
                                    </td>
                                    <td class="tracking-wide text-center p-3">
                                        <div class="flex flex-row gap-2 justify-center">
                                            <div onclick="ubahData({{ $item }})"
                                                class="bg-[#FFB015] py-4 w-[46px] px-2 rounded-md flex justify-center drop-shadow-sm cursor-pointer">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.782019 12.7431C0.281449 13.2436 0.000151166 13.9223 0 14.6301L0 16H1.36987C2.07768 15.9998 2.75644 15.7186 3.25686 15.218L12.16 6.31484L9.68516 3.84L0.782019 12.7431Z"
                                                        fill="black" />
                                                    <path
                                                        d="M15.4823 0.517698C15.3184 0.353579 15.1237 0.223382 14.9094 0.134552C14.6951 0.045722 14.4654 0 14.2334 0C14.0014 0 13.7717 0.045722 13.5574 0.134552C13.3431 0.223382 13.1484 0.353579 12.9845 0.517698L10.624 2.87885L13.1212 5.376L15.4823 3.01552C15.6464 2.85157 15.7766 2.65689 15.8655 2.44259C15.9543 2.22829 16 1.99859 16 1.76661C16 1.53463 15.9543 1.30493 15.8655 1.09063C15.7766 0.876334 15.6464 0.681646 15.4823 0.517698Z"
                                                        fill="black" />
                                                </svg>

                                            </div>

                                            <div onclick="hapusData('/diskon/delete/{{ $item->kode_diskon }}?token={{ csrf_token() }}')"
                                                class="bg-[#000000] py-4 w-[46px] px-2 rounded-md flex justify-center drop-shadow-sm cursor-pointer">
                                                <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.3 2.8H11.13C10.9675 2.00999 10.5377 1.30014 9.91288 0.790103C9.28808 0.280063 8.50654 0.00101817 7.7 0L6.3 0C5.49346 0.00101817 4.71192 0.280063 4.08712 0.790103C3.46233 1.30014 3.03247 2.00999 2.87 2.8H0.7C0.514348 2.8 0.336301 2.87375 0.205025 3.00503C0.0737498 3.1363 0 3.31435 0 3.5C0 3.68565 0.0737498 3.8637 0.205025 3.99497C0.336301 4.12625 0.514348 4.2 0.7 4.2H1.4V13.3C1.40111 14.2279 1.77022 15.1175 2.42635 15.7736C3.08249 16.4298 3.97208 16.7989 4.9 16.8H9.1C10.0279 16.7989 10.9175 16.4298 11.5736 15.7736C12.2298 15.1175 12.5989 14.2279 12.6 13.3V4.2H13.3C13.4857 4.2 13.6637 4.12625 13.795 3.99497C13.9263 3.8637 14 3.68565 14 3.5C14 3.31435 13.9263 3.1363 13.795 3.00503C13.6637 2.87375 13.4857 2.8 13.3 2.8ZM6.3 1.4H7.7C8.13419 1.40053 8.55759 1.53536 8.91213 1.78601C9.26667 2.03666 9.53499 2.39084 9.6803 2.8H4.3197C4.46501 2.39084 4.73333 2.03666 5.08787 1.78601C5.44241 1.53536 5.86581 1.40053 6.3 1.4ZM11.2 13.3C11.2 13.857 10.9788 14.3911 10.5849 14.7849C10.1911 15.1788 9.65695 15.4 9.1 15.4H4.9C4.34305 15.4 3.8089 15.1788 3.41508 14.7849C3.02125 14.3911 2.8 13.857 2.8 13.3V4.2H11.2V13.3Z"
                                                        fill="white" />
                                                    <path
                                                        d="M5.60002 12.6C5.78568 12.6 5.96372 12.5262 6.095 12.395C6.22627 12.2637 6.30002 12.0856 6.30002 11.9V7.69999C6.30002 7.51434 6.22627 7.33629 6.095 7.20502C5.96372 7.07374 5.78568 6.99999 5.60002 6.99999C5.41437 6.99999 5.23633 7.07374 5.10505 7.20502C4.97377 7.33629 4.90002 7.51434 4.90002 7.69999V11.9C4.90002 12.0856 4.97377 12.2637 5.10505 12.395C5.23633 12.5262 5.41437 12.6 5.60002 12.6Z"
                                                        fill="white" />
                                                    <path
                                                        d="M8.40001 12.6C8.58566 12.6 8.76371 12.5262 8.89499 12.395C9.02626 12.2637 9.10001 12.0856 9.10001 11.9V7.69999C9.10001 7.51434 9.02626 7.33629 8.89499 7.20502C8.76371 7.07374 8.58566 6.99999 8.40001 6.99999C8.21436 6.99999 8.03631 7.07374 7.90504 7.20502C7.77376 7.33629 7.70001 7.51434 7.70001 7.69999V11.9C7.70001 12.0856 7.77376 12.2637 7.90504 12.395C8.03631 12.5262 8.21436 12.6 8.40001 12.6Z"
                                                        fill="white" />
                                                </svg>
                                            </div>


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex flex-col justify-center md:flex-row md:justify-between gap-2 py-2 items-center">
                {{ $barang->onEachSide(2)->links('vendor.pagination.CustomPagination') }}
            </div>
        @else
            <div class="h-full justify-center items-center flex-grow flex w-full">
                <div class="flex flex-col items-center">
                    <div class="h-full items-center w-full flex justify-center">
                        <img class="object-cover h-80 w-100" src="{{ asset('/assets/images/nodata.svg') }}"
                            alt="nodata">
                    </div>
                    <p class="text-2xl poppins-semibold">No Data</p>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('otherjs')
    @include('discount.controller')
    @if ($errors->any())
        @if (session('update'))
            <script>
                showModalUbah();
            </script>
        @elseif(session('tambah'))
            <script>
                showModalTambah()
            </script>
        @endif
    @endif
@endsection
