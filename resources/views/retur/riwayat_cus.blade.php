@extends('layout.main')

@section('title')
    Riwayat Retur Custommer
@endsection

@section('modal')
    @include('modal.riwayat_retur')
    @include('modal.filterDate.filter')
@endsection

@section('content')
    {{-- content --}}
    <div class="flex flex-col w-full">

        {{-- top --}}
        <div
            class="flex flex-col md:flex-row w-full items-center justify-center md:h-16 bg-white border-b-[1px] border-b-[#DCDADA] text-[11px] md:text-[15px]">

            {{-- left --}}
            <div
                class="flex items-center justify-between gap-2 md:gap-4 w-full px-3 min-[374px]:px-5 md:px-7 h-11 min-[360px]:h-14 md:h-full lg:px-7">
                {{-- search --}}
                <div class="flex items-center md:w-1/2 h-full gap-2">
                    <svg class="w-[15px] h-[16px] md:w-[20px] md:h-[21px]" viewBox="0 0 25 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1158 19.7364C15.9969 19.7364 19.9538 15.8248 19.9538 10.9995C19.9538 6.17431 15.9969 2.2627 11.1158 2.2627C6.23472 2.2627 2.27783 6.17431 2.27783 10.9995C2.27783 15.8248 6.23472 19.7364 11.1158 19.7364Z"
                            fill="white" stroke="black" stroke-width="3" />
                        <path d="M17.3374 17.7676L23.0022 24.1676" stroke="black" stroke-width="3" />
                    </svg>
                    <form action="" method="GET" id="form_search">
                        <input type="search" id="field_search" name="search"
                            class="placeholder:text-[11px] md:placeholder:text-[15px] outline-none w-full"
                            placeholder="Kode / Nama Barang" value="">
                    </form>
                </div>

                {{-- filter --}}
                <div class="flex h-full items-center gap-2">

                    {{-- btn filter --}}
                    <svg onclick="showModalFilter()" class="cursor-pointer h-[33px] md:h-[43px] mt-[1px]"
                        viewBox="0 0 145 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_668_2)">
                            <rect x="2" y="2"
                                class="fill-[#FFB015] hover:fill-[#f1a100] transition ease-in-out" width="133"
                                height="46" rx="6" />
                        </g>
                        <path
                            d="M94.6933 21.8097L94.6935 21.8098L100.396 27.9414V32.2791C100.396 32.425 100.431 32.5686 100.499 32.6985C100.567 32.8283 100.665 32.9406 100.786 33.0268L104.059 35.3738C104.227 35.4939 104.43 35.5583 104.638 35.5583C104.892 35.5583 105.138 35.4617 105.32 35.2876C105.502 35.1134 105.606 34.8755 105.606 34.626V27.9414L111.306 21.8106L111.306 21.8105C111.734 21.3496 112.014 20.7797 112.111 20.1689C112.209 19.5581 112.12 18.9335 111.856 18.3704C111.591 17.8074 111.163 17.3303 110.623 16.9959C110.083 16.6615 109.454 16.4835 108.812 16.4828H108.812L97.1899 16.4828L97.1898 16.4828C96.5476 16.4832 95.9186 16.6608 95.3785 16.995C94.8383 17.3293 94.4096 17.8061 94.1449 18.3691C93.8801 18.9321 93.7909 19.5568 93.8884 20.1677C93.9859 20.7785 94.2658 21.3486 94.6933 21.8097ZM103.669 27.5851V27.5852V32.7693L102.332 31.8109V27.5852C102.332 27.5852 102.332 27.5852 102.332 27.5852C102.332 27.355 102.244 27.134 102.086 26.9637L102.086 26.9636L96.1371 20.5662C96.137 20.5661 96.137 20.5661 96.1369 20.566C95.9586 20.3731 95.843 20.1358 95.8029 19.8831C95.7629 19.6302 95.7998 19.3716 95.9099 19.1378C96.02 18.9039 96.1988 18.7044 96.4259 18.5638C96.653 18.4232 96.9183 18.3478 97.1901 18.3474C97.1901 18.3474 97.1901 18.3474 97.1901 18.3474L108.812 18.3474C109.084 18.3477 109.349 18.423 109.576 18.5637C109.804 18.7043 109.983 18.904 110.093 19.1379L110.228 19.0741L110.093 19.1379C110.203 19.3718 110.24 19.6307 110.199 19.8836C110.159 20.1365 110.043 20.3737 109.865 20.5667C109.865 20.5667 109.865 20.5668 109.865 20.5669L103.917 26.9635C103.917 26.9635 103.917 26.9636 103.917 26.9636C103.758 27.1338 103.67 27.3548 103.669 27.5851Z"
                            fill="black" stroke="black" stroke-width="0.3" />
                        <path
                            d="M34.68 19.1V20.96H28.78V25.06H33.38V26.92H28.78V33H26.5V19.1H34.68ZM37.953 20.52C37.5396 20.52 37.193 20.38 36.913 20.1C36.633 19.82 36.493 19.4733 36.493 19.06C36.493 18.6467 36.633 18.3 36.913 18.02C37.193 17.74 37.5396 17.6 37.953 17.6C38.353 17.6 38.693 17.74 38.973 18.02C39.253 18.3 39.393 18.6467 39.393 19.06C39.393 19.4733 39.253 19.82 38.973 20.1C38.693 20.38 38.353 20.52 37.953 20.52ZM39.073 21.98V33H36.793V21.98H39.073ZM44.3464 18.2V33H42.0664V18.2H44.3464ZM49.9998 23.84V29.94C49.9998 30.3533 50.0932 30.6533 50.2798 30.84C50.4798 31.0133 50.8132 31.1 51.2798 31.1H52.6798V33H50.8798C49.8532 33 49.0665 32.76 48.5198 32.28C47.9732 31.8 47.6998 31.02 47.6998 29.94V23.84H46.3998V21.98H47.6998V19.24H49.9998V21.98H52.6798V23.84H49.9998ZM64.8813 27.22C64.8813 27.6333 64.8546 28.0067 64.8013 28.34H56.3813C56.4479 29.22 56.7746 29.9267 57.3613 30.46C57.9479 30.9933 58.6679 31.26 59.5213 31.26C60.7479 31.26 61.6146 30.7467 62.1213 29.72H64.5812C64.2479 30.7333 63.6413 31.5667 62.7613 32.22C61.8946 32.86 60.8146 33.18 59.5213 33.18C58.4679 33.18 57.5213 32.9467 56.6813 32.48C55.8546 32 55.2013 31.3333 54.7213 30.48C54.2546 29.6133 54.0213 28.6133 54.0213 27.48C54.0213 26.3467 54.2479 25.3533 54.7013 24.5C55.1679 23.6333 55.8146 22.9667 56.6413 22.5C57.4813 22.0333 58.4413 21.8 59.5213 21.8C60.5613 21.8 61.4879 22.0267 62.3013 22.48C63.1146 22.9333 63.7479 23.5733 64.2013 24.4C64.6546 25.2133 64.8813 26.1533 64.8813 27.22ZM62.5013 26.5C62.4879 25.66 62.1879 24.9867 61.6013 24.48C61.0146 23.9733 60.2879 23.72 59.4213 23.72C58.6346 23.72 57.9613 23.9733 57.4013 24.48C56.8413 24.9733 56.5079 25.6467 56.4013 26.5H62.5013ZM69.405 23.58C69.7383 23.02 70.1783 22.5867 70.725 22.28C71.285 21.96 71.945 21.8 72.705 21.8V24.16H72.125C71.2317 24.16 70.5517 24.3867 70.085 24.84C69.6317 25.2933 69.405 26.08 69.405 27.2V33H67.125V21.98H69.405V23.58Z"
                            fill="black" />
                        <defs>
                            <filter id="filter0_d_668_2" x="0" y="0" filterUnits="userSpaceOnUse"
                                color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dx="4" dy="4" />
                                <feGaussianBlur stdDeviation="3" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.478431 0 0 0 0 0.470588 0 0 0 0 0.470588 0 0 0 0.25 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_668_2" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_668_2" result="shape" />
                            </filter>
                        </defs>
                    </svg>

                    {{-- reset --}}
                    <svg onclick="resetFilter()" class="cursor-pointer w-[15px] h-[15px] md:w-[20px] md:h-[20px]"
                        viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.96667 3.76616V0.849609V0.549609H5.66667H3.33333H3.03333V0.849609V6.68294C3.03333 8.13546 4.21415 9.31628 5.66667 9.31628H11.5H11.8V9.01628V6.68294V6.38294H11.5H7.41874C9.48385 4.53668 12.1784 3.48294 15 3.48294C21.2673 3.48294 26.3667 8.58229 26.3667 14.8496C26.3667 21.1169 21.2673 26.2163 15 26.2163C8.73269 26.2163 3.63333 21.1169 3.63333 14.8496V14.5496H3.33333H1H0.7V14.8496C0.7 22.7351 7.11448 29.1496 15 29.1496C22.8855 29.1496 29.3 22.7351 29.3 14.8496C29.3 6.96409 22.8855 0.549609 15 0.549609C11.6744 0.549609 8.49055 1.7121 5.96667 3.76616Z"
                            fill="#787777" stroke="#787777" stroke-width="0.6" />
                    </svg>
                </div>
            </div>

        </div>

        {{-- content --}}
        <div class="flex flex-col w-full lg:justify-between p-2 lg:h-[73vh] 2xl:h-[79vh]">
            {{-- table --}}
            <div class="w-full overflow-auto whitespace-nowrap text-ellipsis mt-3 md:mt-6 lg:mt-3">
                <table class=" w-full border-separate border-spacing-y-4 text-[11px] md:text-[15px] px-2">
                    <thead>
                        <tr>
                            <th class="text-center text-[#787777]">Kode Retur</th>
                            <th class="text-center text-[#787777]">Tanggal</th>
                            <th class="text-center text-[#787777]">Barang</th>
                            <th class="text-center text-[#787777]">Jumlah</th>
                            <th class="text-center text-[#787777]">Jenis pengembalian</th>
                            <th class="text-center text-[#787777]">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-2 outline outline-[1px] outline-[#DCDADA] rounded-md">
                            <td class="text-center p-3">Lorem ipsum dolor sit amet</td>
                            <td class="text-center p-3">Lorem ipsum dolor sit amet.</td>
                            <td class="text-center p-3">Lorem, ipsum dolor.</td>
                            <td class="text-center p-3">Lorem ipsum dolor sit amet</td>
                            <td class="text-center p-3">Lorem, ipsum.</td>
                            <td class="text-center p-3">
                                <svg onclick=""
                                    class="cursor-pointer w-[30px] h-[30px] md:w-[50px] md:h-[50px] lg:w-[40px] lg:h-[40px] m-auto"
                                    viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_653_130)">
                                        <rect x="2" y="4" width="46" height="46" rx="6"
                                            fill="#FFB015" />
                                    </g>
                                    <path
                                        d="M28.875 24.75C25.4975 24.75 22.75 27.4975 22.75 30.875C22.75 34.2525 25.4975 37 28.875 37C32.2525 37 35 34.2525 35 30.875C35 27.4975 32.2525 24.75 28.875 24.75ZM28.875 35.25C26.46 35.25 24.5 33.29 24.5 30.875C24.5 28.46 26.46 26.5 28.875 26.5C31.29 26.5 33.25 28.46 33.25 30.875C33.25 33.29 31.29 35.25 28.875 35.25ZM30.1875 28.6875C30.1875 29.4137 29.6012 30 28.875 30C28.1488 30 27.5625 29.4137 27.5625 28.6875C27.5625 27.9613 28.1488 27.375 28.875 27.375C29.6012 27.375 30.1875 27.9613 30.1875 28.6875ZM29.75 31.75V33.5C29.75 33.9813 29.3562 34.375 28.875 34.375C28.3938 34.375 28 33.9813 28 33.5V31.75C28 31.2688 28.3938 30.875 28.875 30.875C29.3562 30.875 29.75 31.2688 29.75 31.75ZM21.875 34.375C21.875 34.8563 21.4812 35.25 21 35.25H18.375C15.96 35.25 14 33.29 14 30.875V20.375C14 17.96 15.96 16 18.375 16H23.415C24.3337 16 25.235 16.3762 25.8913 17.0237L28.7262 19.8587C29.3125 20.445 29.6712 21.2237 29.7413 22.0462C29.7762 22.5275 29.4175 22.9475 28.9362 22.9913C28.91 22.9913 28.8925 22.9913 28.8663 22.9913C28.4113 22.9913 28.035 22.6413 27.9913 22.1863C27.9913 22.16 27.9913 22.1425 27.9913 22.1163H25.3837C24.4213 22.1163 23.6337 21.3287 23.6337 20.3663V17.7675C23.5638 17.7675 23.4938 17.75 23.4237 17.75H18.375C16.9313 17.75 15.75 18.9313 15.75 20.375V30.875C15.75 32.3188 16.9313 33.5 18.375 33.5H21C21.4812 33.5 21.875 33.8937 21.875 34.375Z"
                                        fill="black" />
                                    <defs>
                                        <filter id="filter0_d_653_130" x="0" y="0" width="54"
                                            height="54" filterUnits="userSpaceOnUse"
                                            color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                            <feOffset dx="2" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feComposite in2="hardAlpha" operator="out" />
                                            <feColorMatrix type="matrix"
                                                values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.22 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix"
                                                result="effect1_dropShadow_653_130" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_653_130"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </td>
                        </tr>


                    </tbody>

                </table>
            </div>

            {{-- bottom --}}

        </div>

    </div>
@endsection

@section('otherjs')
    <script src="{{ asset('js/controllers/riwayat_retur.js') }}"></script>
    @include('modal.filterDate.controller')
    {{-- @if ($errors->any())
        <script>
            showModal("{{ old('nama_produk') }}")
        </script>
    @endif --}}
@endsection
