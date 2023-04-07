@extends('layout.main')

@section('title')
    Retur Supplier
@endsection

@section('content')
    {{-- content --}}
    <div class="flex flex-col w-full">

        {{-- top --}}
        <div class="flex w-full items-center justify-center bg-white text-[11px] md:text-[15px] border-b-[1px] border-b-[#DCDADA]">

            {{-- left --}}
            <div class="flex gap-2 md:gap-4 w-[50%] p-3 min-[374px]:p-5 md:p-7 lg:p-5 lg:px-7">

                <svg class="w-[15px] h-[16px] md:w-[20px] md:h-[21px]" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.1158 19.7364C15.9969 19.7364 19.9538 15.8248 19.9538 10.9995C19.9538 6.17431 15.9969 2.2627 11.1158 2.2627C6.23472 2.2627 2.27783 6.17431 2.27783 10.9995C2.27783 15.8248 6.23472 19.7364 11.1158 19.7364Z"
                        fill="white" stroke="black" stroke-width="3" />
                    <path d="M17.3374 17.7676L23.0022 24.1676" stroke="black" stroke-width="3" />
                </svg>

                <input class="placeholder:text-[11px] md:placeholder:text-[15px] outline-none w-[80%]" placeholder="Kode Barang">
            </div>

            {{-- right --}}
            <div class="flex justify-end p-3 min-[374px]:p-5 items-center gap-2 min-[374px]:gap-4 md:gap-6 w-[50%]">
                <div class="flex gap-2">
                    <p class="poppins-medium py-1 bg-white">Kategori</p>
                    <select name="" id=""
                        class="appearance-none py-[1px] px-2 bg-white border-[1px] border-[#A7A5A5] outline-none rounded-sm">
                        <option class="md:text-[15px]" value="">Pria</option>
                        <option class="md:text-[15px]" value="">Wanita</option>
                        <option class="md:text-[15px]" value="">Anak</option>
                    </select>
                </div>

                <svg class="w-[15px] h-[15px] md:w-[20px] md:h-[20px]" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5.96667 3.76616V0.849609V0.549609H5.66667H3.33333H3.03333V0.849609V6.68294C3.03333 8.13546 4.21415 9.31628 5.66667 9.31628H11.5H11.8V9.01628V6.68294V6.38294H11.5H7.41874C9.48385 4.53668 12.1784 3.48294 15 3.48294C21.2673 3.48294 26.3667 8.58229 26.3667 14.8496C26.3667 21.1169 21.2673 26.2163 15 26.2163C8.73269 26.2163 3.63333 21.1169 3.63333 14.8496V14.5496H3.33333H1H0.7V14.8496C0.7 22.7351 7.11448 29.1496 15 29.1496C22.8855 29.1496 29.3 22.7351 29.3 14.8496C29.3 6.96409 22.8855 0.549609 15 0.549609C11.6744 0.549609 8.49055 1.7121 5.96667 3.76616Z"
                        fill="#787777" stroke="#787777" stroke-width="0.6" />
                </svg>

            </div>

        </div>

        {{-- content --}}
        <div class="flex flex-col w-full lg:justify-between p-2 lg:h-[73vh] 2xl:h-[79vh]">

            {{-- table --}}
            <div class="w-full overflow-auto whitespace-nowrap text-ellipsis mt-3 md:mt-6 lg:mt-3">
                <table class="w-full text-[11px] md:text-[15px] border-separate border-spacing-y-2 md:border-spacing-4 lg:border-spacing-2 2xl:border-spacing-3">

                    <tr class="w-full">
                        <td class="w-[35%] inline-block text-center text-[#787777]">Nama Produk</td>
                        <td class="w-[20%] inline-block text-center text-[#787777]">Kategori</td>
                        <td class="w-[10%] inline-block text-center text-[#787777]">Stock</td>
                        <td class="w-[25%] inline-block text-center text-[#787777]">Harga</td>
                        <td class="w-[10%] inline-block text-center text-[#787777]">Aksi</td>
                    </tr>

                    @for ($i = 0; $i < 7; $i++)
                        <tr class="w-full bg-white outline outline-[1px] outline-[#DCDADA] rounded-md">
                            <td
                                class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[35%] inline-block whitespace-nowrap text-ellipsis overflow-hidden">
                                Celana Chinos Buat Perang </td>
                            <td class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[20%] inline-block overflow-hidden">Pria</td>
                            <td class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[10%] inline-block overflow-hidden">15</td>
                            <td class="p-3 min-[374px]:p-5 md:p-7 lg:p-3 xl:p-4 2xl:p-6 text-center w-[25%] inline-block overflow-hidden">Rp. 300.000</td>
                            <td class="text-center w-[10%] inline-block overflow-hidden">
                                <svg class="w-[30px] h-[30px] md:w-[50px] md:h-[50px] lg:w-[40px] lg:h-[40px] m-auto" viewBox="0 0 54 54" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g class="fill-black hover:fill-[#3a3a3a] transition ease-in-out" filter="url(#filter0_d_294_238)">
                                        <rect x="2" y="4" width="46" height="46" rx="6"/>
                                    </g>
                                    <path
                                        d="M34.2084 35C33.9984 35 33.7971 34.9181 33.6486 34.7724C33.5002 34.6266 33.4168 34.4289 33.4168 34.2228C33.4155 32.9863 32.9147 31.8009 32.0242 30.9266C31.1337 30.0523 29.9263 29.5605 28.667 29.5593H24.0519V30.792C24.0518 31.0994 23.9589 31.3999 23.7849 31.6555C23.611 31.911 23.3637 32.1102 23.0745 32.2278C22.7852 32.3455 22.4669 32.3763 22.1598 32.3163C21.8528 32.2564 21.5707 32.1084 21.3493 31.891L16.6953 27.3216C16.2501 26.8844 16 26.2914 16 25.6731C16 25.0548 16.2501 24.4618 16.6953 24.0245L21.3493 19.4551C21.5707 19.2378 21.8528 19.0898 22.1598 19.0299C22.4669 18.9699 22.7852 19.0007 23.0745 19.1183C23.3637 19.2359 23.611 19.4351 23.7849 19.6907C23.9589 19.9463 24.0518 20.2468 24.0519 20.5542V21.7869H27.8754C29.7643 21.7889 31.5753 22.5266 32.9109 23.838C34.2466 25.1494 34.9979 26.9274 35 28.7821V34.2228C35 34.4289 34.9166 34.6266 34.7681 34.7724C34.6197 34.9181 34.4183 35 34.2084 35ZM22.4686 20.5542L17.8147 25.1236C17.6663 25.2693 17.5829 25.467 17.5829 25.6731C17.5829 25.8792 17.6663 26.0768 17.8147 26.2226L22.4686 30.792V28.7821C22.4686 28.5759 22.552 28.3782 22.7005 28.2325C22.8489 28.0867 23.0503 28.0048 23.2602 28.0048H28.667C29.566 28.0045 30.4547 28.1926 31.2737 28.5563C32.0928 28.9201 32.8234 29.4512 33.4168 30.1143V28.7821C33.4151 27.3396 32.8307 25.9567 31.7919 24.9367C30.753 23.9167 29.3445 23.343 27.8754 23.3414H23.2602C23.0503 23.3414 22.8489 23.2595 22.7005 23.1137C22.552 22.9679 22.4686 22.7702 22.4686 22.5641V20.5542Z"
                                        fill="white" />
                                    <defs>
                                        <filter id="filter0_d_294_238" x="0" y="0" width="54"
                                            height="54" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
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
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_294_238"
                                                result="shape" />
                                        </filter>
                                    </defs>
                                </svg>
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>

            {{-- bottom --}}
            <div class="flex flex-col lg:flex-row lg:justify-between lg:px-[3%] items-center w-full text-[11px] md:text-[15px] gap-3 md:gap-5 lg:gap-0 mt-5 lg:mt-3">
                <p>Menampilkan <span class="poppins-semibold">5</span> data dari <span class="poppins-semibold">10</span>
                </p>
                <div class="flex justify-center items-center w-auto px-3 py-2 md:px-5 md:py-3 lg:py-2 rounded-sm md:rounded-md bg-white border-[#DCDADA] border-[1px]">
                    <ul class="flex flex-row gap-2">
                        <li class="pr-3 md:pr-6 lg:pr-3 items-center flex cursor-pointer">
                            <svg class="w-[8px] h-[9px] md:w-[12px] md:h-[13px]" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 6.5L11.25 0.00480938L11.25 12.9952L0 6.5Z" fill="#787777" />
                            </svg>
                        </li>
                        <li class="flex justify-center items-center bg-[#6F6F6F] text-white rounded-sm md:rounded-md lg:rounded-sm w-6 h-6 md:w-12 md:h-12 lg:w-7 lg:h-7 cursor-pointer">1</li>
                        <li class="flex justify-center items-center bg-[#ffffff] text-black rounded-sm md:rounded-md lg:rounded-sm w-6 h-6 md:w-12 md:h-12 lg:w-7 lg:h-7 cursor-pointer hover:bg-[#ebebeb]">2</li>
                        <li class="flex justify-center items-center bg-[#ffffff] text-black rounded-sm md:rounded-md lg:rounded-sm w-6 h-6 md:w-12 md:h-12 lg:w-7 lg:h-7 cursor-pointer hover:bg-[#ebebeb]">3</li>
                        <li class="flex justify-center items-center bg-[#ffffff] text-black rounded-sm md:rounded-md lg:rounded-sm w-6 h-6 md:w-12 md:h-12 lg:w-7 lg:h-7 cursor-pointer hover:bg-[#ebebeb]">4</li>
                        <li class="pl-3 md:pl-6 lg:pl-3 items-center flex">
                            <svg class="w-[8px] h-[9px] md:w-[12px] md:h-[13px]" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 6.5L0.75 12.9952V0.00480938L12 6.5Z" fill="#787777" />
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
