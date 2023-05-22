@extends('layout.main')

@section('title')
    Master Data Pegawai
@endsection

@section('modal')
    @include('modal.add_pegawai')
    @include('modal.edit_pegawai')
@endsection

@section('content')
    <div
        class="flex flex-row justify-between items-center w-full lg:h-[50px] h-[50px] bg-white border-b-[1px] border-b-[#DCDADA]">
        <form action="{{ route('cari') }}" method="get">
            @csrf
            <div class="flex px-4">
                <svg width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g filter="url(#filter0_d_18_33)">
                        <path
                            d="M15.1158 19.7369C19.9969 19.7369 23.9538 15.8253 23.9538 11C23.9538 6.1748 19.9969 2.26318 15.1158 2.26318C10.2347 2.26318 6.27783 6.1748 6.27783 11C6.27783 15.8253 10.2347 19.7369 15.1158 19.7369Z"
                            fill="white" stroke="black" stroke-width="3" />
                        <path d="M21.3374 17.7682L27.0022 24.1682" stroke="black" stroke-width="3" />
                    </g>
                    <defs>
                        <filter id="filter0_d_18_33" x="0.777832" y="0.763184" width="31.3475" height="32.3992"
                            filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                            <feColorMatrix in="SourceAlpha" type="matrix"
                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                            <feOffset dy="4" />
                            <feGaussianBlur stdDeviation="2" />
                            <feComposite in2="hardAlpha" operator="out" />
                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_18_33" />
                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_18_33" result="shape" />
                        </filter>
                    </defs>
                </svg>
                <input type="search" class="flex mx-2 " placeholder="masukan nama atau kode pegawai" name="search" value="{{ request('search') }}">
            </div>
        </form>


        <div class="flex justify-end">
            <div class="flex m-2" id="btn_hapus">
                <button class="flex bg-black text-white rounded ">hapus

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
            </div>

            <div class="flex m-2" id="btn_tambah">
                <button class="flex bg-yellow-300 text-black rounded ">tambah
                    <svg width="15" height="20" viewBox="0 0 15 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.497057 7.69702C0.497055 8.35976 1.03432 8.89702 1.69706 8.89702L6.49706 8.89702L6.49706 13.697C6.49706 14.3598 7.03432 14.897 7.69704 14.897C8.35977 14.897 8.89702 14.3597 8.89704 13.697L8.89706 8.89702L13.697 8.89701C14.3598 8.89696 14.8971 8.3597 14.8971 7.697C14.8971 7.0343 14.3598 6.49704 13.6971 6.49701L8.89705 6.49702L8.89707 1.69701C8.89705 1.03429 8.35979 0.497031 7.69707 0.49701C7.03435 0.496991 6.49709 1.03425 6.49706 1.69702L6.49706 6.49702L1.69705 6.49702C1.03431 6.49703 0.497059 7.03428 0.497057 7.69702Z"
                            fill="black" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div
        class="flex flex-row justify-between items-center w-full lg:h-[50px] h-[30px] bg-white border-b-[1px] border-b-[#DCDADA]">
        <div class="flex relative ">
            <p class="flex m-2">gender</p>
            <div class="relative">
                <!-- Dropdown button -->
                <button class="px-4 py-2 text-gray-400 bg-white rounded-md border- focus:outline-none" type="button"
                    onclick="toggleDropdown1()">
                    Gender
                </button>
                <!-- Dropdown menu -->
                <div id="genderDropdown1" class="absolute hidden right-0 py-2 mt-2 bg-white rounded-md shadow-lg">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Male</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Female</a>
                </div>
            </div>

            <p class="flex m-2">Role</p>
            <div class="relative">
                <!-- Dropdown button -->
                <button class="px-4 py-2 text-gray-400 bg-white rounded-md border- focus:outline-none" type="button"
                    onclick="toggleDropdown2()">
                    Role
                </button>
                <!-- Dropdown menu -->
                <div id="genderDropdown2" class="absolute hidden right-0 py-2 mt-2 bg-white rounded-md shadow-lg">
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">admin</a>
                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">pegawai</a>
                </div>
            </div>

            <a href="{{ route('halaman_utama') }}">
                <div class=" group relative m-3 ">
                    <svg width="17" height="17" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.96667 3.91655V1V0.7H5.66667H3.33333H3.03333V1V6.83333C3.03333 8.28585 4.21415 9.46667 5.66667 9.46667H11.5H11.8V9.16667V6.83333V6.53333H11.5H7.41874C9.48385 4.68707 12.1784 3.63333 15 3.63333C21.2673 3.63333 26.3667 8.73269 26.3667 15C26.3667 21.2673 21.2673 26.3667 15 26.3667C8.73269 26.3667 3.63333 21.2673 3.63333 15V14.7H3.33333H1H0.7V15C0.7 22.8855 7.11448 29.3 15 29.3C22.8855 29.3 29.3 22.8855 29.3 15C29.3 7.11448 22.8855 0.7 15 0.7C11.6744 0.7 8.49055 1.86249 5.96667 3.91655Z"
                            fill="#787777" stroke="#787777" stroke-width="0.6" />
                    </svg>
                    <div
                        class="opacity-0 group-hover:opacity-100 transition duration-500 absolute inset-0 flex justify-center items-center">
                        <p class="text-gray-400 text-lg font-bold absolute mb-4 ml-20">reset</p>
                    </div>
                </div>
            </a>

        </div>
    </div>

    {{-- table --}}
    <div class="w-full h-96 overflow-auto whitespace-nowrap text-ellipsis mt-3 md:mt-6 lg:mt-3">
        <table
            class="w-full text-[11px] md:text-[15px] border-separate border-spacing-y-2 md:border-spacing-4 lg:border-spacing-2 2xl:border-spacing-3">
            <thead>
                <tr class="w-full">
                    <td class="w-[5%] inline-block text-center text-[#787777]"></td>
                    <td class="w-[7%] inline-block text-center text-[#787777]">kode pegawai</td>
                    <td class="w-[35%] inline-block text-center text-[#787777]">nama pegawai</td>
                    <td class="w-[15%] inline-block text-center text-[#787777]">gender</td>
                    <td class="w-[25%] inline-block text-center text-[#787777]">account</td>
                    <td class="w-[10%] inline-block text-center text-[#787777]">Aksi</td>
                </tr>
            </thead>
            <tbody>
                <form id="form_delete" action="/pegawai/delete_selected" method="post">
                    @csrf
                    @foreach ($pegawai as $item)
                        <tr class="w-full  bg-white outline outline-[1px] outline-[#DCDADA] rounded-md ">
                            <td class="w-[5%] inline-block text-center text-[#787777]"><input type="checkbox"
                                    name="ids[]" class="form-checkbox idcheck" id=""
                                    value="{{ $item->kode_pegawai }}"></td>
                            <td
                                class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[8%] inline-block whitespace-nowrap text-ellipsis overflow-hidden">
                                {{ $item->kode_pegawai }}</td>
                            <td
                                class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[34%] inline-block overflow-hidden">
                                {{ $item->nama }}</td>
                            <td
                                class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[15%] inline-block overflow-hidden">
                                {{ $item->gender }}</td>
                            <td
                                class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[25%] inline-block overflow-hidden">
                                @if ($item->account !== null)
                                    {{ $item->account->username}}
                                @else
                                    -
                                @endif</td>

                            <td class="text-center w-[10%] inline-block overflow-hidden ">
                                <div class="flex flex-row justify-evenly">
                                    <button type="button" onclick="editData({{ $item }})" id="buttonEdit"
                                        class="flex bg-yellow-300 text-white rounded">
                                        <svg width="30" height="30" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.782019 12.7432C0.281449 13.2436 0.000151166 13.9224 0 14.6302L0 16H1.36987C2.07768 15.9999 2.75644 15.7186 3.25686 15.218L12.16 6.31486L9.68516 3.84003L0.782019 12.7432Z"
                                                fill="black" />
                                            <path
                                                d="M15.4823 0.517698C15.3183 0.353579 15.1237 0.223382 14.9094 0.134552C14.6951 0.045722 14.4654 0 14.2334 0C14.0014 0 13.7717 0.045722 13.5574 0.134552C13.3431 0.223382 13.1484 0.353579 12.9845 0.517698L10.624 2.87885L13.1211 5.376L15.4823 3.01552C15.6464 2.85157 15.7766 2.65689 15.8654 2.44259C15.9543 2.22829 16 1.99859 16 1.76661C16 1.53463 15.9543 1.30493 15.8654 1.09063C15.7766 0.876334 15.6464 0.681646 15.4823 0.517698Z"
                                                fill="black" />
                                        </svg>
                                    </button>

                                    <button type="button"
                                        onclick="hapusData('/pegawai/delete/{{ $item->kode_pegawai }}')"
                                        class="flex bg-black text-white rounded">

                                        <svg width="30" height="30" viewBox="0 0 14 17" fill="none"
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    @endsection



    @section('otherjs')
        <script src="{{ asset('js/controllers/master_data_pegawai.js') }}"></script>
    @endsection
