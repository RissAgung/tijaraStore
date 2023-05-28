@extends('layout.main')

@section('title_page')
    RTR Supplier
@endsection

@section('modal')
    @include('modal.add_retur')
@endsection

@section('title')
    Retur Supplier
@endsection

@section('content')
    {{-- content --}}
    <div class="flex flex-col w-full">

        {{-- top --}}
        <div
            class="flex flex-col md:flex-row w-full items-center justify-center md:h-16 bg-white text-[11px] md:text-[15px] border-b-[1px] border-b-[#DCDADA]">

            {{-- left --}}
            <div
                class="flex items-center justify-between gap-2 md:gap-4 w-full md:w-[30%] px-3 min-[374px]:px-5 md:px-7 h-11 min-[360px]:h-14 md:h-full lg:px-7 max-md:border-b-[1px] max-md:border-b-[#DCDADA]">

                {{-- menu --}}
                {{-- <div id="menuLaporan" class="md:hidden poppins-medium cursor-pointer flex h-full items-center gap-2">
                    <p class="text-selector-none">Pemasukan</p>
                    <div id="arrowMenu" class="transition ease-in-out delay-75">
                        <svg class="w-[11px] h-[5px]" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 8C6.83259 8 6.67061 7.96946 6.51408 7.9084C6.35671 7.84733 6.22571 7.7659 6.12108 7.66412L0.345291 2.0458C0.115097 1.82188 0 1.53689 0 1.19084C0 0.844783 0.115097 0.559796 0.345291 0.335877C0.575485 0.111959 0.86846 0 1.22421 0C1.57997 0 1.87294 0.111959 2.10314 0.335877L7 5.09924L11.8969 0.335877C12.1271 0.111959 12.42 0 12.7758 0C13.1315 0 13.4245 0.111959 13.6547 0.335877C13.8849 0.559796 14 0.844783 14 1.19084C14 1.53689 13.8849 1.82188 13.6547 2.0458L7.87892 7.66412C7.75336 7.78626 7.61734 7.87257 7.47085 7.92305C7.32436 7.97435 7.16741 8 7 8Z"
                                fill="black" />
                        </svg>
                    </div>
                </div> --}}

                {{-- dropdown --}}
                <div
                    class="text-selector-none flex flex-row md:items-end gap-2 min-[360px]:gap-3 md:gap-5 poppins-medium text-[#2c2c2c] py-2 md:p-0 w-full rounded-sm min-[360px]:rounded-[5px] top-8 min-[360px]:top-10 h-full">
                    <a id="menu_pemasukan1" href="{{ route('retur') }}"
                        class="text-[#ff9215] relative transition ease-in-out flex items-center h-full">
                        <p>Retur</p>
                        <div class="absolute bottom-0 w-full h-1 md:h-[6px] bg-[#FFB015]">
                        </div>
                    </a>
                    <a id="menu_pemasukan2" href="{{ route('riwayatRetur') }}"
                        class="hover:text-[#ff9215] relative transition ease-in-out flex items-center h-full">
                        <p>Riwayat Retur</p>
                        <div class="absolute bottom-0 w-full h-1 md:h-[6px] transition ease-in-out">
                        </div>
                    </a>
                </div>

            </div>

            {{-- right --}}
            <div
                class="flex h-11 min-[360px]:h-14 md:h-full justify-between md:justify-end px-3 min-[374px]:p-5 items-center md:gap-6 w-full md:w-[70%]">

                {{-- search --}}
                <div class="flex items-center md:w-1/2 h-full gap-2 w-[50%]">
                    <svg class="w-[15px] h-[16px] md:w-[20px] md:h-[21px]" viewBox="0 0 25 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.1158 19.7364C15.9969 19.7364 19.9538 15.8248 19.9538 10.9995C19.9538 6.17431 15.9969 2.2627 11.1158 2.2627C6.23472 2.2627 2.27783 6.17431 2.27783 10.9995C2.27783 15.8248 6.23472 19.7364 11.1158 19.7364Z"
                            fill="white" stroke="black" stroke-width="3" />
                        <path d="M17.3374 17.7676L23.0022 24.1676" stroke="black" stroke-width="3" />
                    </svg>
                    <input type="search" id="field_search" name="search"
                        class="placeholder:text-[11px] md:placeholder:text-[15px] outline-none w-[80%]"
                        placeholder="Kode / Nama Produk" value="{{ $dataUrl['search'] }}">
                </div>

                {{-- filter --}}
                <div class="flex h-full items-center gap-2">
                    <div class="flex gap-2">
                        <p class="poppins-medium py-1 bg-white">Kategori</p>
                        <form action="/retur/{{ $dataUrl['search'] }}" id="filter_kategori" method="GET">
                            <select name="filter" id="filter_gender"
                                class="appearance-none py-[1px] px-2 bg-white border-[1px] border-[#A7A5A5] outline-none rounded-sm">
                                <option disabled selected value>All</option>
                                <option class="md:text-[15px]" {{ $dataUrl['kategori'] === 'pria' ? 'selected' : '' }}
                                    value="pria">Pria</option>
                                <option class="md:text-[15px]" {{ $dataUrl['kategori'] === 'wanita' ? 'selected' : '' }}
                                    value="wanita">Wanita</option>
                                <option class="md:text-[15px]" {{ $dataUrl['kategori'] === 'anak' ? 'selected' : '' }}
                                    value="anak">Anak</option>
                            </select>
                        </form>
                    </div>

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
            @if (count($finalProduct->items()) != 0)
                {{-- table --}}
                <div class="w-full overflow-auto whitespace-nowrap text-ellipsis mt-3 md:mt-6 lg:mt-3">
                    <table
                        class="w-full text-[11px] md:text-[15px] border-separate border-spacing-y-2 md:border-spacing-4 lg:border-spacing-2 2xl:border-spacing-3">

                        <tr class="w-full">
                            <td class="w-[35%] inline-block text-center text-[#787777]">Nama Produk</td>
                            <td class="w-[20%] inline-block text-center text-[#787777]">Kategori</td>
                            <td class="w-[10%] inline-block text-center text-[#787777]">Stock</td>
                            <td class="w-[25%] inline-block text-center text-[#787777]">Harga</td>
                            <td class="w-[10%] inline-block text-center text-[#787777]">Aksi</td>
                        </tr>

                        @foreach ($finalProduct as $product)
                            <tr class="w-full bg-white outline outline-[1px] outline-[#DCDADA] rounded-md">
                                <td
                                    class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[35%] inline-block whitespace-nowrap text-ellipsis overflow-hidden">
                                    {{ $product->nama_br }}</td>
                                <td
                                    class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[20%] inline-block overflow-hidden">
                                    {{ $product->kategori }}</td>
                                <td
                                    class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[10%] inline-block overflow-hidden">
                                    {{ $product->stok }}</td>
                                <td
                                    class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[25%] inline-block overflow-hidden">
                                    {{ $product->harga }}</td>
                                <td class="text-center w-[10%] inline-block overflow-hidden">
                                    <svg onclick="showModal('{{ $product->nama_br }}')"
                                        class="cursor-pointer w-[30px] h-[30px] md:w-[50px] md:h-[50px] lg:w-[40px] lg:h-[40px] m-auto"
                                        viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g class="fill-black hover:fill-[#3a3a3a] transition ease-in-out"
                                            filter="url(#filter0_d_294_238)">
                                            <rect x="2" y="4" width="46" height="46"
                                                rx="6" />
                                        </g>
                                        <path
                                            d="M34.2084 35C33.9984 35 33.7971 34.9181 33.6486 34.7724C33.5002 34.6266 33.4168 34.4289 33.4168 34.2228C33.4155 32.9863 32.9147 31.8009 32.0242 30.9266C31.1337 30.0523 29.9263 29.5605 28.667 29.5593H24.0519V30.792C24.0518 31.0994 23.9589 31.3999 23.7849 31.6555C23.611 31.911 23.3637 32.1102 23.0745 32.2278C22.7852 32.3455 22.4669 32.3763 22.1598 32.3163C21.8528 32.2564 21.5707 32.1084 21.3493 31.891L16.6953 27.3216C16.2501 26.8844 16 26.2914 16 25.6731C16 25.0548 16.2501 24.4618 16.6953 24.0245L21.3493 19.4551C21.5707 19.2378 21.8528 19.0898 22.1598 19.0299C22.4669 18.9699 22.7852 19.0007 23.0745 19.1183C23.3637 19.2359 23.611 19.4351 23.7849 19.6907C23.9589 19.9463 24.0518 20.2468 24.0519 20.5542V21.7869H27.8754C29.7643 21.7889 31.5753 22.5266 32.9109 23.838C34.2466 25.1494 34.9979 26.9274 35 28.7821V34.2228C35 34.4289 34.9166 34.6266 34.7681 34.7724C34.6197 34.9181 34.4183 35 34.2084 35ZM22.4686 20.5542L17.8147 25.1236C17.6663 25.2693 17.5829 25.467 17.5829 25.6731C17.5829 25.8792 17.6663 26.0768 17.8147 26.2226L22.4686 30.792V28.7821C22.4686 28.5759 22.552 28.3782 22.7005 28.2325C22.8489 28.0867 23.0503 28.0048 23.2602 28.0048H28.667C29.566 28.0045 30.4547 28.1926 31.2737 28.5563C32.0928 28.9201 32.8234 29.4512 33.4168 30.1143V28.7821C33.4151 27.3396 32.8307 25.9567 31.7919 24.9367C30.753 23.9167 29.3445 23.343 27.8754 23.3414H23.2602C23.0503 23.3414 22.8489 23.2595 22.7005 23.1137C22.552 22.9679 22.4686 22.7702 22.4686 22.5641V20.5542Z"
                                            fill="white" />
                                        <defs>
                                            <filter id="filter0_d_294_238" x="0" y="0" width="54"
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
                                                    result="effect1_dropShadow_294_238" />
                                                <feBlend mode="normal" in="SourceGraphic"
                                                    in2="effect1_dropShadow_294_238" result="shape" />
                                            </filter>
                                        </defs>
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>

                {{-- bottom --}}
                <div
                    class="flex flex-col lg:flex-row lg:justify-between lg:px-[3%] items-center w-full text-[11px] md:text-[15px] gap-3 md:gap-5 lg:gap-0 mt-5 lg:mt-3">
                    {{ $finalProduct->onEachSide(2)->links('vendor.pagination.CustomPagination') }}
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

    </div>
@endsection

@section('otherjs')
    {{-- <script src='js/controllers/retur.js'></script> --}}
    <script src="{{ asset('js/controllers/retur.js') }}"></script>
    @if ($errors->any())
        <script>
            showModal("{{ old('nama_produk') }}")
        </script>
    @endif
@endsection
