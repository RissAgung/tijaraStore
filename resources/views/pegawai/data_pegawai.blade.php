@extends('layout.main')

@section('title_page')
    MD Pegawai
@endsection

@section('title')
    Master Data Pegawai
@endsection

@section('modal')
    @include('modal.add_pegawai')
    @include('modal.edit_pegawai')
@endsection

@section('content')
    {{-- main container --}}

    {{-- loading --}}
    <div id="loading"
        class="fixed w-full h-full top-0 left-0 flex flex-col justify-center items-center bg-slate-50 z-[99999]">
        <div class="loadingspinner"></div>
    </div>

    {{-- top1 --}}
    <div
        class="flex w-full items-center justify-between md:h-16 bg-white border-b-[1px] border-b-[#DCDADA] text-[11px] md:text-[15px] py-2 px-[20px] md:px-[30px]">
        {{-- search --}}
        <div class="flex items-center md:w-1/2 h-full gap-2">
            <svg class="w-[15px] h-[16px] md:w-[20px] md:h-[21px]" viewBox="0 0 25 26" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M11.1158 19.7364C15.9969 19.7364 19.9538 15.8248 19.9538 10.9995C19.9538 6.17431 15.9969 2.2627 11.1158 2.2627C6.23472 2.2627 2.27783 6.17431 2.27783 10.9995C2.27783 15.8248 6.23472 19.7364 11.1158 19.7364Z"
                    fill="white" stroke="black" stroke-width="3" />
                <path d="M17.3374 17.7676L23.0022 24.1676" stroke="black" stroke-width="3" />
            </svg>
            <form action="{{ route('cari') }}" method="get">
                <input type="search" id="field_search" name="search" value=""
                    class="placeholder:text-[11px] md:placeholder:text-[15px] outline-none w-full pl-2"
                    placeholder="Kode / Nama Pegawai" value="">
            </form>
        </div>

        {{-- filter --}}
        <div class="flex h-full items-center gap-2">

            {{-- btn hapus --}}
            <button id="btn_hapus"
                class="flex justify-center items-center bg-black hover:bg-[#303030] text-white cursor-pointer h-[33px] md:h-[43px] p-3 rounded-md gap-2">
                <p class="max-md:hidden">hapus</p>

                <svg width="14" height="25" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.3 2.8H11.13C10.9675 2.00999 10.5377 1.30014 9.91288 0.790103C9.28808 0.280063 8.50654 0.00101817 7.7 0L6.3 0C5.49346 0.00101817 4.71192 0.280063 4.08712 0.790103C3.46233 1.30014 3.03247 2.00999 2.87 2.8H0.7C0.514348 2.8 0.336301 2.87375 0.205025 3.00503C0.0737498 3.1363 0 3.31435 0 3.5C0 3.68565 0.0737498 3.8637 0.205025 3.99497C0.336301 4.12625 0.514348 4.2 0.7 4.2H1.4V13.3C1.40111 14.2279 1.77022 15.1175 2.42635 15.7736C3.08249 16.4298 3.97208 16.7989 4.9 16.8H9.1C10.0279 16.7989 10.9175 16.4298 11.5736 15.7736C12.2298 15.1175 12.5989 14.2279 12.6 13.3V4.2H13.3C13.4857 4.2 13.6637 4.12625 13.795 3.99497C13.9263 3.8637 14 3.68565 14 3.5C14 3.31435 13.9263 3.1363 13.795 3.00503C13.6637 2.87375 13.4857 2.8 13.3 2.8ZM6.3 1.4H7.7C8.13419 1.40053 8.55759 1.53536 8.91213 1.78601C9.26667 2.03666 9.53499 2.39084 9.6803 2.8H4.3197C4.46501 2.39084 4.73333 2.03666 5.08787 1.78601C5.44241 1.53536 5.86581 1.40053 6.3 1.4ZM11.2 13.3C11.2 13.857 10.9788 14.3911 10.5849 14.7849C10.1911 15.1788 9.65695 15.4 9.1 15.4H4.9C4.34305 15.4 3.8089 15.1788 3.41508 14.7849C3.02125 14.3911 2.8 13.857 2.8 13.3V4.2H11.2V13.3Z"
                        fill="white" />
                    <path
                        d="M5.60002 12.6C5.78568 12.6 5.96372 12.5263 6.095 12.395C6.22627 12.2637 6.30002 12.0857 6.30002 11.9V7.7C6.30002 7.51435 6.22627 7.3363 6.095 7.20503C5.96372 7.07375 5.78568 7 5.60002 7C5.41437 7 5.23633 7.07375 5.10505 7.20503C4.97377 7.3363 4.90002 7.51435 4.90002 7.7V11.9C4.90002 12.0857 4.97377 12.2637 5.10505 12.395C5.23633 12.5263 5.41437 12.6 5.60002 12.6Z"
                        fill="white" />
                    <path
                        d="M8.39998 12.6C8.58563 12.6 8.76368 12.5263 8.89496 12.395C9.02623 12.2637 9.09998 12.0857 9.09998 11.9V7.7C9.09998 7.51435 9.02623 7.3363 8.89496 7.20503C8.76368 7.07375 8.58563 7 8.39998 7C8.21433 7 8.03628 7.07375 7.90501 7.20503C7.77373 7.3363 7.69998 7.51435 7.69998 7.7V11.9C7.69998 12.0857 7.77373 12.2637 7.90501 12.395C8.03628 12.5263 8.21433 12.6 8.39998 12.6Z"
                        fill="white" />
                </svg>
            </button>

            {{-- btn tambah --}}
            <button id="btn_tambah"
                class="flex justify-center items-center bg-primary hover:bg-[#f1a100] cursor-pointer h-[33px] md:h-[43px] p-3 rounded-md gap-2">
                <p class="max-md:hidden">tambah</p>
                <svg width="15" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.497057 7.69702C0.497055 8.35976 1.03432 8.89702 1.69706 8.89702L6.49706 8.89702L6.49706 13.697C6.49706 14.3598 7.03432 14.897 7.69704 14.897C8.35977 14.897 8.89702 14.3597 8.89704 13.697L8.89706 8.89702L13.697 8.89701C14.3598 8.89696 14.8971 8.3597 14.8971 7.697C14.8971 7.0343 14.3598 6.49704 13.6971 6.49701L8.89705 6.49702L8.89707 1.69701C8.89705 1.03429 8.35979 0.497031 7.69707 0.49701C7.03435 0.496991 6.49709 1.03425 6.49706 1.69702L6.49706 6.49702L1.69705 6.49702C1.03431 6.49703 0.497059 7.03428 0.497057 7.69702Z"
                        fill="black" />
                </svg>
            </button>
        </div>
    </div>


    {{-- top2 --}}
    <div
        class="flex w-full items-center md:h-16 bg-white border-b-[1px] border-b-[#DCDADA] text-[11px] md:text-[15px] py-2 px-[20px] md:px-[30px] gap-2">
        <p>gender</p>
        <!-- Select dropdown -->
        <select id="genderSelect" name="genderSelect" class="p-1 rounded-sm border-[1px] border-[#DCDADA]">
            <option selected value="" disabled></option>
            <option @if (Request::segment(3) == 'pria') selected @endif value="pria">pria</option>
            <option @if (Request::segment(3) == 'wanita') selected @endif value="wanita">wanita</option>
        </select>

        <p>Role</p>
        <!-- Select dropdown -->
        <select id="roleSelect" name="roleSelect" class="p-1 rounded-sm border-[1px] border-[#DCDADA]">
            <option selected value="" disabled></option>
            <option @if (Request::segment(3) == 'admin') selected @endif value="admin">Admin</option>
            <option @if (Request::segment(3) == 'kasir') selected @endif value="kasir">Kasir</option>
            <option @if (Request::segment(3) == 'pegawai') selected @endif value="pegawai">Pegawai</option>
        </select>

        <a href="{{ route('halaman_utama') }}">
            <svg width="17" height="17" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.96667 3.91655V1V0.7H5.66667H3.33333H3.03333V1V6.83333C3.03333 8.28585 4.21415 9.46667 5.66667 9.46667H11.5H11.8V9.16667V6.83333V6.53333H11.5H7.41874C9.48385 4.68707 12.1784 3.63333 15 3.63333C21.2673 3.63333 26.3667 8.73269 26.3667 15C26.3667 21.2673 21.2673 26.3667 15 26.3667C8.73269 26.3667 3.63333 21.2673 3.63333 15V14.7H3.33333H1H0.7V15C0.7 22.8855 7.11448 29.3 15 29.3C22.8855 29.3 29.3 22.8855 29.3 15C29.3 7.11448 22.8855 0.7 15 0.7C11.6744 0.7 8.49055 1.86249 5.96667 3.91655Z"
                    fill="#787777" stroke="#787777" stroke-width="0.6" />
            </svg>
        </a>

    </div>

    {{-- content --}}
    <div class="flex flex-col w-full lg:justify-between p-2 lg:h-[73vh] 2xl:h-[70vh]">
        {{-- table --}}
        <div class="w-full overflow-auto whitespace-nowrap text-ellipsis mt-3 md:mt-6 lg:mt-3">
            <table class=" w-full border-separate border-spacing-y-4 text-[11px] md:text-[15px] px-2">
                <thead>
                    <tr>
                        <th class="text-center text-[#787777]"></th>
                        <th class="text-center text-[#787777]">Kode Pegawai</th>
                        <th class="text-center text-[#787777]">Nama Pegawai</th>
                        <th class="text-center text-[#787777]">Gender</th>
                        <th class="text-center text-[#787777]">Username</th>
                        <th class="text-center text-[#787777]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <form id="form_delete" action="/pegawai/delete_selected" method="post">
                        @csrf
                        @foreach ($pegawai as $item)
                            <tr class="bg-white border-2 outline outline-[1px] outline-[#DCDADA] rounded-md">
                                <td class="text-center p-3"><input type="checkbox" name="ids[]"
                                        class="form-checkbox idcheck" id="" value="{{ $item->kode_pegawai }}"></td>
                                <td class="text-center p-3">{{ $item->kode_pegawai }}</td>
                                <td class="text-center p-3">{{ $item->nama }}</td>
                                <td class="text-center p-3">{{ $item->gender }}</td>
                                <td class="text-center p-3">
                                    @if ($item->account !== null)
                                        {{ $item->account->username }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center p-3">
                                    <button type="button"
                                        onclick="hapusData('/pegawai/delete/{{ $item->kode_pegawai }}')"
                                        class="flex justify-center items-center bg-black hover:bg-[#303030] text-white h-[33px] md:h-[43px] p-3 rounded">
                                        <svg width="14" height="25" viewBox="0 0 14 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.3 2.8H11.13C10.9675 2.00999 10.5377 1.30014 9.91288 0.790103C9.28808 0.280063 8.50654 0.00101817 7.7 0L6.3 0C5.49346 0.00101817 4.71192 0.280063 4.08712 0.790103C3.46233 1.30014 3.03247 2.00999 2.87 2.8H0.7C0.514348 2.8 0.336301 2.87375 0.205025 3.00503C0.0737498 3.1363 0 3.31435 0 3.5C0 3.68565 0.0737498 3.8637 0.205025 3.99497C0.336301 4.12625 0.514348 4.2 0.7 4.2H1.4V13.3C1.40111 14.2279 1.77022 15.1175 2.42635 15.7736C3.08249 16.4298 3.97208 16.7989 4.9 16.8H9.1C10.0279 16.7989 10.9175 16.4298 11.5736 15.7736C12.2298 15.1175 12.5989 14.2279 12.6 13.3V4.2H13.3C13.4857 4.2 13.6637 4.12625 13.795 3.99497C13.9263 3.8637 14 3.68565 14 3.5C14 3.31435 13.9263 3.1363 13.795 3.00503C13.6637 2.87375 13.4857 2.8 13.3 2.8ZM6.3 1.4H7.7C8.13419 1.40053 8.55759 1.53536 8.91213 1.78601C9.26667 2.03666 9.53499 2.39084 9.6803 2.8H4.3197C4.46501 2.39084 4.73333 2.03666 5.08787 1.78601C5.44241 1.53536 5.86581 1.40053 6.3 1.4ZM11.2 13.3C11.2 13.857 10.9788 14.3911 10.5849 14.7849C10.1911 15.1788 9.65695 15.4 9.1 15.4H4.9C4.34305 15.4 3.8089 15.1788 3.41508 14.7849C3.02125 14.3911 2.8 13.857 2.8 13.3V4.2H11.2V13.3Z"
                                                fill="white" />
                                            <path
                                                d="M5.60002 12.6C5.78568 12.6 5.96372 12.5263 6.095 12.395C6.22627 12.2637 6.30002 12.0857 6.30002 11.9V7.7C6.30002 7.51435 6.22627 7.3363 6.095 7.20503C5.96372 7.07375 5.78568 7 5.60002 7C5.41437 7 5.23633 7.07375 5.10505 7.20503C4.97377 7.3363 4.90002 7.51435 4.90002 7.7V11.9C4.90002 12.0857 4.97377 12.2637 5.10505 12.395C5.23633 12.5263 5.41437 12.6 5.60002 12.6Z"
                                                fill="white" />
                                            <path
                                                d="M8.39998 12.6C8.58563 12.6 8.76368 12.5263 8.89496 12.395C9.02623 12.2637 9.09998 12.0857 9.09998 11.9V7.7C9.09998 7.51435 9.02623 7.3363 8.89496 7.20503C8.76368 7.07375 8.58563 7 8.39998 7C8.21433 7 8.03628 7.07375 7.90501 7.20503C7.77373 7.3363 7.69998 7.51435 7.69998 7.7V11.9C7.69998 12.0857 7.77373 12.2637 7.90501 12.395C8.03628 12.5263 8.21433 12.6 8.39998 12.6Z"
                                                fill="white" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                    {{-- @foreach ($data as $index) --}}
                    {{-- @endforeach --}}
                </tbody>

            </table>
        </div>

        {{-- bottom --}}
        <div
            class="flex flex-col lg:flex-row lg:justify-between lg:px-[3%] items-center w-full text-[11px] md:text-[15px] gap-3 md:gap-5 lg:gap-0 mt-5 lg:mt-3">
            {{ $pegawai->onEachSide(2)->links('vendor.pagination.CustomPagination') }}
        </div>

    </div>
@endsection



@section('otherjs')
    <script src="{{ asset('js/controllers/master_data_pegawai.js') }}"></script>
@endsection
