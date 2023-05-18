<div id="bg_modal" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>

<form id="form_supplier" action="/supplier/add" method="POST">
    @csrf
    <div id="konten_modal"
        class="fixed w-[95%] md:w-[500px] lg:h-[95%] 2xl:h-[75%] flex flex-col justify-between p-4 min-[374px]:p-5 md:p-7 z-[101] left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg scale-0 transition ease-linear duration-200 bg-white">
        
        <!-- header -->
        <div
            class="flex justify-between w-full h-10 min-[374px]:h-11 lg:text-[18px] md:text-[17px] text-[14px] pt-1 min-[374px]:mb-3 md:mb-8">
            <h1 class="poppins-medium leading-none">Tambah Data Supplier</h1>

            {{-- X --}}
            <div onclick="closeModal()" class="cursor-pointer">
                <svg class="h-3 md:h-4 w-3 md:w-4" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.9879 14.9434L28.9811 5.94932C29.565 5.28631 29.8743 4.42604 29.8461 3.54338C29.8178 2.66072 29.4543 1.82192 28.8292 1.19747C28.2042 0.573017 27.3646 0.209785 26.4812 0.181604C25.5977 0.153424 24.7366 0.462409 24.073 1.04575L15.0705 10.0306L6.05184 1.01796C5.72881 0.695226 5.34531 0.439221 4.92325 0.264559C4.50119 0.0898973 4.04883 3.40055e-09 3.59199 0C3.13515 -3.40055e-09 2.68279 0.0898973 2.26073 0.264559C1.83867 0.439221 1.45517 0.695226 1.13214 1.01796C0.809105 1.34069 0.552862 1.72383 0.378038 2.1455C0.203214 2.56717 0.113234 3.01912 0.113234 3.47553C0.113234 3.93195 0.203214 4.38389 0.378038 4.80556C0.552862 5.22723 0.809105 5.61037 1.13214 5.9331L10.1531 14.9434L1.15996 23.9352C0.807262 24.2502 0.522599 24.6338 0.323385 25.0625C0.124171 25.4912 0.0145954 25.9559 0.00136119 26.4284C-0.0118731 26.9008 0.0715125 27.371 0.246417 27.8101C0.421321 28.2493 0.684067 28.6482 1.01858 28.9824C1.35309 29.3166 1.75233 29.5791 2.19188 29.7538C2.63143 29.9286 3.10204 30.0119 3.57493 29.9986C4.04782 29.9854 4.51303 29.8759 4.94211 29.6769C5.37119 29.4779 5.75511 29.1935 6.07039 28.8411L15.0705 19.8563L24.0614 28.8411C24.7138 29.4929 25.5986 29.8591 26.5212 29.8591C27.4439 29.8591 28.3287 29.4929 28.9811 28.8411C29.6335 28.1893 30 27.3053 30 26.3835C30 25.4618 29.6335 24.5778 28.9811 23.926L19.9879 14.9434Z"
                        fill="black" />
                </svg>
            </div>
        </div>
        <!-- end header -->


        {{-- <!-- konten modal -->
          {{-- content --}}
          <div class="w-full flex-grow overflow-auto lg:text-[16px] md:text-[15px] text-[12px]">

            <input id="idSup" name="id" type="hidden" placeholder=""
                class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('id') }}">

            {{-- nama Produk --}}
            <div class="block">
                <Label class="ml-2 text-sm">Nama Supplier</Label>
                <input id="nama" name="nama" type="text" placeholder=""
                    class="border-2 w-full rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('nama') }}">
                @error('nama')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="flex flex-col mt-2 min-[374px]:mt-4">
                <Label class="ml-2 text-sm">Keterangan</Label>
                <input id="ket" name="ket" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('ket') }}">
                @error('ket')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kontak --}}
            <div class="flex flex-col mt-2 min-[374px]:mt-4">
                <Label class="ml-2 text-sm">Nomor Telepon</Label>
                <input id="kontak" name="kontak" type="text" onkeypress="return hanyaAngka(event)"
                    placeholder="" class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('kontak') }}">
                @error('kontak')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat --}}
            <div class="flex flex-col mt-2 min-[374px]:mt-4">
                <Label class="ml-2 text-sm">Alamat</Label>
                <input id="alamat" name="alamat" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('alamat') }}">
                @error('alamat')
                    <p class="label-error text-sm text-red-700">{{ $message }}</p>
                @enderror
            </div>
           

        </div>        

        <!-- footer -->
        <div
            class="w-full h-10 min-[374px]:h-11 md:h-14 lg:text-[16px] md:text-[15px] text-[12px] poppins-semibold mt-5 min-[374px]:mt-9">
            <button type="button" id="btn_submit"
                class="w-full h-full rounded-md bg-[#FFB015] hover:bg-[#ce8900] transition ease-in-out">
                <span id="button_submit" class="text-xs poppins-medium">Tambah Data</span>
            </button>
        </div>
        <!-- end footer -->
    </div>
</form>