{{-- bg hitam --}}
<div class="w-screen h-screen bg-black fixed z-[98] opacity-50 hidden transition ease-in delay-300" id="bg-sidebar"></div>

{{-- sidebar --}}
<div class="main-sidebar flex flex-col w-[80%] md:w-[390px] lg:w-[290px] h-screen bg-white border-r-[1px] border-r-[#DCDADA] box-border fixed z-[99] pb-8 2xl:pb-10"
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
    <div class="flex flex-col gap-2 pl-8 lg:mt-0 overflow-y-auto md:scrollbar-hide h-full">

        {{-- master data --}}
        <div class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

            {{-- icon & title --}}
            <div class="flex flex-row menu-hover1 items-center w-full">
                <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out"
                    viewBox="0 0 32 30" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.0333 2.59091C16.2193 2.68203 16.4231 2.72866 16.6293 2.72727H25.3333C27.1008 2.72944 28.7953 3.44848 30.045 4.72666C31.2948 6.00485 31.9979 7.73783 32 9.54545V23.1818C31.9979 24.9894 31.2948 26.7224 30.045 28.0006C28.7953 29.2788 27.1008 29.9978 25.3333 30H6.66667C4.89921 29.9978 3.20474 29.2788 1.95496 28.0006C0.705176 26.7224 0.00211714 24.9894 0 23.1818V6.81818C0.00211714 5.01055 0.705176 3.27758 1.95496 1.99939C3.20474 0.721203 4.89921 0.00216526 6.66667 0H10.0373C10.6579 0.000526829 11.2699 0.148016 11.8253 0.430909L16.0333 2.59091ZM10.6333 2.86364C10.4474 2.77251 10.2435 2.72588 10.0373 2.72727H6.66667C5.6058 2.72727 4.58839 3.15828 3.83824 3.92547C3.08809 4.69267 2.66667 5.73321 2.66667 6.81818V8.17364L29.0387 8.02091C28.7415 7.26415 28.23 6.61548 27.5697 6.1582C26.9095 5.70091 26.1307 5.45588 25.3333 5.45455H16.6293C16.0083 5.4519 15.3963 5.30207 14.8413 5.01682L10.6333 2.86364ZM3.83824 26.0745C4.58839 26.8417 5.6058 27.2727 6.66667 27.2727H25.3333C26.3942 27.2727 27.4116 26.8417 28.1618 26.0745C28.9119 25.3073 29.3333 24.2668 29.3333 23.1818V10.7468L2.66667 10.9009V23.1818C2.66667 24.2668 3.08809 25.3073 3.83824 26.0745Z" />
                </svg>
                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Master
                    Data</p>
            </div>

            {{-- when focus --}}
            <div class="w-2 h-full menu-hover2 transition ease-in-out"></div>
        </div>
        {{-- end master data --}}

        {{-- riwayat --}}
        <div class="flex flex-row justify-between h-[48px] cursor-pointer menu flex-none">

            {{-- icon & title --}}
            <div class="flex flex-row menu-hover1 items-center w-full">

                <svg class="w-6 h-6 md:w-[30px] md:h-[30px] lg:w-6 lg:h-6 fill-black transition ease-in-out" width="34" height="34" viewBox="0 0 34 34" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 0.85L16.9999 0.85C13.1349 0.852756 9.40355 2.24456 6.48333 4.76519V2.33333C6.48333 1.93993 6.32705 1.56264 6.04887 1.28446C5.7707 1.00628 5.3934 0.85 5 0.85C4.6066 0.85 4.2293 1.00628 3.95112 1.28446C3.67295 1.56264 3.51667 1.93993 3.51667 2.33333V6.33333C3.51667 7.43398 3.9539 8.48955 4.73217 9.26783C5.51045 10.0461 6.56602 10.4833 7.66667 10.4833H11.6667C12.0601 10.4833 12.4374 10.3271 12.7155 10.0489C12.9937 9.77069 13.15 9.3934 13.15 9C13.15 8.60659 12.9937 8.2293 12.7155 7.95112C12.4374 7.67295 12.0601 7.51667 11.6667 7.51667H7.87149C9.98967 5.48603 12.7284 4.21889 15.6539 3.92212C18.6872 3.61441 21.7334 4.36902 24.2723 6.05712C26.8113 7.74523 28.6856 10.2622 29.5754 13.1784C30.4653 16.0946 30.3154 19.2292 29.1515 22.0472C27.9875 24.8652 25.8816 27.1919 23.1932 28.6301C20.5048 30.0683 17.4006 30.5288 14.4104 29.9332C11.4202 29.3375 8.72948 27.7225 6.79745 25.3639C4.86542 23.0052 3.81188 20.0492 3.81667 17.0002V17C3.81667 16.6066 3.66039 16.2293 3.38221 15.9511C3.10403 15.6729 2.72674 15.5167 2.33333 15.5167C1.93993 15.5167 1.56264 15.6729 1.28446 15.9511C1.00628 16.2293 0.85 16.6066 0.85 17C0.85 20.1942 1.79718 23.3166 3.57177 25.9725C5.34635 28.6283 7.86864 30.6983 10.8197 31.9206C13.7707 33.143 17.0179 33.4628 20.1507 32.8397C23.2835 32.2165 26.1612 30.6784 28.4198 28.4198C30.6784 26.1612 32.2165 23.2835 32.8397 20.1507C33.4628 17.0179 33.143 13.7707 31.9206 10.8197C30.6983 7.86864 28.6283 5.34635 25.9725 3.57177C23.3166 1.79718 20.1942 0.85 17 0.85Z"
                         stroke-width="0.3" />
                    <path
                        d="M15.5166 17V17C15.5167 17.3934 15.673 17.7706 15.9512 18.0487L19.9512 22.0487L19.9512 22.0487L19.9531 22.0506C20.2328 22.3208 20.6075 22.4703 20.9965 22.4669C21.3854 22.4635 21.7574 22.3075 22.0324 22.0325C22.3075 21.7575 22.4635 21.3854 22.4669 20.9965C22.4702 20.6076 22.3207 20.2329 22.0505 19.9531L22.0505 19.9531L22.0487 19.9513L18.4833 16.3859V10.3333C18.4833 9.93993 18.327 9.56264 18.0488 9.28446C17.7707 9.00628 17.3934 8.85 17 8.85C16.6066 8.85 16.2293 9.00628 15.9511 9.28446C15.6729 9.56264 15.5166 9.93993 15.5166 10.3333V17Z"
                        " stroke-width="0.3" />
                </svg>

                <p class="ml-5 poppins-medium text-[15px] md:text-[16px] lg:text-[15px] transition ease-in-out">Riwayat
                    Transaksi</p>
            </div>

            {{-- when focus --}}
            <div class="w-2 h-full menu-hover2 transition ease-in-out"></div>
        </div>
        {{-- end riwayat --}}

        {{-- voucher & diskon --}}

        {{-- end voucher & diskon --}}

    </div>
    {{-- end bot side --}}
</div>
