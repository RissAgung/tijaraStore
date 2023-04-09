{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modalUpdate" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<form id="form_productUpdate" action="/product/update" method="post" enctype="multipart/form-data">
    @csrf
    <div id="konten_modalUpdate"
        class="bg-white w-[90%] md:w-[70%] z-[101] h-[80%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
        {{-- ? start header ? --}}
        <div class="flex flex-row justify-between">
            <div class="flex justify-start px-4 md:px-8 py-6">
                <p id="title_modal">Update Data</p>
            </div>
            <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
                <div id="btn_barcode">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11 9H13V7H11M12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 2C10.6868 2 9.38642 2.25866 8.17317 2.7612C6.95991 3.26375 5.85752 4.00035 4.92893 4.92893C3.05357 6.8043 2 9.34784 2 12C2 14.6522 3.05357 17.1957 4.92893 19.0711C5.85752 19.9997 6.95991 20.7362 8.17317 21.2388C9.38642 21.7413 10.6868 22 12 22C14.6522 22 17.1957 20.9464 19.0711 19.0711C20.9464 17.1957 22 14.6522 22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7362 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2ZM11 17H13V11H11V17Z"
                            fill="black" />
                    </svg>
                </div>
                <div onclick="closeModalUpdate()">
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
        <div
            class="w-full flex-grow overflow-y-auto flex flex-col md:flex-row md:flex-wrap md:gap-4 md:pt-8 px-4 md:px-8">

            <input id="idproductUpdate" name="id_update" type="hidden" placeholder=""
                class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('id_update') }}">

            <input id="barcode_id" name="barcode_id" type="hidden" placeholder=""
                class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('barcode_id') }}">

            <div class="flex flex-col flex-grow md:w-[48%] md:mt-0 md:order-1 justify-start mt-6">
                <Label class="ml-2 text-sm">Nama Product</Label>
                <input id="txt_namaUpdate" name="txt_nama_update" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('txt_nama_update') }}">
                @error('txt_nama_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-grow md:w-1/2 md:mt-0 md:order-2 justify-start mt-2">
                <Label class="ml-2 text-sm">Warna</Label>
                <input id="txt_warnaUpdate" name="txt_warna_update" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('txt_warna_update') }}">
                @error('txt_warna_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-3 justify-start mt-2">
                <Label class="ml-2 text-sm">Kategori</Label>
                <select id="txt_kategoriUpdate" name="txt_kategori_update" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none appearance-none">
                    <option {{ old('txt_kategori_update') == 'pria' ? 'selected' : '' }} value="pria">Pria</option>
                    <option {{ old('txt_kategori_update') == 'wanita' ? 'selected' : '' }} value="wanita">Wanita
                    </option>
                    <option {{ old('txt_kategori_update') == 'anak' ? 'selected' : '' }} value="anak">Anak</option>
                </select>
            </div>
            <div class="flex flex-col  md:w-[32%] md:mt-0 md:order-4 justify-start mt-2">
                <Label class="ml-2 text-sm">Ukuran</Label>
                <select id="txt_ukuranUpdate" name="txt_ukuran_update" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none appearance-none">
                    <option {{ old('txt_ukuran_update') == 'S' ? 'selected' : '' }} value="S">S</option>
                    <option {{ old('txt_ukuran_update') == 'M' ? 'selected' : '' }} value="M">M</option>
                    <option {{ old('txt_ukuran_update') == 'L' ? 'selected' : '' }} value="L">L</option>
                    <option {{ old('txt_ukuran_update') == 'XL' ? 'selected' : '' }} value="XL">XL</option>
                    <option {{ old('txt_ukuran_update') == 'XXL' ? 'selected' : '' }} value="XXL">XXL</option>
                    <option {{ old('txt_ukuran_update') == 'XXXL' ? 'selected' : '' }} value="XXXL">XXXL</option>
                </select>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-8 justify-start mt-2">
                <Label class="ml-2 text-sm">Jenis</Label>
                <div class="flex flex-row flex-wrap mt-2 gap-3 ml-2">
                    <div class="flex flex-row gap-3">
                        <input value="jual" class="w-4 h-4 rounded mt-1" type="radio" name="jenis_update"
                            id="jualUpdate" {{ old('jenis_update') == 'jual' ? 'checked' : '' }}>
                        <label for="jualUpdate">Produk Jual</label>
                    </div>
                    <div class="flex flex-row gap-3">
                        <input value="free" class="w-4 h-4 rounded mt-1" type="radio" name="jenis_update"
                            id="freeUpdate" {{ old('jenis_update') == 'free' ? 'checked' : '' }}>
                        <label for="freeUpdate">Produk Free</label>
                    </div>
                </div>
                @error('jenis_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-6 justify-start mt-2">
                <Label class="ml-2 text-sm">Tag</Label>
                <div
                    class="w-[70%] md:w-full h-44 border-2 rounded-md mt-2 overflow-x-auto flex flex-col flex-wrap px-4 py-4 gap-2">
                    @foreach ($all_tags as $item)
                        <div class="flex flex-row gap-3 items-center">
                            <input name="tags_update[]" id="update-{{ $item->kode_tag }}"
                                class="w-4 h-4 rounded mt-1" type="checkbox" value="{{ $item->kode_tag }}"
                                {{ in_array($item->kode_tag, old('tags_update', [])) ? 'checked' : '' }}>
                            <label for="update-{{ $item->kode_tag }}" class="flex-wrap">{{ $item->nama_tag }}</label>
                        </div>
                    @endforeach
                </div>
                @error('tags_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
                <div class="w-[70%] bg-[#FFB015] py-2 px-4 mt-4 rounded-md">
                    <p class="w-full text-center">Tambah Tag</p>
                </div>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-5 justify-start mt-6">
                <Label class="ml-2 text-sm">Harga</Label>
                <input id="txt_hargaUpdate" name="txt_harga_update" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('txt_harga_update') }}">
                @error('txt_harga_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-7 justify-start mt-6 mb-8">
                <Label class="ml-2 text-sm">Foto</Label>
                <div
                    class="w-[70%] md:w-full h-44 border-2 border-dashed rounded-md mt-2 flex relative p-2 overflow-hidden">
                    <input id="fotoUpdate" name="foto_update" class="opacity-0 h-full w-full z-50" type="file">
                    <div
                        class="absolute left-[50%] top-[50%]  -translate-y-[50%] -translate-x-[50%] flex flex-col items-center justify-center gap-2">

                        <svg class="z-1 pointer-events-none" width="77" height="69" viewBox="0 0 77 69"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.25 53.6667H57.75C58.52 53.6667 59.0975 53.3153 59.4825 52.6125C59.8675 51.9097 59.8033 51.2389 59.29 50.6L48.7025 36.5125C48.3175 36.0014 47.8042 35.7458 47.1625 35.7458C46.5208 35.7458 46.0075 36.0014 45.6225 36.5125L35.6125 49.8333L28.49 40.3458C28.105 39.8347 27.5917 39.5792 26.95 39.5792C26.3083 39.5792 25.795 39.8347 25.41 40.3458L17.71 50.6C17.1967 51.2389 17.1325 51.9097 17.5175 52.6125C17.9025 53.3153 18.48 53.6667 19.25 53.6667ZM7.7 69C5.58251 69 3.76916 68.2499 2.25996 66.7498C0.750756 65.2497 -0.00256013 63.4442 6.5365e-06 61.3333V15.3333C6.5365e-06 13.225 0.754607 11.4195 2.26381 9.91683C3.77301 8.41417 5.58507 7.66411 7.7 7.66667H19.8275L24.64 2.49167C25.3458 1.66111 26.1967 1.03883 27.1926 0.624834C28.1884 0.210834 29.2305 0.00255556 30.3188 0H46.6812C47.7721 0 48.8154 0.208278 49.8113 0.624834C50.8072 1.04139 51.6567 1.66367 52.36 2.49167L57.1725 7.66667H69.3C71.4175 7.66667 73.2308 8.418 74.74 9.92066C76.2492 11.4233 77.0026 13.2276 77 15.3333V61.3333C77 63.4417 76.2454 65.2472 74.7362 66.7498C73.227 68.2525 71.4149 69.0025 69.3 69H7.7Z"
                                fill="#A1A1A1" />
                        </svg>
                        <p class="text-center pointer-events-none">Tambah Gambar Produk</p>
                    </div>
                    <img id="imgpreviewUpdate"
                        class="object-cover h-full w-full absolute left-[50%] top-[50%]  -translate-y-[50%] -translate-x-[50%] flex-col items-center justify-center gap-2 @if (session('old_gambar')) '' @else 'hidden' @endif"
                        src="@if (session('old_gambar')) {{ session('old_gambar') }} @endif" alt="preview">
                </div>
                @error('foto_update')
                    <p class="label-error-update text-sm text-red-700">{{ $message }}</p>
                @enderror
                <p>File : jpg, jpeg, png</p>
            </div>
        </div>

        {{-- ? end isi modal ? --}}
        {{-- ? start footer ? --}}
        <div class="w-full px-4 md:px-8 py-4">
            <button type="button" id="btn_submitUpdate"
                class="w-full bg-[#FFB015] flex justify-center py-4 rounded-md">
                <span id="button_submit" class="text-xs poppins-medium">Ubah Data</span>
            </button>
        </div>
        {{-- ? end footer ? --}}
    </div>
</form>
