{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal_data" class="fixed bg-black z-[105] w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}

<div id="konten_modal_data"
    class="bg-white w-[90%] max-w-[450px] z-[105] h-[70%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
    {{-- ? start header ? --}}
    <div class="flex flex-row justify-between">
        <div class="flex justify-start px-4 md:px-8 py-6">
            <p id="title_modal">Data Product</p>
        </div>
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
            <div onclick="closeModalData()">
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

        <div class="flex flex-row justify-start py-6 gap-4 relative">
            <p onclick="toggleTab('pria')" id="label-pria" class="cursor-pointer text-black">Pria</p>
            <p onclick="toggleTab('wanita')" id="label-wanita" class="cursor-pointer text-[#8F8F8F]">Wanita</p>
            <p onclick="toggleTab('anak')" id="label-anak" class="cursor-pointer text-[#8F8F8F]">Anak</p>
            <div id="selectedTabTag"
                class="h-[5px] bg-primary translate-x-0 w-[35px] absolute bottom-3 duration-300 ease-in-out transition origin-center over">
            </div>
        </div>

        <div class="flex-row w-full flex rounded-md px-4 py-2 gap-2 items-center border-2">
            <div class="h-8 mt-2">
                <svg width="22" height="22" viewBox="0 0 25 26" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.1157 19.7368C15.9968 19.7368 19.9537 15.8252 19.9537 11C19.9537 6.17477 15.9968 2.26315 11.1157 2.26315C6.23466 2.26315 2.27777 6.17477 2.27777 11C2.27777 15.8252 6.23466 19.7368 11.1157 19.7368Z"
                        fill="white" stroke="black" stroke-width="3" />
                    <path d="M17.3374 17.7682L23.0022 24.1682" stroke="black" stroke-width="3" />
                </svg>
            </div>


            <form id="form_search" class="w-full" action="#" method="GET">
                <input id="field_search" name="search" class=" py-2 px-2 w-full flex-grow outline-none" type="text"
                    placeholder="Nama product">
            </form>
        </div>

        <div class="flex w-full flex-col rounded-md px-4 h-[60%] overflow-y-auto py-4 items-center border-2 gap-1 mt-4 pb-8 mb-8"
            id="konten-data">

        </div>

        <div id="nodata" class="hidden justify-center px-8  overflow-y-auto py-4 items-center border-2 flex-grow w-full mb-8 rounded-md">
            <div class="flex flex-col items-center">
                <div class="h-full items-center w-full flex justify-center">
                    <img class="object-cover h-40 w-50" src="{{ asset('/assets/images/nodata.svg') }}"
                        alt="nodata">
                </div>
                <p class="text-2xl poppins-semibold">No Data</p>
            </div>
        </div>

    </div>

    {{-- ? end isi modal ? --}}
</div>
