{{-- bg hitam --}}
<div class="w-screen h-screen bg-black fixed z-[98] opacity-50 hidden transition ease-in delay-300" id="bg-sidebar"></div>

{{-- sidebar --}}
<div class="main-sidebar flex flex-col w-[80%] md:w-[390px] lg:w-[290px] h-full bg-white border-r-[1px] border-r-[#DCDADA] box-border fixed z-[99] pb-10 2xl:pb-10 overflow-y-auto md:scrollbar-hide"
    id="sidebar">

    {{-- top side --}}
    <div class="flex flex-col w-full h-auto py-6 px-8">

        {{-- logo --}}
        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo tijara" class="w-[120px] md:w-[206px] lg:w-[136px]">

        <div
            class="flex flex-row 2xl:flex-col justify-between items-center 2xl:items-start w-full mt-7 -ml-1 md:mt-[45px] lg:mt-7 gap-3">

            {{-- avatar --}}
            <div class="rounded-full overflow-hidden">
                <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="object-cover">
            </div>

            <div class="flex flex-col justify-center gap-1 w-[65%] 2xl:w-full h-full 2xl:h-auto">
                {{-- name --}}
                <h3
                    class="poppins-medium text-[15px] md:text-[18px] lg:text-[16px] w-[90%] 2xl:w-full whitespace-nowrap text-ellipsis overflow-hidden">
                    Bintang Kabel Prekes</h3>

                {{-- username --}}
                <p class="poppins-medium text-[12px] md:text-[14px] lg:text-[13px] text-[#535353]">mphstar</p>
            </div>
        </div>

        {{-- line --}}
        <div class="w-full h-[1px] bg-[#CACACA] mt-[30px] lg:mt-[25px] 2xl:mb-3"></div>

    </div>
    {{-- end top side --}}

    {{-- bot side --}}
    <div class="flex flex-col gap-2 pl-8 lg:mt-0  h-full">

        {{-- master data --}}
        <div id="div_master" class="h-12 flex flex-col w-full overflow-hidden duration-300 ease-in-out">
            <div id="master_data" class="flex flex-row w-full justify-between h-[48px] cursor-pointer menu flex-none">

                {{-- icon & title --}}
                <div class="flex flex-row @if (Request::segment(1) == 'product') menu-active1 @else menu-hover1 @endif items-center  w-full">
                    <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out"
                        viewBox="0 0 32 30" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.0333 2.59091C16.2193 2.68203 16.4231 2.72866 16.6293 2.72727H25.3333C27.1008 2.72944 28.7953 3.44848 30.045 4.72666C31.2948 6.00485 31.9979 7.73783 32 9.54545V23.1818C31.9979 24.9894 31.2948 26.7224 30.045 28.0006C28.7953 29.2788 27.1008 29.9978 25.3333 30H6.66667C4.89921 29.9978 3.20474 29.2788 1.95496 28.0006C0.705176 26.7224 0.00211714 24.9894 0 23.1818V6.81818C0.00211714 5.01055 0.705176 3.27758 1.95496 1.99939C3.20474 0.721203 4.89921 0.00216526 6.66667 0H10.0373C10.6579 0.000526829 11.2699 0.148016 11.8253 0.430909L16.0333 2.59091ZM10.6333 2.86364C10.4474 2.77251 10.2435 2.72588 10.0373 2.72727H6.66667C5.6058 2.72727 4.58839 3.15828 3.83824 3.92547C3.08809 4.69267 2.66667 5.73321 2.66667 6.81818V8.17364L29.0387 8.02091C28.7415 7.26415 28.23 6.61548 27.5697 6.1582C26.9095 5.70091 26.1307 5.45588 25.3333 5.45455H16.6293C16.0083 5.4519 15.3963 5.30207 14.8413 5.01682L10.6333 2.86364ZM3.83824 26.0745C4.58839 26.8417 5.6058 27.2727 6.66667 27.2727H25.3333C26.3942 27.2727 27.4116 26.8417 28.1618 26.0745C28.9119 25.3073 29.3333 24.2668 29.3333 23.1818V10.7468L2.66667 10.9009V23.1818C2.66667 24.2668 3.08809 25.3073 3.83824 26.0745Z" />
                    </svg>
                    <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                        Master
                        Data</p>
                </div>

                {{-- when focus --}}
                <div class="w-2 h-full @if(Request::segment(1) == 'product') menu-active2 @endif transition ease-in-out"></div>
            </div>
            <div class="flex flex-row w-full">
                <div class="px-3">
                    <div class="bg-primary w-[2px] h-full"></div>
                </div>
                <div class="flex w-full flex-col flex-grow px-2 pr-6 poppins-regular cursor-default">
                    <a href="{{ route('product') }}">
                        <div
                            class=" @if (Request::segment(1) == 'product') bg-[#FFF6E3] text-primary @else hover:bg-gray-200 @endif text-sm py-2 px-2 rounded-md w-full">
                            <p>Produk</p>
                        </div>
                    </a>
                    <div class="text-black text-sm py-2 px-2 rounded-md w-full hover:bg-gray-200">
                        <p>Pegawai</p>
                    </div>
                    <div class="text-black text-sm py-2 px-2 rounded-md w-full hover:bg-gray-200">
                        <p>Supplier</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end master data --}}

        {{-- riwayat --}}
        <a href="/riwayat" class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

            {{-- icon & title --}}
            <div
                class="flex flex-row menu-hover1 @if (Route::is('riwayatTr')) menu-active1 @endif items-center w-full">

                <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out"
                    width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 0.85L16.9999 0.85C13.1349 0.852756 9.40355 2.24456 6.48333 4.76519V2.33333C6.48333 1.93993 6.32705 1.56264 6.04887 1.28446C5.7707 1.00628 5.3934 0.85 5 0.85C4.6066 0.85 4.2293 1.00628 3.95112 1.28446C3.67295 1.56264 3.51667 1.93993 3.51667 2.33333V6.33333C3.51667 7.43398 3.9539 8.48955 4.73217 9.26783C5.51045 10.0461 6.56602 10.4833 7.66667 10.4833H11.6667C12.0601 10.4833 12.4374 10.3271 12.7155 10.0489C12.9937 9.77069 13.15 9.3934 13.15 9C13.15 8.60659 12.9937 8.2293 12.7155 7.95112C12.4374 7.67295 12.0601 7.51667 11.6667 7.51667H7.87149C9.98967 5.48603 12.7284 4.21889 15.6539 3.92212C18.6872 3.61441 21.7334 4.36902 24.2723 6.05712C26.8113 7.74523 28.6856 10.2622 29.5754 13.1784C30.4653 16.0946 30.3154 19.2292 29.1515 22.0472C27.9875 24.8652 25.8816 27.1919 23.1932 28.6301C20.5048 30.0683 17.4006 30.5288 14.4104 29.9332C11.4202 29.3375 8.72948 27.7225 6.79745 25.3639C4.86542 23.0052 3.81188 20.0492 3.81667 17.0002V17C3.81667 16.6066 3.66039 16.2293 3.38221 15.9511C3.10403 15.6729 2.72674 15.5167 2.33333 15.5167C1.93993 15.5167 1.56264 15.6729 1.28446 15.9511C1.00628 16.2293 0.85 16.6066 0.85 17C0.85 20.1942 1.79718 23.3166 3.57177 25.9725C5.34635 28.6283 7.86864 30.6983 10.8197 31.9206C13.7707 33.143 17.0179 33.4628 20.1507 32.8397C23.2835 32.2165 26.1612 30.6784 28.4198 28.4198C30.6784 26.1612 32.2165 23.2835 32.8397 20.1507C33.4628 17.0179 33.143 13.7707 31.9206 10.8197C30.6983 7.86864 28.6283 5.34635 25.9725 3.57177C23.3166 1.79718 20.1942 0.85 17 0.85Z"
                        stroke-width="0.3" />
                    <path
                        d="M15.5166 17V17C15.5167 17.3934 15.673 17.7706 15.9512 18.0487L19.9512 22.0487L19.9512 22.0487L19.9531 22.0506C20.2328 22.3208 20.6075 22.4703 20.9965 22.4669C21.3854 22.4635 21.7574 22.3075 22.0324 22.0325C22.3075 21.7575 22.4635 21.3854 22.4669 20.9965C22.4702 20.6076 22.3207 20.2329 22.0505 19.9531L22.0505 19.9531L22.0487 19.9513L18.4833 16.3859V10.3333C18.4833 9.93993 18.327 9.56264 18.0488 9.28446C17.7707 9.00628 17.3934 8.85 17 8.85C16.6066 8.85 16.2293 9.00628 15.9511 9.28446C15.6729 9.56264 15.5166 9.93993 15.5166 10.3333V17Z" " stroke-width="0.3" />
                </svg>

                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Riwayat
                    Transaksi</p>
            </div>

            {{-- when focus --}}
            <div class="w-2 h-full  @if (Route::is('riwayatTr')) menu-active2 @endif transition ease-in-out"></div>
        </a>
        {{-- end riwayat --}}

        {{-- retur --}}
        <a href="{{ Route('retur') }}" class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

        {{-- icon & title --}}
            <div class="flex flex-row menu-hover1 @if (Route::is('retur') or Route::is('riwayatRetur')) menu-active1 @endif items-center w-full">
            
                <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out" viewBox="0 0 38 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M36.4168 32C35.9969 32 35.5941 31.8362 35.2972 31.5447C35.0003 31.2532 34.8335 30.8578 34.8335 30.4455C34.831 27.9726 33.8294 25.6017 32.0484 23.8531C30.2675 22.1045 27.8527 21.1211 25.3341 21.1186H16.1037V23.584C16.1036 24.1988 15.9178 24.7998 15.5699 25.3109C15.2219 25.8221 14.7274 26.2204 14.1489 26.4557C13.5704 26.691 12.9338 26.7525 12.3197 26.6326C11.7055 26.5127 11.1414 26.2167 10.6985 25.7821L1.39066 16.6432C0.50022 15.7687 0 14.5827 0 13.3462C0 12.1096 0.50022 10.9236 1.39066 10.0491L10.6985 0.910267C11.1414 0.475603 11.7055 0.179609 12.3197 0.0597032C12.9338 -0.0602023 13.5704 0.00136441 14.1489 0.236621C14.7274 0.471877 15.2219 0.870259 15.5699 1.38141C15.9178 1.89255 16.1036 2.49351 16.1037 3.10831V5.57373H23.7508C27.5286 5.57784 31.1505 7.05315 33.8219 9.67596C36.4932 12.2988 37.9958 15.8549 38 19.5641V30.4455C38 30.8578 37.8332 31.2532 37.5363 31.5447C37.2394 31.8362 36.8367 32 36.4168 32ZM12.9373 3.10831L3.62936 12.2471C3.33255 12.5386 3.16581 12.934 3.16581 13.3462C3.16581 13.7584 3.33255 14.1537 3.62936 14.4452L12.9373 23.584V19.5641C12.9373 19.1518 13.1041 18.7564 13.401 18.4649C13.6979 18.1734 14.1006 18.0096 14.5205 18.0096H25.3341C27.132 18.0091 28.9093 18.3851 30.5474 19.1127C32.1856 19.8402 33.6468 20.9024 34.8335 22.2285V19.5641C34.8302 16.6792 33.6614 13.9134 31.5838 11.8734C29.5061 9.83348 26.6891 8.68599 23.7508 8.6827H14.5205C14.1006 8.6827 13.6979 8.51892 13.401 8.2274C13.1041 7.93588 12.9373 7.54049 12.9373 7.12821V3.10831Z"/>
                </svg>

                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                Retur Supplier</p>
            </div>

        {{-- when focus --}}
            <div class="w-2 h-full  @if (Route::is('retur') or Route::is('riwayatRetur')) menu-active2 @endif transition ease-in-out"></div>
        </a>
        {{-- end retur --}}

        {{-- laporan --}}
        <a href="{{ Route('pemasukan') }}" class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

          {{-- icon & title --}}
          <div class="flex flex-row  @if (Route::is('pemasukan') or Route::is('pengeluaran') or Route::is('akumulasi')) menu-active1 @else menu-hover1 @endif items-center w-full">
              <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.21966 22.3363L8.21964 22.3363L8.22302 22.3397C8.65479 22.7691 9.2227 22.9833 9.7854 22.9833C10.3472 22.9833 10.91 22.7713 11.3387 22.3456C11.3392 22.3452 11.3396 22.3447 11.34 22.3443L16.5482 17.252C16.5483 17.2519 16.5483 17.2519 16.5484 17.2518C17.0138 16.7981 17.0169 16.0545 16.561 15.5941C16.1061 15.1346 15.3642 15.1269 14.9011 15.5805L9.78521 20.5827L7.26631 18.0167C7.26612 18.0165 7.26594 18.0163 7.26576 18.0162C6.81252 17.5519 6.06946 17.5475 5.60637 17.9942L5.60562 17.9949C5.13996 18.4464 5.12943 19.1899 5.58495 19.6526C5.58501 19.6526 5.58507 19.6527 5.58513 19.6527L8.21966 22.3363ZM25.025 28.35H14.175C13.5283 28.35 13 28.8724 13 29.5208C13 30.1693 13.5283 30.6917 14.175 30.6917H25.025C25.6717 30.6917 26.2 30.1693 26.2 29.5208C26.2 28.8724 25.6717 28.35 25.025 28.35ZM25.025 8.30833H14.175C13.5283 8.30833 13 8.83072 13 9.47917C13 10.1276 13.5283 10.65 14.175 10.65H25.025C25.6717 10.65 26.2 10.1276 26.2 9.47917C26.2 8.83072 25.6717 8.30833 25.025 8.30833ZM25.025 18.3292H18.825C18.1783 18.3292 17.65 18.8516 17.65 19.5C17.65 20.1484 18.1783 20.6708 18.825 20.6708H25.025C25.6717 20.6708 26.2 20.1484 26.2 19.5C26.2 18.8516 25.6717 18.3292 25.025 18.3292ZM8.75 27.5792C7.67552 27.5792 6.8 28.4469 6.8 29.5208C6.8 30.5948 7.67552 31.4625 8.75 31.4625C9.82448 31.4625 10.7 30.5948 10.7 29.5208C10.7 28.4469 9.82448 27.5792 8.75 27.5792ZM8.75 11.4208C9.82448 11.4208 10.7 10.5531 10.7 9.47917C10.7 8.40522 9.82448 7.5375 8.75 7.5375C7.67552 7.5375 6.8 8.40522 6.8 9.47917C6.8 10.5531 7.67552 11.4208 8.75 11.4208ZM32.4 31.0625V7.9375C32.4 3.88968 29.0894 0.6 25.025 0.6H7.975C3.91057 0.6 0.6 3.88968 0.6 7.9375V31.0625C0.6 35.1103 3.91057 38.4 7.975 38.4H25.025C29.0894 38.4 32.4 35.1103 32.4 31.0625ZM25.025 2.94167C27.7976 2.94167 30.05 5.18503 30.05 7.9375V31.0625C30.05 33.815 27.7976 36.0583 25.025 36.0583H7.975C5.20238 36.0583 2.95 33.815 2.95 31.0625V7.9375C2.95 5.18503 5.20238 2.94167 7.975 2.94167H25.025Z" stroke-width="0.8"/>
              </svg>
              <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">
                Laporan</p>
          </div>

          {{-- when focus --}}
          <div class="w-2 h-full  @if (Route::is('pemasukan') or Route::is('pengeluaran') or Route::is('akumulasi')) menu-active2 @endif transition ease-in-out"></div>
        </a>
        
        {{-- end laporan --}}

        {{-- voucher & diskon --}}
        <a href="{{ Route('diskon') }}" class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

            {{-- icon & title --}}
            <div class="flex flex-row  @if (Route::is('voucher') or Route::is('diskon')) menu-active1 @else menu-hover1 @endif items-center w-full">
                <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out" viewBox="0 0 33 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5862 28.8749L4.125 15.4137V18.1637C4.125 18.8924 4.41375 19.5937 4.93625 20.1024L15.6475 30.8137C16.72 31.8862 18.4663 31.8862 19.5388 30.8137L28.0775 22.2749C29.15 21.2024 29.15 19.4562 28.0775 18.3837L17.5862 28.8749Z" />
                    <path d="M15.6475 23.9387C16.1838 24.475 16.885 24.75 17.5862 24.75C18.2875 24.75 18.9887 24.475 19.525 23.9387L28.0637 15.4C29.1362 14.3275 29.1362 12.5812 28.0637 11.5087L17.3525 0.7975C16.8437 0.28875 16.1425 0 15.4138 0H6.875C5.3625 0 4.125 1.2375 4.125 2.75V11.2888C4.125 12.0175 4.41375 12.7187 4.93625 13.2275L15.6475 23.9387ZM6.875 2.75H15.4138L26.125 13.4612L17.5862 22L6.875 11.2888V2.75Z" />
                    <path d="M9.96875 7.5625C10.918 7.5625 11.6875 6.79299 11.6875 5.84375C11.6875 4.89451 10.918 4.125 9.96875 4.125C9.01951 4.125 8.25 4.89451 8.25 5.84375C8.25 6.79299 9.01951 7.5625 9.96875 7.5625Z" />
                    </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Voucher & Diskon</p>
            </div>
  
            {{-- when focus --}}
            <div class="w-2 h-full  @if (Route::is('voucher') or Route::is('diskon')) menu-active2 @endif transition ease-in-out"></div>
          </a>
          
          {{-- voucher & diskon --}}



    </div>
    {{-- end bot side --}}
</div>
