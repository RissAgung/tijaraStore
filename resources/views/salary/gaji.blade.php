@extends('layout.main')

@section('title_page')
    Gaji
@endsection

@section('title')
    Gaji
@endsection

@section('modal')
    @include('modal.add_gaji')
    @include('modal.update_gaji')
    @include('modal.filterDate.filter')
@endsection

@section('content')

    {{-- loading --}}
    <div id="loading"
        class="fixed w-full h-full top-0 left-0 flex flex-col justify-center items-center bg-slate-50 z-[99999]">
        <div class="loadingspinner"></div>
    </div>

    <?php $urlexport = '/salary/export/all';
    if (Request::segment(2) != '' && Request::query('search')) {
        $urlexport = '/salary/export/filter-with-search/' . Request::segment(2) . '?search=' . Request::query('search');
    } else {
        if (Request::segment(2) != '') {
            $urlexport = '/salary/export/filter/' . Request::segment(2);
        }
    }
    
    if (Request::has('search') && Request::segment(2) == '') {
        $urlexport = '/salary/export/search';
    }
    ?>

    <div class=" h-fit bg-white border-b-2">
        <div class=" flex flex-col px-4 md:px-12 justify-between gap-4 md:flex-row py-4 md:items-center">


            {{-- search --}}
            <div class="flex items-center md:w-1/2 h-full gap-2">
                <svg class="w-[20px] h-[20px] md:w-[20px] md:h-[21px] mr-4" viewBox="0 0 25 26" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.1158 19.7364C15.9969 19.7364 19.9538 15.8248 19.9538 10.9995C19.9538 6.17431 15.9969 2.2627 11.1158 2.2627C6.23472 2.2627 2.27783 6.17431 2.27783 10.9995C2.27783 15.8248 6.23472 19.7364 11.1158 19.7364Z"
                        fill="white" stroke="black" stroke-width="3" />
                    <path d="M17.3374 17.7676L23.0022 24.1676" stroke="black" stroke-width="3" />
                </svg>
                <form action="/salary/{{ $dataUrl['date'] }}" method="GET" id="form_search" class="w-full h-full">
                    <input type="search" id="field_search" name="search" class="outline-none w-full"
                        placeholder="Nama pegawai" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                </form>
            </div>
            {{-- endsearch --}}


            <!-- button delete & add -->
            <div class=" flex flex-row gap-2 justify-between">
                <div id="btn_filter" onclick="showModalFilter()"
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
                    <div class="flex flex-row gap-2">
                        @if (count($dataGaji->items()) != 0)
                            <a href="{{ $urlexport }}" id="btn_export"
                                class="bg-[#000000] py-2 gap-2 px-4 rounded-md flex flex-row justify-center drop-shadow-sm cursor-pointer">
                                <p class="poppins-regular text-slate-200 hidden md:flex">Export</p>
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
                    </div>

                    <div id="btn_tambah"
                        class="bg-[#FFB015] hover:bg-[#e7a013] w-[46px] md:w-fit px-4 gap-2 rounded-md items-center flex justify-center drop-shadow-sm cursor-pointer">
                        <svg class="mt-0" width="15" height="15" viewBox="0 0 15 15" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.497057 7.69705C0.497055 8.35979 1.03432 8.89705 1.69706 8.89705L6.49706 8.89705L6.49706 13.697C6.49706 14.3598 7.03432 14.8971 7.69704 14.897C8.35977 14.897 8.89702 14.3598 8.89704 13.697L8.89706 8.89705L13.697 8.89704C14.3598 8.89699 14.8971 8.35973 14.8971 7.69703C14.8971 7.03433 14.3598 6.49707 13.6971 6.49704L8.89705 6.49705L8.89707 1.69704C8.89705 1.03432 8.35979 0.497062 7.69707 0.497041C7.03435 0.497022 6.49709 1.03428 6.49706 1.69705L6.49706 6.49705L1.69705 6.49705C1.03431 6.49706 0.497059 7.03431 0.497057 7.69705Z"
                                fill="black" />
                        </svg>
                        <p class="text-black poppins-regular hidden lg:flex">Tambah</p>
                    </div>

                    <a href="/salary" id="btn_reset"
                        class="bg-[#000000] w-[46px] px-2 rounded-md flex justify-center items-center drop-shadow-sm">
                        <svg width="15" height="15" viewBox="0 0 23 23" fill="none"
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
            {{-- end tambah hapus dan reset --}}


        </div>
    </div>

    <div class="h-[80vh] flex flex-col px-6 py-4">
        @if (count($dataGaji->items()) != 0)
            <div class="h-full w-full overflow-x-auto">
                <table class=" w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr>
                            <th class="tracking-wide text-center text-sm poppins-regular">Tanggal</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Nama Pegawai</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Posisi</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Gaji Pokok</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Bonus</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Pinjaman</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Gaji Total</th>
                            <th class="tracking-wide text-center text-sm poppins-regular">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($dataGaji as $salary)
                            <tr class="bg-white border-2 ">
                                <td class="tracking-wide text-center p-3">
                                    {{ DateTime::createFromFormat('Y-m-d', $salary->tanggal)->format('d M Y') }}</td>
                                <td class="tracking-wide text-center p-3">{{ $salary->nama_pegawai }}</td>
                                <td class="tracking-wide text-center p-3">{{ $salary->posisi }}</td>
                                <td class="tracking-wide text-center p-3">@money($salary->gaji_pokok)</td>
                                <td class="tracking-wide text-center p-3">@money($salary->bonus)</td>
                                <td class="tracking-wide text-center p-3">@money($salary->pinjaman)</td>
                                <td class="tracking-wide text-center p-3">@money($salary->gaji_total)</td>
                                <td class="tracking-wide text-center p-3">
                                    <div class="flex flex-row gap-2 justify-center">
                                        <div onclick="ubah({{ $salary }})"
                                            class="bg-[#FFB015] py-4 w-[46px] px-2 rounded-md flex justify-center drop-shadow-sm">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="mt-4 flex flex-col justify-center md:flex-row md:justify-between gap-2 py-2 items-center">
                {{ $dataGaji->onEachSide(2)->links('vendor.pagination.CustomPagination') }}
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
    </div>
@endsection

@section('otherjs')
    @include('modal.filterDate.controller')
    <script src="{{ asset('js/controllers/salary.js') }}"></script>
    @if ($errors->any())
        @if (session('update'))
            <script>
                showModalUpdate()
            </script>
        @elseif(session('tambah'))
            <script>
                showModal()
            </script>
        @endif
    @endif
@endsection
