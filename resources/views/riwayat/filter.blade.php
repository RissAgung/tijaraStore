{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal" class="z-[104] fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<div id="konten_modal"
    class="bg-white w-[330px] md:w-[540px] z-[105] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
    {{-- ? start header ? --}}
    {{-- <div class="flex flex-row justify-between">
        <div class="flex justify-start px-4 md:px-8 py-6">
            <p id="title_modal">Filter Date</p>
        </div>
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
            <div onclick="closeModal()" class="cursor-pointer">
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
        class="w-full flex-grow overflow-y-auto mt-4 md:mt-0 flex flex-col md:flex-row md:flex-wrap md:gap-4 px-4 md:px-8 py-4">
        {{-- ? Isinya --}}
        <div class="flex flex-col md:flex-row justify-start overflow-hidden w-full">
            <div
                class="flex drop-shadow-md z-[100]  w-full md:w-52 md:pr-8 md:border-r-[1px] border-b-[1px] md:border-b-0 md:pt-8">
                <li
                    class="flex flex-row md:ml-0 w-full scrollbar-hide pb-4 md:pb-0 overflow-y-hidden md:overflow-x-hidden md:flex-col justify-start md:justify-start md:mb-20 items-center poppins-regular">
                    <ul id="harian" onclick="clickTab('harian')"
                        class="px-2 transition duration-500 text-center cursor-pointer py-2 rounded-md w-28 text-primary">
                        Harian</ul>
                    <ul id="mingguan" onclick="clickTab('mingguan')"
                        class="px-2 transition duration-500 text-center hover:bg-gray-200 cursor-pointer py-2 rounded-md">
                        Mingguan</ul>
                    <ul id="bulanan" onclick="clickTab('bulanan')"
                        class="px-2 transition duration-500 text-center hover:bg-gray-200 cursor-pointer py-2 rounded-md">
                        Bulanan</ul>
                    <ul id="tahunan" onclick="clickTab('tahunan')"
                        class="px-2 transition duration-500 text-center hover:bg-gray-200 cursor-pointer py-2 rounded-md">
                        Tahunan</ul>
                    <ul id="range" onclick="clickTab('range')"
                        class="px-2 transition duration-500 text-center hover:bg-gray-200 cursor-pointer py-2 rounded-md">
                        Range</ul>
                </li>
            </div>
            <div id="container-date" class="h-full w-full flex flex-col justify-between">
                <div id="div-harian" class="items-center scale-100 w-full justify-center md:ml-4 mt-4 md:mt-0"></div>
                <div id="div-mingguan" class="hidden items-center scale-100 w-full justify-center md:ml-4 mt-4 md:mt-0">
                </div>
                <div id="div-bulanan" class="hidden pl-0 md:pl-8 gap-4 w-full flex-col mt-4 md:mt-8">
                    <div class="flex flex-col items-start w-full gap-2">
                        <h1 class="w-1/2 font-semibold text-sm text-start">Bulan</h1>
                        <div class="h-[50px] w-full border border-[#C9C9C9] rounded-lg overflow-hidden relative">
                            <svg class="absolute pointer-events-none top-[50%] -translate-y-[50%] -translate-x-[50%] right-0"
                                width="15" height="15" viewBox="0 0 22 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 18L0.607697 0L21.3923 0L11 18Z" fill="#DDDDDD" />
                            </svg>
                            <select id="filterbulanan_bulan"
                                class="h-full w-full outline-0 border-0 px-4 appearance-none">


                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">Aprill</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col items-start w-full gap-2">
                        <h1 class="w-1/2 font-semibold text-sm text-start">Tahun</h1>
                        <div class="h-[50px] w-full border border-[#C9C9C9] rounded-lg overflow-hidden relative">
                            <svg class="absolute pointer-events-none top-[50%] -translate-y-[50%] -translate-x-[50%] right-0"
                                width="15" height="15" viewBox="0 0 22 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 18L0.607697 0L21.3923 0L11 18Z" fill="#DDDDDD" />
                            </svg>
                            <?php $date = getdate(); ?>
                            <select id="filterbulanan_tahun"
                                class="h-full w-full outline-0 border-0 px-4 appearance-none">
                                <?php for ($i = ($date['year'] - 10); $i < ($date['year'] + 10); $i++) : ?>
                                <option <?php echo $i == $date['year'] ? 'selected' : ''; ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="div-tahunan" class="hidden pl-0 md:pl-8 gap-4 w-full flex-col mt-4 md:mt-8">
                    <div class="flex flex-col items-start w-full gap-2">
                        <h1 class="w-1/2 font-semibold text-sm text-start">Tahun</h1>
                        <div class="h-[50px] w-full border border-[#C9C9C9] rounded-lg overflow-hidden relative">
                            <svg class="absolute pointer-events-none top-[50%] -translate-y-[50%] -translate-x-[50%] right-0"
                                width="15" height="15" viewBox="0 0 22 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 18L0.607697 0L21.3923 0L11 18Z" fill="#DDDDDD" />
                            </svg>
                            <select id="filtertahunan_tahun"
                                class="h-full w-full outline-0 border-0 px-4 appearance-none">
                                <?php for ($i = ($date['year'] - 10); $i < ($date['year'] + 10); $i++) : ?>
                                <option <?php echo $i == $date['year'] ? 'selected' : ''; ?> value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="div-range" class="hidden pl-0 md:pl-8 gap-4 w-full flex-col mt-4 md:mt-8">
                    <div class="flex flex-col items-start w-full gap-2">
                        <h1 class="w-1/2 font-semibold text-sm text-start">From</h1>
                        <div class="h-[50px] w-full border border-[#C9C9C9] rounded-lg overflow-hidden">
                            <input type="date" name="daterange"
                                class="h-full w-full border-0 outline-none px-4"></input>
                        </div>
                    </div>
                    <div class="flex flex-col items-start w-full gap-2">
                        <h1 class="w-1/2 font-semibold text-sm text-start">To</h1>
                        <div class="h-[50px] w-full border border-[#C9C9C9] rounded-lg overflow-hidden">
                            <input type="date" name="daterange"
                                class="h-full w-full border-0 outline-none px-4"></input>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row justify-end gap-2 mt-8">
                    <div class="w-fit py-4">
                        <button type="button" onclick="closeModal()" id="btn_submit"
                            class="w-full bg-[#222222] flex justify-center py-4 rounded-md px-4">
                            <span id="button_submit" class="text-xs poppins-medium text-white">Cancel</span>
                        </button>
                    </div>
                    <div class="w-fit py-4">
                        <button type="button" id="btn_submit"
                            class="w-full bg-primary flex justify-center py-4 rounded-md px-4">
                            <span id="button_submit" class="text-xs poppins-medium">Set Filter</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ? end isi modal ? --}}
    {{-- ? start footer ? --}}

    {{-- ? end footer ? --}}
</div>
