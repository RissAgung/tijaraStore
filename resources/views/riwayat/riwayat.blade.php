@extends('layout.main')

@section('title')
    Riwayat Transaksi
@endsection

@section('othercss')
    <link rel="stylesheet" href="{{ asset('css/DatePicker.css') }}">
@endsection

@section('modal')
    @include('riwayat.filter')
    @include('riwayat.detail')
    @include('riwayat.struk')
@endsection

@section('content')
    <div class=" h-fit bg-white border-b-2">
        <div class=" flex flex-col px-4 md:px-12 justify-between gap-4 mt-0 md:flex-row py-4">
            <div class="flex-row w-full max-w-md flex gap-2 items-center">
                <div class="h-8 w-8">
                    <svg width="25" height="26" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1157 19.7368C15.9968 19.7368 19.9537 15.8252 19.9537 11C19.9537 6.17477 15.9968 2.26315 11.1157 2.26315C6.23466 2.26315 2.27777 6.17477 2.27777 11C2.27777 15.8252 6.23466 19.7368 11.1157 19.7368Z"
                            fill="white" stroke="black" stroke-width="3" />
                        <path d="M17.3374 17.7682L23.0022 24.1682" stroke="black" stroke-width="3" />
                    </svg>
                </div>


                <input id="keyword" class=" py-2 px-2 w-full flex-grow outline-none" type="text"
                    placeholder="Masukkan nama atau kode barang"
                    value="{{ Request::segment(2) == 'search' ? Request::segment(3) : '' }}">

            </div>

            <div class=" flex flex-row justify-center">
                {{-- <div class="flex flex-row gap-4 items-center text-center mr-4 md:mr-8">
                    <p class="text-center items-center w-12 md:w-full">Filter By: </p>
                    <select class="h-12 px-4 w-[30vw] md:w-32 outline-none rounded-lg appearance-none" name=""
                        id="">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Anak-Anak">Anak Anak</option>
                    </select>
                </div> --}}

                <div class=" flex flex-row w-full justify-between gap-2">
                    <div id="btn_filter" onclick="showModal()"
                        class="bg-[#FFB015] hover:bg-[#e7a013] py-2 gap-2 px-4 rounded-md flex flex-row justify-center drop-shadow-sm cursor-pointer">
                        <p class="poppins-regular ">Filter</p>
                        <svg class="mt-1" width="16" height="16" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.69335 5.80943L1.69349 5.80958L7.39553 11.9412V16.2788C7.39553 16.4247 7.43109 16.5683 7.49903 16.6982C7.56694 16.8281 7.66521 16.9403 7.78552 17.0266L11.0593 19.3735C11.2269 19.4937 11.4298 19.5581 11.6378 19.5581C11.8925 19.5581 12.138 19.4614 12.3201 19.2874C12.5024 19.1131 12.6062 18.8753 12.6062 18.6258V11.9412L18.3058 5.81035L18.3059 5.81025C18.7336 5.34936 19.0137 4.77942 19.1114 4.16866C19.2092 3.55786 19.1202 2.93325 18.8557 2.37014C18.5913 1.80711 18.1628 1.33009 17.6229 0.995643C17.083 0.661228 16.4542 0.483288 15.812 0.482568H15.8118L4.18992 0.482568L4.18983 0.482568C3.54756 0.482956 2.9186 0.660601 2.37849 0.994791C1.83833 1.32902 1.40962 1.80588 1.14487 2.36885C0.880087 2.93189 0.790882 3.55653 0.888393 4.16742C0.985898 4.77826 1.26577 5.34836 1.69335 5.80943ZM10.6693 11.5848V11.5849V16.769L9.33242 15.8106V11.585C9.33242 11.585 9.33242 11.585 9.33242 11.5849C9.33248 11.3548 9.2442 11.1338 9.08611 10.9634L9.08602 10.9633L3.13706 4.56592C3.13701 4.56587 3.13696 4.56582 3.13692 4.56577C2.95862 4.37281 2.84301 4.1356 2.80293 3.88281C2.76285 3.62999 2.79985 3.37132 2.90989 3.13755C3.01998 2.9037 3.1988 2.70413 3.42588 2.56355C3.65299 2.42294 3.91834 2.3476 4.19005 2.34719C4.19008 2.34719 4.19011 2.34719 4.19013 2.34719L15.8117 2.34719C16.0835 2.34747 16.3491 2.42277 16.5764 2.56342C16.8036 2.70404 16.9825 2.90371 17.0926 3.13769L17.2283 3.07382L17.0926 3.13769C17.2027 3.37159 17.2396 3.63042 17.1994 3.88335C17.1592 4.13623 17.0434 4.3735 16.8649 4.56642C16.8649 4.56649 16.8648 4.56656 16.8647 4.56663L10.9166 10.9633C10.9166 10.9633 10.9165 10.9633 10.9165 10.9633C10.7581 11.1335 10.6695 11.3546 10.6693 11.5848Z"
                                fill="black" stroke="black" stroke-width="0.3" />
                        </svg>


                    </div>

                    <div class="flex flex-row gap-2">

                        @if (count($data->items()) != 0)
                            <a href="/riwayat/export/{{ Request::segment(2) != '' ? Request::segment(2) . '/' . Request::segment(3) : 'all' }}"
                                id="btn_export"
                                class="bg-[#000000] py-2 gap-2 px-4 rounded-md flex flex-row justify-center drop-shadow-sm cursor-pointer">
                                <p class="poppins-regular text-slate-200">Export</p>
                                <svg class="mt-[1px]" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 2C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2M13 3.5L18.5 9H13M8.93 12.22H16V19.29L13.88 17.17L11.05 20L8.22 17.17L11.05 14.35"
                                        fill="white" />
                                </svg>
                            </a>
                        @else
                            <div onclick="showAlert('Tidak ada data yang bisa diexport')"
                                class="bg-[#000000] py-2 gap-2 px-4 rounded-md flex flex-row justify-center drop-shadow-sm cursor-pointer">
                                <p class="poppins-regular text-slate-200">Export</p>
                                <svg class="mt-[1px]" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 2C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2M13 3.5L18.5 9H13M8.93 12.22H16V19.29L13.88 17.17L11.05 20L8.22 17.17L11.05 14.35"
                                        fill="white" />
                                </svg>
                            </div>
                        @endif

                        <a href="/riwayat" id="btn_reset"
                            class="bg-[#000000] py-2 w-[46px] px-2 rounded-md flex justify-center drop-shadow-sm">
                            <svg width="23" height="23" viewBox="0 0 23 23" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.28381 6.93195C4.48234 4.86345 6.39176 3.30101 8.65655 2.53555C10.9213 1.77009 13.3871 1.85378 15.5948 2.77105C17.8025 3.68832 19.6015 5.37664 20.657 7.52165C21.7125 9.66667 21.9525 12.1222 21.3323 14.431C20.7121 16.7398 19.274 18.7445 17.2857 20.0718C15.2974 21.3992 12.8945 21.9588 10.5244 21.6463C8.15425 21.3339 5.97843 20.1707 4.40207 18.3734C2.82571 16.5761 1.95625 14.2672 1.95557 11.8765"
                                    stroke="white" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.11631 6.9481L3.18774 6.9481L3.18774 2.01953" stroke="white" stroke-width="2.3"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="h-[75vh] flex flex-col px-6 py-4 overflow-y-auto">
        @if (count($data->items()) != 0)
            <div class="h-full w-full overflow-x-auto">
                <table class=" w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr>
                            <th class="tracking-wide text-center pl-3 text-sm poppins-regular">No Transaksi</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Kasir</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Tanggal</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Total</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Bayar</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Kembalian</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form id="form_delete" action="#" method="post">
                            @csrf
                            @foreach ($data as $item)
                                <tr class="bg-white border-2 ">

                                    <td class="tracking-wide text-center p-3">{{ $item->kode_tr }}</td>
                                    <td class="tracking-wide text-center p-3">{{ $item->nama_kasir }}</td>
                                    <td class="tracking-wide text-center p-3">{{ $item->tanggal }}</td>
                                    <td class="tracking-wide text-center p-3">@money($item->total)</td>
                                    <td class="tracking-wide text-center p-3">@money($item->bayar)</td>
                                    <td class="tracking-wide text-center p-3">@money($item->kembalian)</td>
                                    <td class="tracking-wide text-center p-3">
                                        <div class="flex flex-row gap-2 justify-center">
                                            <div onclick="showModalDetail({{ $item }}, '{{ DNS1D::getBarcodePNG($item->kode_tr, 'C39', 1, 33, [0, 0, 0], true) }}')"
                                                class="bg-[#FFB015] py-4 w-[46px] px-2 rounded-md flex justify-center drop-shadow-sm">

                                                <svg width="16" height="16" viewBox="0 0 21 21" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14.875 8.75C11.4975 8.75 8.75 11.4975 8.75 14.875C8.75 18.2525 11.4975 21 14.875 21C18.2525 21 21 18.2525 21 14.875C21 11.4975 18.2525 8.75 14.875 8.75ZM14.875 19.25C12.46 19.25 10.5 17.29 10.5 14.875C10.5 12.46 12.46 10.5 14.875 10.5C17.29 10.5 19.25 12.46 19.25 14.875C19.25 17.29 17.29 19.25 14.875 19.25ZM16.1875 12.6875C16.1875 13.4137 15.6012 14 14.875 14C14.1488 14 13.5625 13.4137 13.5625 12.6875C13.5625 11.9613 14.1488 11.375 14.875 11.375C15.6012 11.375 16.1875 11.9613 16.1875 12.6875ZM15.75 15.75V17.5C15.75 17.9813 15.3562 18.375 14.875 18.375C14.3938 18.375 14 17.9813 14 17.5V15.75C14 15.2688 14.3938 14.875 14.875 14.875C15.3562 14.875 15.75 15.2688 15.75 15.75ZM7.875 18.375C7.875 18.8563 7.48125 19.25 7 19.25H4.375C1.96 19.25 0 17.29 0 14.875V4.375C0 1.96 1.96 0 4.375 0H9.415C10.3337 0 11.235 0.37625 11.8913 1.02375L14.7262 3.85875C15.3125 4.445 15.6712 5.22375 15.7413 6.04625C15.7762 6.5275 15.4175 6.9475 14.9362 6.99125C14.91 6.99125 14.8925 6.99125 14.8663 6.99125C14.4113 6.99125 14.035 6.64125 13.9913 6.18625C13.9913 6.16 13.9913 6.1425 13.9913 6.11625H11.3837C10.4213 6.11625 9.63375 5.32875 9.63375 4.36625V1.7675C9.56375 1.7675 9.49375 1.75 9.42375 1.75H4.375C2.93125 1.75 1.75 2.93125 1.75 4.375V14.875C1.75 16.3188 2.93125 17.5 4.375 17.5H7C7.48125 17.5 7.875 17.8937 7.875 18.375Z"
                                                        fill="black" />
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
                {{ $data->onEachSide(2)->links('vendor.pagination.CustomPagination') }}
            </div>
        @else
            <div class="flex items-center w-full h-full">
                <div class="flex flex-col items-center w-full">
                    <img class="object-cover w-[90%] lg:w-[40%]" src="{{ asset('/assets/images/nodata.svg') }}"
                        alt="nodata">
                    <p class="text-2xl poppins-semibold">No Data</p>
                </div>
            </div>
        @endif


    </div>
@endsection

@section('otherjs')
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/DatePicker.js') }}"></script>
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('js/jspdf.js') }}"></script>
    @include('riwayat.controller')
@endsection
