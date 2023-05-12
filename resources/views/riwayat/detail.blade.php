{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal_detail" class="z-[104] fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<div id="konten_modal_detail"
    class="bg-white w-[80%] md:w-[60%] z-[105] h-[90%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
    {{-- ? start header ? --}}
    <div class="flex flex-row justify-between">
        <div class="flex justify-start px-4 md:px-8 py-6">
            <p id="title_modal">Detail Transaksi</p>
        </div>
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
            <div onclick="closeModalDetail()" class="cursor-pointer">
                <svg class="mt-1" width="15" height="15" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.9879 14.9434L28.9811 5.94932C29.565 5.28631 29.8743 4.42604 29.8461 3.54338C29.8178 2.66072 29.4543 1.82192 28.8292 1.19747C28.2042 0.573017 27.3646 0.209785 26.4812 0.181604C25.5977 0.153424 24.7366 0.462409 24.073 1.04575L15.0705 10.0306L6.05184 1.01796C5.72881 0.695226 5.34531 0.439221 4.92325 0.264559C4.50119 0.0898973 4.04883 3.40055e-09 3.59199 0C3.13515 -3.40055e-09 2.68279 0.0898973 2.26073 0.264559C1.83867 0.439221 1.45517 0.695226 1.13214 1.01796C0.809105 1.34069 0.552862 1.72383 0.378038 2.1455C0.203214 2.56718 0.113234 3.01912 0.113234 3.47553C0.113234 3.93195 0.203214 4.38389 0.378038 4.80556C0.552862 5.22723 0.809105 5.61037 1.13214 5.9331L10.1531 14.9434L1.15996 23.9352C0.807262 24.2502 0.522599 24.6338 0.323385 25.0625C0.124171 25.4912 0.0145954 25.9559 0.00136119 26.4284C-0.0118731 26.9008 0.0715125 27.371 0.246417 27.8101C0.421321 28.2493 0.684066 28.6482 1.01858 28.9824C1.35309 29.3166 1.75233 29.5791 2.19188 29.7538C2.63143 29.9286 3.10204 30.0119 3.57493 29.9986C4.04781 29.9854 4.51303 29.8759 4.94211 29.6769C5.37119 29.4779 5.75511 29.1935 6.07039 28.8411L15.0705 19.8563L24.0614 28.8411C24.7138 29.4929 25.5986 29.8591 26.5212 29.8591C27.4439 29.8591 28.3287 29.4929 28.9811 28.8411C29.6335 28.1893 30 27.3053 30 26.3835C30 25.4618 29.6335 24.5778 28.9811 23.926L19.9879 14.9434Z"
                        fill="black" />
                </svg>
            </div>
        </div>

    </div>
    <div class="h-[2px] w-full bg-[#DDDDDD]"></div>
    {{-- ? end header ? --}}

    {{-- ? start isi modal ? --}}
    <div class="px-4 md:px-8 flex flex-col overflow-y-auto h-full text-sm">
        <div class="flex flex-row flex-wrap w-full my-8">
            <div class="flex flex-row flex-wrap w-full gap-3 text-sm">
                <div class="flex flex-col w-full">
                    <div class="grid grid-cols-10 items-center">
                        <div class="col-span-3 md:col-span-2 text-ellipsis overflow-hidden">No Transaksi</div>
                        <div class="col-span-7 md:col-span-8"><span class="pr-4">:</span><span
                                id="txt_notransaksi">TP0R92722A</span></div>
                    </div>
                    <div class="grid grid-cols-10 items-center">
                        <div class="col-span-3 md:col-span-2 text-ellipsis overflow-hidden">Kasir</div>
                        <div class="col-span-7 md:col-span-8"><span class="pr-4">:</span><span id="txt_kasir">Risqi
                                Nyungsep</span></div>
                    </div>
                    <div class="grid grid-cols-10 items-center">
                        <div class="col-span-3 md:col-span-2 text-ellipsis overflow-hidden">Tanggal</div>
                        <div class="col-span-7 md:col-span-8"><span class="pr-4">:</span><span
                                id="txt_tanggal">2022-12-04 11:17:21</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-grow">
            <div class="w-full border-2 overflow-x-auto border-[#F2F2F2]">
                <table class="w-full gap-2 pb-10">
                    <thead>
                        <tr class="text-[#C68300] poppins-semibold bg-[#F2F2F2]">
                            <th class="text-left py-4 px-4">Produk</th>
                            <th class="text-left py-4 px-4">Harga</th>
                            <th class="text-left py-4 px-4">Diskon</th>
                            <th class="text-left py-4 px-4">Jumlah</th>
                            <th class="text-left py-4 px-4">Subtotal</th>
                        </tr>
                    </thead>
                    {{-- ? Isinya --}}
                    <tbody id="konten_detail_transaksi" class="">
                        <tr>
                            <td class="tracking-wide px-4 py-2 text-left">Dress Panjang Kondangan Anti Peluru</td>
                            <td class="tracking-wide px-4 py-2 text-left">Rp. 210.000</td>
                            <td class="tracking-wide px-4 py-2 text-left">Rp. 30.000</td>
                            <td class="tracking-wide px-4 py-2 text-left">5</td>
                            <td class="tracking-wide px-4 py-2 text-left">Rp. 1.250.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row w-full text-sm py-8">
            <div class="flex flex-grow">
                <div class="flex flex-row flex-wrap w-full items-center">
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Jenis Pembayaran</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_jenis_pembayaran">Cash</span></p>
                    </div>
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Harga Final</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_harga_final">Rp. 210.000</span></p>
                    </div>
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Total</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_total">Rp. 300.000</span></p>
                    </div>
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Bayar</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_bayar">Rp. 250.000</span></p>
                    </div>
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Voucher</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_voucher">Rp. 90.000</span></p>
                    </div>
                    <div class="grid grid-cols-3 w-full lg:w-1/2 items-center">
                        <p class="text-ellipsis overflow-hidden">Kembali</p>
                        <p class="col-span-2"><span class="pr-4">:</span><span id="txt_kembalian">Rp. 50.000</span></p>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-center gap-2 pt-4 px-8 items-center">
                <div class="flex h-fit bg-black px-4 text-white py-2 rounded-sm">
                    <p>Tutup</p>
                </div>
                <div class="flex h-fit bg-primary px-4 text-black py-2 rounded-sm">
                    <p>Cetak</p>
                </div>
            </div>
        </div>
    </div>
    {{-- ? end isi modal ? --}}
</div>
