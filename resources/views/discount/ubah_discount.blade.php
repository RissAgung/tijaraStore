{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal_ubah" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<form id="form_discount_ubah" action="/diskon/update" method="post">
    @csrf
    <div id="konten_modal_ubah"
        class="bg-white w-[90%] max-w-[400px] z-[101] h-[80%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
        {{-- ? start header ? --}}
        <div class="flex flex-row justify-between">
            <div class="flex justify-start px-4 md:px-8 py-6">
                <p id="title_modal">Ubah Diskon</p>
            </div>
            <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
                <div onclick="closeModalUbah()">
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
        <div class="w-full flex-grow overflow-y-auto flex flex-col px-4 md:px-8 gap-4">
            <input maxlength="30" id="txt_kode_update" name="txt_kode_update" type="hidden" @readonly(true) placeholder=""
                class="border-2 rounded-l-md py-2 px-4 w-full outline-none flex-grow flex" value="{{ old('txt_kode_update') }}">
            <div class="flex flex-col gap-2 w-full mt-8">
                <span>Pilih Produk</span>
                <div class="flex flex-row gap-2 w-full">
                    <input maxlength="30" id="txt_product_update" name="txt_product_update" type="text" @readonly(true)
                        placeholder="" class="border-2 rounded-md py-2 px-4 w-full outline-none flex-grow flex"
                        value="{{ old('txt_product_update') }}">
                    
                </div>
                @error('txt_product_update')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>


            <div class="flex flex-col gap-2 w-full">
                <span>Jenis Diskon</span>
                <div class="flex flex-row gap-2 w-full">
                    <div class="relative w-full">
                        <svg class="absolute pointer-events-none top-[50%] -translate-y-[50%] -translate-x-[50%] right-0"
                            width="15" height="15" viewBox="0 0 22 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 18L0.607697 0L21.3923 0L11 18Z" fill="#DDDDDD" />
                        </svg>
                        <select maxlength="15" id="jenis_discount_update" name="jenis_discount_update"
                            class="border-2 rounded-md py-2 px-4 w-full outline-none flex-grow flex appearance-none"
                            value="">
                            <option {{ old('jenis_discount_update') == 'persen' ? 'selected' : '' }} value="persen">Persen</option>
                            <option {{ old('jenis_discount_update') == 'nominal' ? 'selected' : '' }} value="nominal">Nominal</option>
                            <option {{ old('jenis_discount_update') == 'free' ? 'selected' : '' }} value="free">Free Produk</option>
                        </select>
                    </div>
                </div>
                @error('jenis_discount_update')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div id="container-free-product_update" class="hidden flex-col gap-2 w-full">
                <span>Jenis Free Produk</span>
                <div class="flex flex-row gap-2 w-full">
                    <div class="flex flex-row flex-wrap gap-3 ml-2">
                        <div class="flex flex-row gap-3">
                            <input value="bebas" class="w-4 h-4 rounded mt-1" type="radio" name="jenis_free_update"
                                id="bebas_update" {{ old('jenis_free_update') == 'bebas' ? 'checked' : '' }}>
                            <label for="bebas_update">Bebas</label>
                        </div>
                        <div class="flex flex-row gap-3">
                            <input value="sama" class="w-4 h-4 rounded mt-1" type="radio" name="jenis_free_update"
                                id="sama_update" {{ old('jenis_free_update') == 'sama' ? 'checked' : '' }}>
                            <label for="sama_update">Produk sama</label>
                        </div>
                    </div>
                </div>
                @error('jenis_free_update')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div id="container-nominal_update" class="flex flex-col gap-2 w-full">
                <span>Nominal</span>
                <div class="flex flex-row gap-2 w-full">
                    <input maxlength="2" id="txt_nominal_update" name="txt_nominal_update" type="text" placeholder=""
                        class="border-2 rounded-md py-2 px-4 w-full outline-none flex-grow flex" value="{{ old('txt_nominal_update') }}">
                </div>
                @error('txt_nominal_update')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            <div id="container-jumlah_update" class="hidden flex-row w-full gap-2">
                <div class="flex flex-col gap-2 w-full">
                    <span>Beli</span>
                    <div class="flex flex-row gap-2 w-full">
                        <input maxlength="15" id="txt_beli_update" name="txt_beli_update" type="number" placeholder=""
                            class="border-2 rounded-md py-2 px-4 w-full outline-none flex-grow flex" value="{{ old('txt_beli_update') }}">

                    </div>
                    @error('txt_beli_update')
                        <p class="label-error text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <span>Gratis</span>
                    <div class="flex flex-row gap-2 w-full">
                        <input maxlength="15" id="txt_gratis_update" name="txt_gratis_update" type="number" placeholder=""
                            class="border-2 rounded-md py-2 px-4 w-full outline-none flex-grow flex" value="{{ old('txt_gratis_update') }}">
                    </div>
                    @error('txt_gratis_update')
                        <p class="label-error text-sm text-red-700">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- ? end isi modal ? --}}
        {{-- ? start footer ? --}}
        <div class="w-full px-4 md:px-8 py-4">
            <button type="button" id="btn_submit_update" class="w-full bg-[#FFB015] flex justify-center py-4 rounded-md">
                <span class="text-xs poppins-medium">Ubah Data</span>
            </button>
        </div>
        {{-- ? end footer ? --}}
    </div>
</form>
