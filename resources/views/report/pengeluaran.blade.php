@extends('layout.main')

@section('title_page')
    LP Pengeluaran
@endsection

@section('modal')
    @include('modal.detail_laporan_pengeluaran')
    @include('modal.filterDate.filter')
@endsection

@section('title')
    Laporan Pemasukan
@endsection

@section('content')
    {{-- loading --}}
    <div id="loading"
        class="fixed w-full h-full top-0 left-0 flex flex-col justify-center items-center bg-slate-50 z-[99999]">
        <div class="loadingspinner"></div>
    </div>

    {{-- container --}}
    <div class="flex flex-col w-full h-full lg:h-[85vh] xl:h-[88vh]">

        {{-- top --}}
        <div
            class="flex justify-between items-center relative w-full px-5 md:px-[30px] gap-4 h-11 min-[360px]:h-14 md:h-16 2xl:h-24 bg-white text-[12px] md:text-[15px] border-b-[1px] border-b-[#DCDADA]">

            {{-- left --}}

            {{-- menu --}}
            <div id="menuLaporan" class="md:hidden poppins-medium cursor-pointer flex h-full items-center gap-2">
                <p class="text-selector-none">Pengeluaran</p>
                <div id="arrowMenu" class="rotate-180 transition ease-in-out delay-75">

                    <svg class="w-[11px] h-[5px]" viewBox="0 0 59 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M29.5 0.499999C30.1936 0.499999 30.8646 0.610691 31.5131 0.832065C32.1651 1.05344 32.7078 1.3486 33.1413 1.71756L57.0695 22.084C58.0232 22.8957 58.5 23.9288 58.5 25.1832C58.5 26.4377 58.0232 27.4707 57.0695 28.2824C56.1158 29.0941 54.9021 29.5 53.4283 29.5C51.9544 29.5 50.7407 29.0941 49.787 28.2824L29.5 11.0153L9.21301 28.2824C8.25935 29.0941 7.04559 29.5 5.57175 29.5C4.09791 29.5 2.88417 29.0941 1.93051 28.2824C0.976843 27.4707 0.500002 26.4377 0.500002 25.1832C0.500002 23.9288 0.976843 22.8957 1.93051 22.084L25.8587 1.71756C26.3789 1.27481 26.9425 0.961936 27.5493 0.778934C28.1562 0.59298 28.8064 0.499999 29.5 0.499999Z"
                            fill="black" />
                    </svg>
                </div>
            </div>

            {{-- dropdown --}}
            <div id="menuDropDown"
                class=" max-md:shadow-md text-selector-none flex flex-col md:flex-row md:items-end max-md:hidden max-md:absolute gap-2 min-[360px]:gap-3 md:gap-5 poppins-medium text-[#2c2c2c] p-2 min-[360px]:p-3 md:p-0 w-24 min-[360px]:w-32 md:w-auto rounded-sm min-[360px]:rounded-[5px] bg-white top-8 min-[360px]:top-10 max-md:border-[1px] max-md:border-[#DCDADA] md:h-full">
                <a id="menu_pemasukan1" href="{{ route('pemasukan') }}"
                    class="hover:text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Pemasukan</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px]">
                    </div>
                </a>
                <a id="menu_pemasukan2" href="{{ route('pengeluaran') }}"
                    class="text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Pengeluaran</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px] transition ease-in-out bg-[#FFB015]">
                    </div>
                </a>
                <a id="menu_pemasukan3" href="{{ route('akumulasi') }}"
                    class="hover:text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Akumulasi</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px] transition ease-in-out">
                    </div>
                </a>
            </div>

            {{-- end left --}}

            {{-- right --}}
            <div class="flex poppins-medium gap-2">

                {{-- export --}}
                <a href="/laporan/pengeluaran.export/{{ Request::segment(3) !== null ? Request::segment(3) : '' }}"
                    class="text-selector-none flex items-center gap-2 py-2 px-3 md:py-2 md:px-3 rounded-md shadow-lg bg-black hover:bg-[#2b2b2b] transition ease-in-out">
                    <p class="text-white max-md:hidden">export</p>
                    <svg class="mt-[1px]" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 2C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2M13 3.5L18.5 9H13M8.93 12.22H16V19.29L13.88 17.17L11.05 20L8.22 17.17L11.05 14.35"
                            fill="white" />
                    </svg>
                </a>

                {{-- filter --}}
                <button onclick="showModalFilter()"
                    class="text-selector-none flex items-center gap-2 py-2 px-3 md:py-2 md:px-3 rounded-md shadow-lg bg-[#FFB015] hover:bg-[#d48e00] transition ease-in-out">
                    <p>Filter</p>
                    <svg class="w-[17px] h-[15px] md:w-[20px] md:h-[18px]" viewBox="0 0 24 26" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <mask id="path-1-outside-1_233_13" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="26" fill="black">
                            <rect fill="white" width="24" height="26" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.4017 24.8C13.5748 24.9298 13.7854 25 14.0019 25C14.2672 25 14.5216 24.8946 14.7092 24.7071C14.8968 24.5196 15.0022 24.2652 15.0022 24V15.38L22.0174 7.488C22.516 6.9261 22.8417 6.23222 22.9553 5.48975C23.0689 4.74727 22.9657 3.9878 22.6579 3.30259C22.3502 2.61737 21.851 2.03557 21.2205 1.62711C20.59 1.21864 19.8549 1.00088 19.1035 1H4.89897C4.14755 1.00047 3.41226 1.21787 2.78147 1.62607C2.15068 2.03426 1.65123 2.61588 1.34315 3.30101C1.03507 3.98615 0.931478 4.74565 1.04481 5.48823C1.15815 6.23082 1.48359 6.92488 1.98203 7.487L9.00028 15.38V21C9.00028 21.1552 9.03643 21.3084 9.10588 21.4472C9.17533 21.5861 9.27617 21.7069 9.4004 21.8L13.4017 24.8ZM13.0016 22L11.0009 20.5V15C11.001 14.7553 10.9113 14.519 10.7488 14.336L3.47751 6.158C3.2354 5.88405 3.07748 5.5461 3.02269 5.18468C2.9679 4.82326 3.01857 4.45371 3.16862 4.12035C3.31867 3.78699 3.56173 3.50399 3.86864 3.30527C4.17556 3.10655 4.5333 3.00055 4.89897 3H19.1035C19.4694 3.00038 19.8273 3.10632 20.1344 3.30509C20.4415 3.50386 20.6847 3.78701 20.8348 4.12056C20.9849 4.4541 21.0355 4.82387 20.9805 5.18545C20.9256 5.54704 20.7674 5.88508 20.525 6.159L13.2546 14.336C13.0918 14.5189 13.0018 14.7552 13.0016 15V22Z" />
                        </mask>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M13.4017 24.8C13.5748 24.9298 13.7854 25 14.0019 25C14.2672 25 14.5216 24.8946 14.7092 24.7071C14.8968 24.5196 15.0022 24.2652 15.0022 24V15.38L22.0174 7.488C22.516 6.9261 22.8417 6.23222 22.9553 5.48975C23.0689 4.74727 22.9657 3.9878 22.6579 3.30259C22.3502 2.61737 21.851 2.03557 21.2205 1.62711C20.59 1.21864 19.8549 1.00088 19.1035 1H4.89897C4.14755 1.00047 3.41226 1.21787 2.78147 1.62607C2.15068 2.03426 1.65123 2.61588 1.34315 3.30101C1.03507 3.98615 0.931478 4.74565 1.04481 5.48823C1.15815 6.23082 1.48359 6.92488 1.98203 7.487L9.00028 15.38V21C9.00028 21.1552 9.03643 21.3084 9.10588 21.4472C9.17533 21.5861 9.27617 21.7069 9.4004 21.8L13.4017 24.8ZM13.0016 22L11.0009 20.5V15C11.001 14.7553 10.9113 14.519 10.7488 14.336L3.47751 6.158C3.2354 5.88405 3.07748 5.5461 3.02269 5.18468C2.9679 4.82326 3.01857 4.45371 3.16862 4.12035C3.31867 3.78699 3.56173 3.50399 3.86864 3.30527C4.17556 3.10655 4.5333 3.00055 4.89897 3H19.1035C19.4694 3.00038 19.8273 3.10632 20.1344 3.30509C20.4415 3.50386 20.6847 3.78701 20.8348 4.12056C20.9849 4.4541 21.0355 4.82387 20.9805 5.18545C20.9256 5.54704 20.7674 5.88508 20.525 6.159L13.2546 14.336C13.0918 14.5189 13.0018 14.7552 13.0016 15V22Z"
                            fill="black" />
                        <path
                            d="M13.4017 24.8L13.5816 24.56L13.5816 24.56L13.4017 24.8ZM15.0022 15.38L14.778 15.1807L14.7022 15.2659V15.38H15.0022ZM22.0174 7.488L22.2417 7.68731L22.2418 7.68711L22.0174 7.488ZM22.9553 5.48975L22.6588 5.44437L22.6588 5.44437L22.9553 5.48975ZM22.6579 3.30259L22.9316 3.17968L22.9316 3.17967L22.6579 3.30259ZM21.2205 1.62711L21.3836 1.37532L21.3836 1.37532L21.2205 1.62711ZM19.1035 1L19.1039 0.7H19.1035V1ZM4.89897 1L4.89897 0.7L4.89878 0.7L4.89897 1ZM2.78147 1.62607L2.94445 1.87793L2.94445 1.87793L2.78147 1.62607ZM1.34315 3.30101L1.61676 3.42405L1.61676 3.42405L1.34315 3.30101ZM1.04481 5.48823L1.34138 5.44297L1.34138 5.44297L1.04481 5.48823ZM1.98203 7.487L1.75757 7.68604L1.75784 7.68634L1.98203 7.487ZM9.00028 15.38H9.30028V15.2659L9.22447 15.1807L9.00028 15.38ZM9.10588 21.4472L9.3742 21.313L9.3742 21.313L9.10588 21.4472ZM9.4004 21.8L9.22044 22.04L9.22044 22.04L9.4004 21.8ZM11.0009 20.5H10.7009V20.65L10.821 20.74L11.0009 20.5ZM13.0016 22L12.8216 22.24L13.3016 22.5999V22H13.0016ZM11.0009 15L10.7009 14.9999V15H11.0009ZM10.7488 14.336L10.9732 14.1369L10.973 14.1367L10.7488 14.336ZM3.47751 6.158L3.25272 6.35667L3.25332 6.35734L3.47751 6.158ZM3.02269 5.18468L2.72608 5.22964L2.72608 5.22964L3.02269 5.18468ZM4.89897 3L4.89897 2.7L4.89851 2.7L4.89897 3ZM19.1035 3L19.1038 2.7H19.1035V3ZM20.1344 3.30509L20.2974 3.05324L20.2974 3.05324L20.1344 3.30509ZM20.9805 5.18545L20.684 5.14037L20.684 5.14037L20.9805 5.18545ZM20.525 6.159L20.7492 6.35834L20.7496 6.35783L20.525 6.159ZM13.2546 14.336L13.4787 14.5355L13.4788 14.5353L13.2546 14.336ZM13.0016 15L12.7016 14.9998V15H13.0016ZM14.0019 24.7C13.8503 24.7 13.7029 24.6509 13.5816 24.56L13.2217 25.04C13.4468 25.2088 13.7205 25.3 14.0019 25.3V24.7ZM14.4971 24.4949C14.3658 24.6262 14.1876 24.7 14.0019 24.7V25.3C14.3467 25.3 14.6774 25.1631 14.9213 24.9193L14.4971 24.4949ZM14.7022 24C14.7022 24.1856 14.6284 24.3637 14.4971 24.4949L14.9213 24.9193C15.1652 24.6755 15.3022 24.3448 15.3022 24H14.7022ZM14.7022 15.38V24H15.3022V15.38H14.7022ZM21.7932 7.28869L14.778 15.1807L15.2264 15.5793L22.2417 7.68731L21.7932 7.28869ZM22.6588 5.44437C22.5539 6.12971 22.2533 6.7702 21.793 7.28889L22.2418 7.68711C22.7788 7.08199 23.1295 6.33473 23.2519 5.53513L22.6588 5.44437ZM22.3843 3.4255C22.6683 4.05799 22.7636 4.75903 22.6588 5.44437L23.2519 5.53513C23.3742 4.73552 23.263 3.91761 22.9316 3.17968L22.3843 3.4255ZM21.0574 1.87889C21.6394 2.25595 22.1002 2.793 22.3843 3.4255L22.9316 3.17967C22.6002 2.44174 22.0626 1.8152 21.3836 1.37532L21.0574 1.87889ZM19.1032 1.3C19.7967 1.30081 20.4753 1.50183 21.0574 1.87889L21.3836 1.37532C20.7046 0.935446 19.913 0.700949 19.1039 0.7L19.1032 1.3ZM4.89897 1.3H19.1035V0.7H4.89897V1.3ZM2.94445 1.87793C3.52674 1.50113 4.2055 1.30044 4.89916 1.3L4.89878 0.7C4.0896 0.700511 3.29778 0.93462 2.61848 1.3742L2.94445 1.87793ZM1.61676 3.42405C1.90114 2.79162 2.36217 2.25474 2.94445 1.87793L2.61848 1.3742C1.93919 1.81378 1.40132 2.44013 1.06954 3.17798L1.61676 3.42405ZM1.34138 5.44297C1.23677 4.75753 1.33239 4.05647 1.61676 3.42405L1.06954 3.17798C0.737761 3.91583 0.626191 4.73377 0.748248 5.5335L1.34138 5.44297ZM2.2065 7.28796C1.7464 6.76908 1.44599 6.12841 1.34138 5.44297L0.748248 5.5335C0.870305 6.33322 1.22079 7.08068 1.75757 7.68604L2.2065 7.28796ZM9.22447 15.1807L2.20622 7.28766L1.75784 7.68634L8.77609 15.5793L9.22447 15.1807ZM9.30028 21V15.38H8.70028V21H9.30028ZM9.3742 21.313C9.32558 21.2158 9.30028 21.1087 9.30028 21H8.70028C8.70028 21.2018 8.74728 21.4009 8.83757 21.5814L9.3742 21.313ZM9.58037 21.56C9.49339 21.4948 9.42281 21.4102 9.3742 21.313L8.83757 21.5814C8.92786 21.7619 9.05895 21.9189 9.22044 22.04L9.58037 21.56ZM13.5816 24.56L9.58037 21.56L9.22044 22.04L13.2217 25.04L13.5816 24.56ZM10.821 20.74L12.8216 22.24L13.1815 21.76L11.1809 20.26L10.821 20.74ZM10.7009 15V20.5H11.3009V15H10.7009ZM10.5245 14.5351C10.6382 14.6633 10.701 14.8286 10.7009 14.9999L11.3009 15.0001C11.301 14.6819 11.1844 14.3748 10.9732 14.1369L10.5245 14.5351ZM3.25332 6.35734L10.5246 14.5353L10.973 14.1367L3.70171 5.95866L3.25332 6.35734ZM2.72608 5.22964C2.78952 5.64815 2.97239 6.03947 3.25272 6.35667L3.7023 5.95933C3.49842 5.72864 3.36544 5.44405 3.3193 5.13972L2.72608 5.22964ZM2.89506 3.99722C2.72131 4.38322 2.66264 4.81114 2.72608 5.22964L3.3193 5.13972C3.27317 4.83538 3.31583 4.5242 3.44219 4.24349L2.89506 3.99722ZM3.70559 3.05344C3.35023 3.28353 3.0688 3.61121 2.89506 3.99722L3.44219 4.24349C3.56854 3.96277 3.77322 3.72444 4.03169 3.55709L3.70559 3.05344ZM4.89851 2.7C4.47515 2.70064 4.06095 2.82336 3.70559 3.05344L4.03169 3.55709C4.29016 3.38973 4.59145 3.30047 4.89942 3.3L4.89851 2.7ZM19.1035 2.7H4.89897V3.3H19.1035V2.7ZM20.2974 3.05324C19.9419 2.8231 19.5274 2.70044 19.1038 2.7L19.1032 3.3C19.4113 3.30032 19.7128 3.38954 19.9714 3.55694L20.2974 3.05324ZM21.1084 3.99745C20.9346 3.61123 20.653 3.28338 20.2974 3.05324L19.9714 3.55694C20.2301 3.72434 20.4349 3.96279 20.5613 4.24366L21.1084 3.99745ZM21.2771 5.23054C21.3408 4.81184 21.2822 4.38368 21.1084 3.99745L20.5613 4.24366C20.6876 4.52453 20.7302 4.83589 20.684 5.14037L21.2771 5.23054ZM20.7496 6.35783C21.0303 6.04066 21.2135 5.64924 21.2771 5.23054L20.684 5.14037C20.6377 5.44484 20.5045 5.7295 20.3003 5.96017L20.7496 6.35783ZM13.4788 14.5353L20.7492 6.35834L20.3008 5.95966L13.0304 14.1367L13.4788 14.5353ZM13.3016 15.0002C13.3017 14.8289 13.3647 14.6635 13.4787 14.5355L13.0306 14.1365C12.8189 14.3743 12.7018 14.6814 12.7016 14.9998L13.3016 15.0002ZM13.3016 22V15H12.7016V22H13.3016Z"
                            fill="black" mask="url(#path-1-outside-1_233_13)" />
                    </svg>
                </button>

                {{-- reset --}}
                <a href="{{ url('laporan/pengeluaran') }}"
                    class="flex items-center py-2 px-[10px] md:py-2 md:px-3 gap-2 rounded-md shadow-lg bg-black hover:bg-[#3b3b3b] transition ease-in-out">

                    <svg class="w-[15px] h-[15px] md:w-[18px] md:h-[18px]" viewBox="0 0 25 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.2806 7.10146C4.55729 4.89805 6.59124 3.23371 9.00372 2.41833C11.4162 1.60295 14.0428 1.6921 16.3945 2.66919C18.7461 3.64628 20.6625 5.44471 21.7869 7.72962C22.9112 10.0145 23.1669 12.6302 22.5062 15.0895C21.8455 17.5489 20.3136 19.6844 18.1957 21.0983C16.0777 22.5122 13.5181 23.1083 10.9934 22.7754C8.46866 22.4426 6.15095 21.2036 4.47178 19.2891C2.79262 17.3746 1.86645 14.9151 1.86572 12.3685"
                            stroke="white" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.42822 7.11852L3.17822 7.11852L3.17822 1.86853" stroke="white" stroke-width="2.3"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                </a>
            </div>

        </div>

        {{-- content --}}
        <div class="flex flex-col lg:flex-row w-full lg:h-full p-2 md:p-5 gap-2 md:gap-5">

            {{-- left --}}
            <div
                class="flex flex-col w-full lg:w-[65%] h-80 md:h-96 lg:min-h-full bg-white border-[1px] border-[#DCDADA] rounded-md">
                <p id="title_table" class="sticky top-0 p-4 md:p-6 2xl:p-9 text-[12px] md:text-[14px] 2xl:text-[17px]">Data
                    Pengeluaran
                    {{ $titleFilter }}</p>
                <div class="w-full h-full overflow-y-auto">
                    <table class="w-full text-[11px] md:text-[14px]">
                        <thead class="bg-[#F7F7F7] sticky top-0">
                            <tr>
                                <th class="border-y-[1px] border-[#DADADA] p-5">Tanggal</th>
                                <th class="border-[1px] border-[#DADADA] p-5">Transaksi Pengeluaran</th>
                                <th class="border-[1px] border-[#DADADA] p-5">Retur Customer</th>
                                <th class="border-[1px] border-[#DADADA] p-5">Total</th>
                                <th class="border-y-[1px] border-[#DADADA] p-5">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($data as $index)
                                <tr id="row_table_{{ $i }}" class="hover:bg-[#e9e9e9] transition ease-in-out">
                                    <td class="text-center border-y-[1px] border-[#DADADA] p-3 md:p-4">
                                        {{ $index['tanggal'] }}
                                    </td>
                                    <td class="text-center border-y-[1px] border-[#DADADA] p-3 md:p-4">
                                        {{ rupiah((int) $index['transaksi']) }}</td>
                                    <td class="text-center border-y-[1px] border-[#DADADA] p-3 md:p-4">
                                        {{ rupiah((int) $index['retur_cs']) }}</td>
                                    <td class="text-center border-y-[1px] border-[#DADADA] p-3 md:p-4">
                                        {{ rupiah((int) $index['transaksi'] + (int) $index['retur_cs']) }}
                                    </td>
                                    <td class="text-center border-y-[1px] border-[#DADADA] p-3 md:p-4">
                                        <svg onclick="pilih_data('{{ $i }}', '{{ $index['tanggal'] }}', '{{ url('laporan/getDetailPengeluaran') }}')"
                                            class="cursor-pointer w-[30px] h-[30px] md:w-[50px] md:h-[50px] lg:w-[40px] lg:h-[40px] m-auto"
                                            viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_653_130)">
                                                <rect x="2" y="4" width="46" height="46"
                                                    rx="6" fill="#FFB015" />
                                            </g>
                                            <path
                                                d="M28.875 24.75C25.4975 24.75 22.75 27.4975 22.75 30.875C22.75 34.2525 25.4975 37 28.875 37C32.2525 37 35 34.2525 35 30.875C35 27.4975 32.2525 24.75 28.875 24.75ZM28.875 35.25C26.46 35.25 24.5 33.29 24.5 30.875C24.5 28.46 26.46 26.5 28.875 26.5C31.29 26.5 33.25 28.46 33.25 30.875C33.25 33.29 31.29 35.25 28.875 35.25ZM30.1875 28.6875C30.1875 29.4137 29.6012 30 28.875 30C28.1488 30 27.5625 29.4137 27.5625 28.6875C27.5625 27.9613 28.1488 27.375 28.875 27.375C29.6012 27.375 30.1875 27.9613 30.1875 28.6875ZM29.75 31.75V33.5C29.75 33.9813 29.3562 34.375 28.875 34.375C28.3938 34.375 28 33.9813 28 33.5V31.75C28 31.2688 28.3938 30.875 28.875 30.875C29.3562 30.875 29.75 31.2688 29.75 31.75ZM21.875 34.375C21.875 34.8563 21.4812 35.25 21 35.25H18.375C15.96 35.25 14 33.29 14 30.875V20.375C14 17.96 15.96 16 18.375 16H23.415C24.3337 16 25.235 16.3762 25.8913 17.0237L28.7262 19.8587C29.3125 20.445 29.6712 21.2237 29.7413 22.0462C29.7762 22.5275 29.4175 22.9475 28.9362 22.9913C28.91 22.9913 28.8925 22.9913 28.8663 22.9913C28.4113 22.9913 28.035 22.6413 27.9913 22.1863C27.9913 22.16 27.9913 22.1425 27.9913 22.1163H25.3837C24.4213 22.1163 23.6337 21.3287 23.6337 20.3663V17.7675C23.5638 17.7675 23.4938 17.75 23.4237 17.75H18.375C16.9313 17.75 15.75 18.9313 15.75 20.375V30.875C15.75 32.3188 16.9313 33.5 18.375 33.5H21C21.4812 33.5 21.875 33.8937 21.875 34.375Z"
                                                fill="black" />
                                            <defs>
                                                <filter id="filter0_d_653_130" x="0" y="0"
                                                    width="54" height="54" filterUnits="userSpaceOnUse"
                                                    color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                                    <feColorMatrix in="SourceAlpha" type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                                                        result="hardAlpha" />
                                                    <feOffset dx="2" />
                                                    <feGaussianBlur stdDeviation="2" />
                                                    <feComposite in2="hardAlpha" operator="out" />
                                                    <feColorMatrix type="matrix"
                                                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.22 0" />
                                                    <feBlend mode="normal" in2="BackgroundImageFix"
                                                        result="effect1_dropShadow_653_130" />
                                                    <feBlend mode="normal" in="SourceGraphic"
                                                        in2="effect1_dropShadow_653_130" result="shape" />
                                                </filter>
                                            </defs>
                                        </svg>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- right --}}
            <div
                class="flex flex-col w-full lg:w-[35%] lg:min-h-full lg:justify-between bg-white border-[1px] border-[#DCDADA] rounded-md">
                <p class="p-4 md:p-6 2xl:p-9 text-[12px] md:text-[15px] 2xl:text-[17px] border-b-[1px] border-b-[#DCDADA]">
                    Detail Pemasukan {{ $titleFilter }}</p>
                <div class="flex flex-col px-4 md:px-7 2xl:px-12 h-full justify-evenly">

                    {{-- restock --}}
                    <div onclick="showDetail('restock')"
                        class="transition ease-in-out hover:bg-slate-50 flex w-full cursor-pointer justify-between py-4 2xl:h-[30%] items-center">
                        <div class="flex gap-5">

                            <svg class="w-[51px] h-[51px] md:w-[70px] md:h-[70px] lg:w-[50px] lg:h-[50px] xl:w-[60px] xl:h-[60px] 2xl:w-[80px] 2xl:h-[80px]"
                                viewBox="0 0 105 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="104.765" height="110.893" rx="14" fill="#41C19E" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M104.765 73.0592V96.893C104.765 104.625 98.4973 110.893 90.7653 110.893H63.302L37 86L48.5 52L51 30V24.5L52.5 22L104.765 73.0592Z"
                                    fill="#49A289" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M53.0338 27.8293C54.199 27.4175 55.0338 26.3062 55.0338 25C55.0338 23.3431 53.6907 22 52.0338 22C50.377 22 49.0338 23.3431 49.0338 25C49.0338 26.3062 49.8686 27.4175 51.0338 27.8293V33H53.0338V27.8293Z"
                                    fill="#D9D9D9" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M49.5334 31H49.0338C47.5338 32.8333 43.0338 37.1 37.0338 39.5C37.0338 42.6667 37.8338 50.4 41.0338 56C41.5338 57.8333 41.8338 62.4 39.0338 66C36.2338 69.6 35.8671 77.5 36.0338 81C36.2005 82.5 36.8338 85.9 38.0338 87.5H47.0338H57.0338H66.0304C67.2302 85.9 67.8634 82.5 68.03 81C68.1967 77.5 67.8301 69.6 65.0306 66C62.2311 62.4 62.531 57.8333 63.031 56C66.2304 50.4 67.0302 42.6667 67.0302 39.5C61.0313 37.1 56.5321 32.8333 55.0324 31H54.5338H49.5334Z"
                                    fill="#64798A" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M67.8897 82H36.1742C36.4532 83.6923 37.055 86.1949 38.0338 87.5H47.0339H57.0338H66.0304C67.009 86.1949 67.6107 83.6923 67.8897 82Z"
                                    fill="#354A5D" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M61.3565 36.4848C59.342 39.8152 56.2812 43.2323 52.5339 43.5C47.1582 43.8839 44.4242 38.7698 43.624 35.8531C42.8718 36.39 42.0603 36.9245 41.1963 37.4367L41.5339 37.5C41.6885 37.7706 41.8461 38.0532 42.0084 38.344C43.9444 41.8146 46.5364 46.4613 52.5339 46C57.7339 45.6 61.7005 40.5 63.0339 38L63.2476 37.658C62.5873 37.2784 61.9559 36.8844 61.3565 36.4848Z"
                                    fill="#E7BD69" />
                            </svg>

                            <div
                                class="flex flex-col h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px] text-[11px] md:text-[14px] 2xl:text-[16px] justify-center gap-2">
                                <p>Re-Stock</p>
                                <p id="total_restock" class="poppins-semibold"></p>
                            </div>
                        </div>

                        <div class="flex items-center h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px]">
                            <svg class="w-[8px] h-[14px]" viewBox="0 0 16 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.2721 13.97C15.2721 14.2813 15.215 14.5824 15.1008 14.8734C14.9865 15.1659 14.8342 15.4094 14.6438 15.604L4.13297 26.3411C3.71406 26.769 3.1809 26.983 2.5335 26.983C1.88609 26.983 1.35294 26.769 0.934026 26.3411C0.515118 25.9132 0.305664 25.3685 0.305664 24.7072C0.305664 24.0458 0.515118 23.5012 0.934026 23.0733L9.84536 13.97L0.934026 4.86681C0.515118 4.43888 0.305664 3.89424 0.305664 3.2329C0.305664 2.57155 0.515118 2.02692 0.934026 1.59899C1.35294 1.17106 1.88609 0.957087 2.5335 0.957087C3.1809 0.957087 3.71406 1.17106 4.13297 1.59899L14.6438 12.3361C14.8723 12.5695 15.0337 12.8224 15.1282 13.0947C15.2241 13.3671 15.2721 13.6588 15.2721 13.97Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>

                    {{-- line --}}
                    <div class="w-full h-[1px] bg-[#DCDADA]"></div>

                    {{-- operasional --}}
                    <div onclick="showDetail('operasional')"
                        class="transition ease-in-out hover:bg-slate-50 flex w-full cursor-pointer justify-between py-4 2xl:h-[30%] items-center">
                        <div class="flex gap-5">

                            <svg class="w-[51px] h-[51px] md:w-[70px] md:h-[70px] lg:w-[50px] lg:h-[50px] xl:w-[60px] xl:h-[60px] 2xl:w-[80px] 2xl:h-[80px]"
                                viewBox="0 0 105 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="104.765" height="110.893" rx="14" fill="#64798A" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M104.765 50.4658V96.893C104.765 104.625 98.4973 110.893 90.7653 110.893H66.0288L27 86.5L46.5 60.5L64 34L72.5 31L104.765 50.4658Z"
                                    fill="#465765" />
                                <path
                                    d="M54.1521 57.9646V31.0736H68.8132L74.044 32.9891V52.439L70.8024 64.8899L54.1521 57.9646Z"
                                    fill="#00ACEA" />
                                <path d="M59.3093 40.5775L54.1521 31.0736H72.9389L78.1698 40.5775H59.3093Z"
                                    fill="#FF9A00" />
                                <path d="M54.1521 57.9495V31H39.491L34.2602 32.9197V56.4175L37.5018 64.89L54.1521 57.9495Z"
                                    fill="#7FC8F1" />
                                <path d="M48.9949 40.5776L54.1521 31H35.3653L30.1344 40.5776H48.9949Z" fill="#FFB74F" />
                                <path
                                    d="M72.9392 53.4706C68.7643 56.1966 60.3557 61.6484 60.1199 61.6484L31.0924 63.785L38.3124 77.7093H64.172L79.0541 67.0266L89.0001 50.7447C82.2221 46.2064 75.4686 50.671 72.9392 53.4706Z"
                                    fill="#FFB74F" />
                                <path
                                    d="M29.9134 59.8064C28.8329 60.887 26.6423 63.1218 26.5244 63.4165L31.0185 65.332H62.1089C63.214 64.8408 65.4242 63.2249 65.4242 60.6905C65.4242 58.1561 63.214 57.0805 62.1089 56.8595H51.7945C49.378 53.5589 43.8623 53.1758 41.4065 53.3968C35.3947 53.4558 31.2395 57.6945 29.9134 59.8064Z"
                                    fill="#FFDBA9" />
                                <path d="M27.335 55.2388L14 62.4588L27.335 87.7289L40.8173 80.4352L27.335 55.2388Z"
                                    fill="#FF9577" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M34.2402 68.1434L20.875 75.4869L27.335 87.7289L40.8174 80.4352L34.2402 68.1434Z"
                                    fill="#FF633E" />
                            </svg>

                            <div
                                class="flex flex-col h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px] text-[11px] md:text-[14px] 2xl:text-[16px] justify-center gap-2">
                                <p>Operasional</p>
                                <p id="total_operasional" class="poppins-semibold"></p>
                            </div>
                        </div>

                        <div class="flex items-center h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px]">
                            <svg class="w-[8px] h-[14px]" viewBox="0 0 16 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.2721 13.97C15.2721 14.2813 15.215 14.5824 15.1008 14.8734C14.9865 15.1659 14.8342 15.4094 14.6438 15.604L4.13297 26.3411C3.71406 26.769 3.1809 26.983 2.5335 26.983C1.88609 26.983 1.35294 26.769 0.934026 26.3411C0.515118 25.9132 0.305664 25.3685 0.305664 24.7072C0.305664 24.0458 0.515118 23.5012 0.934026 23.0733L9.84536 13.97L0.934026 4.86681C0.515118 4.43888 0.305664 3.89424 0.305664 3.2329C0.305664 2.57155 0.515118 2.02692 0.934026 1.59899C1.35294 1.17106 1.88609 0.957087 2.5335 0.957087C3.1809 0.957087 3.71406 1.17106 4.13297 1.59899L14.6438 12.3361C14.8723 12.5695 15.0337 12.8224 15.1282 13.0947C15.2241 13.3671 15.2721 13.6588 15.2721 13.97Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>

                    {{-- line --}}
                    <div class="w-full h-[1px] bg-[#DCDADA]"></div>

                    {{-- retur --}}
                    <div onclick="showDetail('retur')"
                        class="transition ease-in-out hover:bg-slate-50 flex w-full cursor-pointer justify-between py-4 2xl:h-[30%] items-center">
                        <div class="flex gap-5">
                            <svg class="w-[51px] h-[51px] md:w-[70px] md:h-[70px] lg:w-[50px] lg:h-[50px] xl:w-[60px] xl:h-[60px] 2xl:w-[80px] 2xl:h-[80px]"
                                viewBox="0 0 105 112" fill="none" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect y="0.149902" width="104.765" height="110.893" rx="14" fill="#C2BF61" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M104.765 58.6577V97.0429C104.765 104.775 98.4973 111.043 90.7653 111.043H52.6525L18.5 80.5L67.5 31.5L85 37L104.765 58.6577Z"
                                    fill="#757347" />
                                <path d="M86.0003 69.6708L57.617 86.0108L28.9082 69.6708V36.4702H86.0003V69.6708Z"
                                    fill="#0F7C79" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M43.9068 78.2078L28.9072 69.6706V51.4595C38.5038 51.8686 46.1584 59.778 46.1584 69.4753C46.1584 72.6434 45.3415 75.6206 43.9068 78.2078Z"
                                    fill="#0C5D57" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M57.5518 85.9736L57.617 86.0108L86.0002 69.6708V36.4702H75.3063L57.5518 53.0705V85.9736Z"
                                    fill="#148C8B" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M76.1042 36.47H75.8927L67.3809 44.3391V80.3886L76.1042 75.3667V36.47Z"
                                    fill="#DEF1F8" />
                                <path d="M57.7472 20L28.9082 36.3399L57.7472 53.0704L86.0003 36.3399L57.7472 20Z"
                                    fill="#3BC9CA" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M75.9751 42.2757L75.9737 42.264L47.5479 25.7781L38.8701 30.6949L38.9322 30.7415L67.1436 47.5054L75.9751 42.2757Z"
                                    fill="white" />
                                <circle cx="27.801" cy="70.1914" r="13.801" fill="#F47A53" />
                                <rect x="20.415" y="62.7129" width="14.519" height="14.519"
                                    fill="url(#pattern0)" />
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                        height="1">
                                        <use xlink:href="#image0_1029_14" transform="scale(0.0232558)" />
                                    </pattern>
                                    <image id="image0_1029_14" width="43" height="43"
                                        xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACsAAAArCAYAAADhXXHAAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAKrSURBVHgBzZmNWeMwDIYVFriO4JvgssFlg+ttkBHKBM0GsEHLBLBBskHKBAkTlA2EhF2aBvkvcRve51ED/v3iyrbsZjACEdf0yMn2WZb1EADVUabOikwNsnpjB2rrHVJCnT7gJYWl3IqsJHsmO2IYLdnO1mas0Fzo4EUQuY0QaKMjK2Eq/MZCo80gf5tApCQ6D9V45ytAjSmylv6sQPtkShQZu8c2pHAGZ1EFPepRfg9aoE8kT55XOE+oE7kR9Af8HMj+B01qixu4YJd4xIAJY74dnpAN+t1CpRbLIie5hOmn8whehTTigxsKnhCe/ipHP7VUx+ezY+5B+yeY5yF047AIzk2f0kjeU9uPtoqxPntiDTNAvb5LSyKnqdRiO5iJo+8aHG84hSMkAPWklShsFWqMp4IEoN7KJXf48ttsVEHRYwPhO1VDk2APiTAvPt7NeCL/Th61zcUxugXne2ODW2JG70nI+lxxfpRYw0FI+3vxH+r9O3VUFY3RMeY4LLAbZDzAwqDMijNKIWPWrpRAbC9oUuyzSiifJFhJjW2CLe27v6REFtuHFr4h3waLozub2MXcAOV4uecPFiuta/mCy1ghpL3xx53ZNd6EAiUswz8h7Xx/gXJ45js1JMeyIeCFa6A9+C3ghlB/e0FDJxWslxxdx6iWUuHSUngDNwDl4zmnKVuF1iL4qksZ6ns0icpVyea7x2sJdgj1H0TRfnBjwUkDHPx+HzxEhTbSOhrZ4swNA83NpKOPKraxztEY55UQiWl3j24qiCVA8En0jmyNgk+jPgDy1r3BsGN+BVMxnT1jHN3AYkizRKL7xm8uHaZeaTDM32Lg1YUH4XrR3UD01B9D2qkiM5gB6nW3AB2s8+8GkgAOPzlmbkDf5zYwkVlix5jR+hI856JZ4gNyAEFYAU7CuwAAAABJRU5ErkJggg==" />
                                </defs>
                            </svg>


                            <div
                                class="flex flex-col h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px] text-[11px] md:text-[14px] 2xl:text-[16px] justify-center gap-2">
                                <p>Retur</p>
                                <p id="total_retur" class="poppins-semibold"></p>
                            </div>
                        </div>

                        <div class="flex items-center h-[51px] md:h-[70px] lg:h-[50px] xl:h-[60px] 2xl:h-[80px]">
                            <svg class="w-[8px] h-[14px]" viewBox="0 0 16 27" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.2721 13.97C15.2721 14.2813 15.215 14.5824 15.1008 14.8734C14.9865 15.1659 14.8342 15.4094 14.6438 15.604L4.13297 26.3411C3.71406 26.769 3.1809 26.983 2.5335 26.983C1.88609 26.983 1.35294 26.769 0.934026 26.3411C0.515118 25.9132 0.305664 25.3685 0.305664 24.7072C0.305664 24.0458 0.515118 23.5012 0.934026 23.0733L9.84536 13.97L0.934026 4.86681C0.515118 4.43888 0.305664 3.89424 0.305664 3.2329C0.305664 2.57155 0.515118 2.02692 0.934026 1.59899C1.35294 1.17106 1.88609 0.957087 2.5335 0.957087C3.1809 0.957087 3.71406 1.17106 4.13297 1.59899L14.6438 12.3361C14.8723 12.5695 15.0337 12.8224 15.1282 13.0947C15.2241 13.3671 15.2721 13.6588 15.2721 13.97Z"
                                    fill="black" />
                            </svg>
                        </div>
                    </div>


                </div>
                <p id="total_keseluruhan"
                    class="flex justify-center p-4 md:p-6 2xl:p-9 lg:p-5 text-[12px] md:text-[15px] 2xl:text-[17px] border-t-[1px] border-t-[#DCDADA] poppins-semibold">
                </p>
            </div>

        </div>

    </div>
@endsection

@section('otherjs')
    <script src="{{ asset('js/controllers/laporan_pengeluaran.js') }}"></script>
    <script>
        $(document).ready(async function() {
            await loadDefaultDetail('{{ $first_date }}', '{{ url('laporan/getDetailPengeluaran') }}');
        });
    </script>
    @include('modal.filterDate.controller')
@endsection
