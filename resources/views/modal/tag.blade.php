{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal_tag" class="z-[104] fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<div id="konten_modal_tag"
    class="bg-white w-[80%] max-w-[400px] md:w-[400px] z-[105] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
    {{-- ? start header ? --}}
    <div class="flex flex-row justify-between">
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-4 relative">
            <p onclick="toggleTab('tambah')" id="label-tambah" class="cursor-pointer">Tambah</p>
            <p onclick="toggleTab('data')" id="label-data" class="cursor-pointer text-[#8F8F8F]">Data</p>
            <div id="selectedTabTag"
                class="h-[5px] bg-primary translate-x-0 w-[70px] absolute bottom-3 duration-300 ease-in-out transition">
            </div>
        </div>
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
            <div onclick="closeModalTag()" class="cursor-pointer">
                <svg class="mt-1" width="15" height="15" viewBox="0 0 30 30" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.9879 14.9434L28.9811 5.94932C29.565 5.28631 29.8743 4.42604 29.8461 3.54338C29.8178 2.66072 29.4543 1.82192 28.8292 1.19747C28.2042 0.573017 27.3646 0.209785 26.4812 0.181604C25.5977 0.153424 24.7366 0.462409 24.073 1.04575L15.0705 10.0306L6.05184 1.01796C5.72881 0.695226 5.34531 0.439221 4.92325 0.264559C4.50119 0.0898973 4.04883 3.40055e-09 3.59199 0C3.13515 -3.40055e-09 2.68279 0.0898973 2.26073 0.264559C1.83867 0.439221 1.45517 0.695226 1.13214 1.01796C0.809105 1.34069 0.552862 1.72383 0.378038 2.1455C0.203214 2.56718 0.113234 3.01912 0.113234 3.47553C0.113234 3.93195 0.203214 4.38389 0.378038 4.80556C0.552862 5.22723 0.809105 5.61037 1.13214 5.9331L10.1531 14.9434L1.15996 23.9352C0.807262 24.2502 0.522599 24.6338 0.323385 25.0625C0.124171 25.4912 0.0145954 25.9559 0.00136119 26.4284C-0.0118731 26.9008 0.0715125 27.371 0.246417 27.8101C0.421321 28.2493 0.684066 28.6482 1.01858 28.9824C1.35309 29.3166 1.75233 29.5791 2.19188 29.7538C2.63143 29.9286 3.10204 30.0119 3.57493 29.9986C4.04781 29.9854 4.51303 29.8759 4.94211 29.6769C5.37119 29.4779 5.75511 29.1935 6.07039 28.8411L15.0705 19.8563L24.0614 28.8411C24.7138 29.4929 25.5986 29.8591 26.5212 29.8591C27.4439 29.8591 28.3287 29.4929 28.9811 28.8411C29.6335 28.1893 30 27.3053 30 26.3835C30 25.4618 29.6335 24.5778 28.9811 23.926L19.9879 14.9434Z"
                        fill="black" />
                </svg>
            </div>
        </div>

    </div>
    <div class="h-[2px] w-full bg-[#DDDDDD] mt-2"></div>
    {{-- ? end header ? --}}
    {{-- ? start isi modal ? --}}
    <div
        class="w-full flex-grow overflow-y-auto mt-4 md:mt-0 flex flex-col md:flex-row md:flex-wrap md:gap-4 md:pt-8 pb-8">
        {{-- ? Isinya --}}
        <form id="tambah-container" class="flex flex-col w-full px-4 md:px-8" action="/product/tag/add" method="post">
            @csrf
            <div>
                <div class="flex flex-col w-full">
                    <label for="field-tag">Nama Tag</label>
                    <input maxlength="20" id="field-tag" name="nama_tag" type="text" placeholder=""
                        class="border-2 rounded-md py-2 px-4 mt-1 outline-none w-full">
                </div>
                {{-- ? start footer ? --}}
                <div class="w-full mt-4">
                    <button type="button" id="btn_submit_tag"
                        class="w-full bg-[#FFB015] flex justify-center py-4 rounded-md">
                        <span id="button_submit" class="text-xs poppins-medium">Tambah Tag</span>
                    </button>
                </div>
                {{-- ? end footer ? --}}
            </div>
        </form>
        <div id="data-container" class="hidden w-full">
            <div class="flex flex-col max-h-[40vh] overflow-y-auto w-full gap-1 px-4 md:px-8">
                @foreach ($all_tags as $item)
                    <div
                        class="flex flex-row justify-between items-center hover:bg-slate-100 rounded-sm py-2 px-2 h-full">
                        <p class="poppins-semibold">{{ $item->nama_tag }}</p>
                        <div onclick="hapusTag('/product/tag/delete/{{ $item->kode_tag }}?token={{ csrf_token() }}')"
                            class="bg-[#000000] py-2 px-2 rounded-md flex justify-center drop-shadow-sm">
                            <svg width="10" height="13" viewBox="0 0 14 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3 2.8H11.13C10.9675 2.00999 10.5377 1.30014 9.91288 0.790103C9.28808 0.280063 8.50654 0.00101817 7.7 0L6.3 0C5.49346 0.00101817 4.71192 0.280063 4.08712 0.790103C3.46233 1.30014 3.03247 2.00999 2.87 2.8H0.7C0.514348 2.8 0.336301 2.87375 0.205025 3.00503C0.0737498 3.1363 0 3.31435 0 3.5C0 3.68565 0.0737498 3.8637 0.205025 3.99497C0.336301 4.12625 0.514348 4.2 0.7 4.2H1.4V13.3C1.40111 14.2279 1.77022 15.1175 2.42635 15.7736C3.08249 16.4298 3.97208 16.7989 4.9 16.8H9.1C10.0279 16.7989 10.9175 16.4298 11.5736 15.7736C12.2298 15.1175 12.5989 14.2279 12.6 13.3V4.2H13.3C13.4857 4.2 13.6637 4.12625 13.795 3.99497C13.9263 3.8637 14 3.68565 14 3.5C14 3.31435 13.9263 3.1363 13.795 3.00503C13.6637 2.87375 13.4857 2.8 13.3 2.8ZM6.3 1.4H7.7C8.13419 1.40053 8.55759 1.53536 8.91213 1.78601C9.26667 2.03666 9.53499 2.39084 9.6803 2.8H4.3197C4.46501 2.39084 4.73333 2.03666 5.08787 1.78601C5.44241 1.53536 5.86581 1.40053 6.3 1.4ZM11.2 13.3C11.2 13.857 10.9788 14.3911 10.5849 14.7849C10.1911 15.1788 9.65695 15.4 9.1 15.4H4.9C4.34305 15.4 3.8089 15.1788 3.41508 14.7849C3.02125 14.3911 2.8 13.857 2.8 13.3V4.2H11.2V13.3Z"
                                    fill="white" />
                                <path
                                    d="M5.60002 12.6C5.78568 12.6 5.96372 12.5262 6.095 12.395C6.22627 12.2637 6.30002 12.0856 6.30002 11.9V7.69999C6.30002 7.51434 6.22627 7.33629 6.095 7.20502C5.96372 7.07374 5.78568 6.99999 5.60002 6.99999C5.41437 6.99999 5.23633 7.07374 5.10505 7.20502C4.97377 7.33629 4.90002 7.51434 4.90002 7.69999V11.9C4.90002 12.0856 4.97377 12.2637 5.10505 12.395C5.23633 12.5262 5.41437 12.6 5.60002 12.6Z"
                                    fill="white" />
                                <path
                                    d="M8.40001 12.6C8.58566 12.6 8.76371 12.5262 8.89499 12.395C9.02626 12.2637 9.10001 12.0856 9.10001 11.9V7.69999C9.10001 7.51434 9.02626 7.33629 8.89499 7.20502C8.76371 7.07374 8.58566 6.99999 8.40001 6.99999C8.21436 6.99999 8.03631 7.07374 7.90504 7.20502C7.77376 7.33629 7.70001 7.51434 7.70001 7.69999V11.9C7.70001 12.0856 7.77376 12.2637 7.90504 12.395C8.03631 12.5262 8.21436 12.6 8.40001 12.6Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ? end isi modal ? --}}

</div>
