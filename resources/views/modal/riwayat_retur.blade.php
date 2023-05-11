{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none">
</div>


{{-- TODO: INI KONTEN MODAL --}}
<div id="konten_modal_detail_riwayat"
    class="scale-0 fixed w-[90%] md:w-[517px] lg:w-[900px] flex flex-col justify-between z-[101] left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg transition ease-linear duration-200 bg-white">

    {{-- top --}}
    <div class="flex justify-between items-center w-full p-5 md:p-8 border-b-[1px] border-[#DCDADA]">

        <h1 class="text-xs min-[390px]:text-base md:text-lg poppins-medium">Detail Transaksi</h1>

        <div class="cursor-pointer" onclick="closeModalDetail()">
            <svg class="w-3" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M15.3241 11.4566L22.2188 4.56114C22.6665 4.05283 22.9036 3.3933 22.882 2.71659C22.8603 2.03989 22.5816 1.39681 22.1024 0.918059C21.6232 0.439313 20.9795 0.160835 20.3022 0.13923C19.6249 0.117625 18.9647 0.354514 18.456 0.801745L11.5541 7.69013L4.63975 0.780436C4.39209 0.533007 4.09807 0.336736 3.77449 0.202829C3.45091 0.0689213 3.1041 2.60709e-09 2.75386 0C2.40362 -2.60709e-09 2.05681 0.0689213 1.73322 0.202829C1.40964 0.336736 1.11563 0.533007 0.867972 0.780436C0.620314 1.02786 0.423861 1.32161 0.289829 1.64489C0.155798 1.96817 0.0868124 2.31466 0.0868124 2.66457C0.0868124 3.01449 0.155798 3.36098 0.289829 3.68426C0.423861 4.00755 0.620314 4.30129 0.867972 4.54871L7.78407 11.4566L0.889301 18.3503C0.618901 18.5918 0.400659 18.8859 0.247928 19.2146C0.0951977 19.5432 0.0111898 19.8996 0.00104358 20.2618C-0.00910267 20.624 0.0548262 20.9844 0.18892 21.3211C0.323013 21.6578 0.524451 21.9636 0.78091 22.2198C1.03737 22.476 1.34345 22.6773 1.68044 22.8113C2.01743 22.9452 2.37823 23.0091 2.74078 22.999C3.10332 22.9888 3.45999 22.9049 3.78895 22.7523C4.11791 22.5997 4.41225 22.3817 4.65397 22.1115L11.5541 15.2231L18.4471 22.1115C18.9472 22.6112 19.6256 22.892 20.333 22.892C21.0403 22.892 21.7187 22.6112 22.2188 22.1115C22.719 21.6118 23 20.9341 23 20.2274C23 19.5207 22.719 18.8429 22.2188 18.3432L15.3241 11.4566Z"
                    fill="black" />
            </svg>
        </div>

    </div>

    {{-- content --}}
    <div class="flex flex-col w-full">

        {{-- table --}}
        <div class="w-full overflow-auto whitespace-nowrap pb-5 border-b-[1px] border-[#DCDADA] p-5 md:p-8">
            <table class="w-full text-xs min-[390px]:text-sm md:text-base">
                <thead class="bg-[#F2F2F2] border-[1px] border-[#F2F2F2] text-[#C68300]">
                    <tr>
                        <th class="p-3 md:p-5 text-left">Produk</th>
                        <th class="p-3 md:p-5">Jumlah Produk</th>
                        <th class="p-3 md:p-5">Jumlh Retur</th>
                        <th class="p-3 md:p-5 text-right">Uang Kembai</th>
                    </tr>
                </thead>
                <tbody class="text-center bg-white border-[1px] border-[#CCCCCC]">
                    <tr>
                        <td class="p-3 md:p-5 text-left" id="nama_br"></td>
                        <td class="p-3 md:p-5" id="jumlah_produk"></td>
                        <td class="p-3 md:p-5" id="jumlah_retur"></td>
                        <td class="p-3 md:p-5 text-right" id="uang_kembali">
                        <td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- detail --}}
        <div class="flex flex-col lg:flex-row w-full p-5 md:p-8">
            <table class="lg:flex lg:gap-7 whitespace-nowrap text-xs min-[390px]:text-sm md:text-base w-1/2 lg:w-full">
                {{-- left --}}
                <tbody>
                    {{-- no transaksi --}}
                    <tr>
                        <td class="px-2 py-1 poppins-medium">No Transaksi</td>
                        <td class="px-2 py-1 poppins-medium">:</td>
                        <td class="px-2 py-1 poppins-regular" id="no_tr"></td>
                    </tr>

                    {{-- Tanggal --}}
                    <tr>
                        <td class="px-2 py-1 poppins-medium">Tanggal</td>
                        <td class="px-2 py-1 poppins-medium">:</td>
                        <td class="px-2 py-1 poppins-regular" id="tgl_tr"></td>
                    </tr>

                    {{-- Nama sp --}}
                    <tr>
                        <td class="px-2 py-1 poppins-medium">Nama Sp</td>
                        <td class="px-2 py-1 poppins-medium">:</td>
                        <td class="px-2 py-1 poppins-regular" id="nama_sp"></td>
                    </tr>
                </tbody>

                {{-- right --}}
                <tbody>
                    {{-- No Hp --}}
                    <tr>
                        <td class="px-2 py-1 poppins-medium">No HP</td>
                        <td class="px-2 py-1 poppins-medium">:</td>
                        <td class="px-2 py-1 poppins-regular" id="no_tlp"></td>
                    </tr>

                    {{-- Instansi --}}
                    <tr>
                        <td class="px-2 py-1 poppins-medium">Instansi</td>
                        <td class="px-2 py-1 poppins-medium">:</td>
                        <td class="px-2 py-1 poppins-regular" id="instansi"></td>
                    </tr>
                </tbody>
            </table>

            {{-- button --}}
            <div
                class="flex justify-center lg:justify-end lg:items-center w-full gap-3 mt-7 lg:m-0 md:mt-10 text-xs min-[390px]:text-base md:text-lg">
                <button type="button"
                    class="lg:h-[45%] px-5 py-2 poppins-semibold text-white bg-[#3C3C3C] transition ease-in-out hover:bg-black rounded-[5px]">Cetak</button>
                <button type="button" onclick="closeModalDetail()"
                    class="lg:h-[45%] px-5 py-2 poppins-semibol bg-[#FFB015] hover:bg-[#f5a300] transition ease-in-out rounded-[5px]">Ok</button>
            </div>
        </div>

    </div>
</div>
