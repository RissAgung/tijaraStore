<div id="bg_modalUpdate" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<form id="form_edit_pegawai" action="/pegawai/edit" method="post" enctype="multipart/form-data">
    @csrf
    <div id="konten_modalUpdate"
        class="fixed w-[95%] md:w-[500px] lg:h-[95%] 2xl:h-[85%] flex flex-col justify-between p-4 min-[374px]:p-5 md:p-7 z-[101] left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg scale-0 transition ease-linear duration-200 bg-white">

        {{-- top --}}
        <div
            class="flex justify-between w-full h-10 min-[374px]:h-11 lg:text-[18px] md:text-[17px] text-[14px] pt-1 min-[374px]:mb-3 md:mb-8">
            <h1 class="poppins-medium leading-none">Edit Pegawai</h1>

            {{-- X --}}
            <div onclick="closeModalUpdate()" class="cursor-pointer">
                <svg class="h-3 md:h-4 w-3 md:w-4" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.9879 14.9434L28.9811 5.94932C29.565 5.28631 29.8743 4.42604 29.8461 3.54338C29.8178 2.66072 29.4543 1.82192 28.8292 1.19747C28.2042 0.573017 27.3646 0.209785 26.4812 0.181604C25.5977 0.153424 24.7366 0.462409 24.073 1.04575L15.0705 10.0306L6.05184 1.01796C5.72881 0.695226 5.34531 0.439221 4.92325 0.264559C4.50119 0.0898973 4.04883 3.40055e-09 3.59199 0C3.13515 -3.40055e-09 2.68279 0.0898973 2.26073 0.264559C1.83867 0.439221 1.45517 0.695226 1.13214 1.01796C0.809105 1.34069 0.552862 1.72383 0.378038 2.1455C0.203214 2.56717 0.113234 3.01912 0.113234 3.47553C0.113234 3.93195 0.203214 4.38389 0.378038 4.80556C0.552862 5.22723 0.809105 5.61037 1.13214 5.9331L10.1531 14.9434L1.15996 23.9352C0.807262 24.2502 0.522599 24.6338 0.323385 25.0625C0.124171 25.4912 0.0145954 25.9559 0.00136119 26.4284C-0.0118731 26.9008 0.0715125 27.371 0.246417 27.8101C0.421321 28.2493 0.684067 28.6482 1.01858 28.9824C1.35309 29.3166 1.75233 29.5791 2.19188 29.7538C2.63143 29.9286 3.10204 30.0119 3.57493 29.9986C4.04782 29.9854 4.51303 29.8759 4.94211 29.6769C5.37119 29.4779 5.75511 29.1935 6.07039 28.8411L15.0705 19.8563L24.0614 28.8411C24.7138 29.4929 25.5986 29.8591 26.5212 29.8591C27.4439 29.8591 28.3287 29.4929 28.9811 28.8411C29.6335 28.1893 30 27.3053 30 26.3835C30 25.4618 29.6335 24.5778 28.9811 23.926L19.9879 14.9434Z"
                        fill="black" />
                </svg>
            </div>

        </div>

        {{-- content --}}
        <div class="w-full flex-grow overflow-auto lg:text-[16px] md:text-[15px] text-[12px]">

            <input id="kode_pegawaiU" name="kode_pegawai" type="hidden" placeholder=""
                class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="{{ old('kode_pegawai') }}">


            {{-- nama Pegawai --}}
            <div class="block">
                <p class="poppins-medium text-[#535353] mb-1 min-[374px]:mb-2">Nama Pegawai</p>
                <input type="text" name="nama_pegawai" id="nama_pegawaiU" value="{{ old('nama_pegawai') }}"
                    class="text-[#535353] outline-none w-full h-10 min-[374px]:h-11 md:h-14 border-[2px] border-[#DDDDDD] rounded-md pl-2">
            </div>

            {{-- gender --}}
            <div class="block mt-2 min-[374px]:mt-4  ">

                <p class="poppins-medium text-[#535353] mb-1 min-[374px]:mb-2">gender</p>
                <div class="flex flex-row" >
                    <div class="mx-4">
                        <input value="pria"  class="w-4 h-4 rounded mt-1" type="radio" name="gender" id="priaUpdate"
                            {{ old('gender') == 'pria' ? 'checked' : '' }}>
                        <label for="laki-lakiUpdate">laki-laki</label>
                    </div>

                    <div class="mx-4">
                        <input value="wanita"  class="w-4 h-4 rounded mt-1" type="radio" name="gender" id="wanitaUpdate"
                            {{ old('gender') == 'wanita' ? 'checked' : '' }}>
                        <label for="perempuanUpdate">perempuan </label>
                    </div>
                </div>

                {{-- <input type="number"
                    class="text-[#535353] outline-none w-full h-10 min-[374px]:h-11 md:h-14 border-[2px] border-[#DDDDDD] rounded-md pl-2"> --}}
            </div>

            {{-- alamat  --}}
            <div class="block mt-2 min-[374px]:mt-4">
                <p class="poppins-medium text-[#535353] mb-1 min-[374px]:mb-2">alamat</p>
                <input type="textarea" name="alamat" id="alamatU" value="{{ old('alamat') }}"
                    class="text-[#535353] outline-none w-full h-10 min-[374px]:h-11 md:h-14 border-[2px] border-[#DDDDDD] rounded-md pl-2">

            </div>

            {{-- no hape --}}
            <div class="block mt-2 min-[374px]:mt-4">
                <p class="poppins-medium text-[#535353] mb-1 min-[374px]:mb-2">no hp</p>
                <input type="text" name="no_hp" id="no_hpU" value="{{ old('no_hp') }}"
                    class="text-[#535353] outline-none w-full h-10 min-[374px]:h-11 md:h-14 border-[2px] border-[#DDDDDD] rounded-md pl-2">
            </div>

            {{-- Jumlah Uang Kembali --}}
            {{-- <div class="block mt-2 min-[374px]:mt-4">
                <p class="poppins-medium text-[#535353] mb-1 min-[374px]:mb-2">status Pegawai</p>
                <select name="" id=""
                    class="text-[#535353] outline-none w-full h-10 min-[374px]:h-11 md:h-14 border-[2px] border-[#DDDDDD] bg-white rounded-md pl-2">
                    <option value="" class="bg-white text-[#535353]">kasir</option>
                    <option value="" class="bg-white text-[#535353]">admin</option>
                    <option value="" class="bg-white text-[#535353]">supe admin</option>
                </select>
            </div> --}}

        </div>

        {{-- bottom --}}
        <div
            class="w-full h-10 min-[374px]:h-11 md:h-14 lg:text-[16px] md:text-[15px] text-[12px] poppins-semibold mt-5 min-[374px]:mt-9">
            <button type="button" id="btn_submitU"
                class="w-full h-full rounded-md bg-[#FFB015] hover:bg-[#ce8900] transition ease-in-out">update
                Data</button>
        </div>

    </div>
</form>
