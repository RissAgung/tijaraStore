@extends('layout.main')

@section('other_css')
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
@endsection

@section('modal')
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
                class=" max-md:shadow-md text-selector-none flex flex-col md:flex-row md:items-end max-md:hidden max-md:absolute max-md:z-20 gap-2 min-[360px]:gap-3 md:gap-5 poppins-medium text-[#2c2c2c] p-2 min-[360px]:p-3 md:p-0 w-24 min-[360px]:w-32 md:w-auto rounded-sm min-[360px]:rounded-[5px] bg-white top-8 min-[360px]:top-10 max-md:border-[1px] max-md:border-[#DCDADA] md:h-full">
                <a id="menu_pemasukan1" href="{{ route('pemasukan') }}"
                    class="hover:text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Pemasukan</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px]">
                    </div>
                </a>
                <a id="menu_pemasukan2" href="{{ route('pengeluaran') }}"
                    class="hover:text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Pengeluaran</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px] transition ease-in-out">
                    </div>
                </a>
                <a id="menu_pemasukan3" href="{{ route('akumulasi') }}"
                    class="text-[#ff9215] md:relative transition ease-in-out flex items-center h-full">
                    <p>Akumulasi</p>
                    <div class="max-md:hidden absolute bottom-0 w-full h-[6px] transition ease-in-out bg-[#FFB015]">
                    </div>
                </a>
            </div>

            {{-- end left --}}

            {{-- right --}}
            <div class="flex poppins-medium gap-2">

                {{-- export --}}
                <button id="btn_export"
                    class="text-selector-none flex items-center gap-2 py-2 px-3 md:py-2 md:px-3 rounded-md shadow-lg bg-black hover:bg-[#2b2b2b] transition ease-in-out">
                    <p class="text-white max-md:hidden">export</p>
                    <svg class="mt-[1px]" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6 2C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2M13 3.5L18.5 9H13M8.93 12.22H16V19.29L13.88 17.17L11.05 20L8.22 17.17L11.05 14.35"
                            fill="white" />
                    </svg>
                </button>

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
                <a href="{{ url('/laporan/akumulasi') }}"
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
        <div class="flex flex-col-reverse lg:flex-row w-full lg:h-full p-2 md:p-5 gap-2 md:gap-5">

            {{-- left --}}
            {{-- container chart --}}
            <div id="container_chart"
                class="flex justify-center items-center w-full lg:w-[70%] h-80 md:h-96 lg:min-h-full bg-white border-[1px] border-[#DCDADA] rounded-md">
                <div id="chart" class=""></div>
            </div>

            {{-- right --}}
            <div class="w-full flex flex-col lg:flex-col-reverse max-lg:gap-2 lg:justify-between lg:min-h-full lg:w-[30%]">

                {{-- pie chart --}}
                <swiper-container pagination="true" pagination-dynamic-bullets="true" pagination-clickable="true"
                    autoplay-delay="6000" autoplay-disable-on-interaction="false" loop="true"
                    class="mySwiper w-full lg:h-[65%] max-lg:aspect-square bg-white border-[1px] border-[#DCDADA] rounded-md">
                    <swiper-slide class="w-full h-full" id="container_pie_chart_pria">
                        <div id="pie_chart_pria"></div>
                    </swiper-slide>
                    <swiper-slide class="w-full h-full" id="container_pie_chart">
                        <div id="pie_chart_wanita"></div>
                    </swiper-slide>
                    <swiper-slide class="w-full h-full" id="container_pie_chart">
                        <div id="pie_chart_anak"></div>
                    </swiper-slide>
                </swiper-container>

                {{-- pemasukan & pengeluaran --}}
                <div class="flex flex-col justify-between w-full max-lg:gap-2 lg:h-[30%]">

                    {{-- pemasukan --}}
                    <div
                        class="flex justify-between items-center w-full lg:h-[45%] p-3 bg-white border-[1px] border-[#DCDADA] rounded-md">

                        {{-- icon --}}
                        <svg class="w-[30%] lg:w-[20%] aspect-video" viewBox="0 0 111 72" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.86667 35.5647H0V71.7111H111V15.8314H92.9111C84.6889 15.8314 78.1111 0.209131 72.3556 1.03135C67.7511 1.68913 64.7026 8.43128 61.6667 13.3646C59.4741 16.9276 52.9511 26.3558 47.6889 25.698C42.4267 25.0402 38.6444 19.9424 34.5333 19.9425C30.4222 19.9425 27.1333 24.0535 23.0222 28.1646C20.5556 30.6313 14.8762 35.5647 9.86667 35.5647Z"
                                fill="url(#paint0_linear_828_21)" />
                            <path
                                d="M0 35.5647C2.46667 35.5647 4.93333 35.5647 9.86667 35.5647C14.8762 35.5647 20.5556 30.6313 23.0222 28.1647C27.1333 24.0535 30.4222 19.9425 34.5333 19.9425C38.6444 19.9424 42.4267 25.0402 47.6889 25.698C52.9511 26.3558 59.4741 16.9276 61.6667 13.3646C64.7026 8.43128 67.7511 1.68913 72.3556 1.03135C78.1111 0.209131 84.6889 15.8314 92.9111 15.8314C99.4889 15.8314 107.711 15.8314 111 15.8314"
                                stroke="#54DC24" />
                            <defs>
                                <linearGradient id="paint0_linear_828_21" x1="55.5" y1="1" x2="55.5"
                                    y2="71.7111" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#54DC24" stop-opacity="0.48" />
                                    <stop offset="1" stop-color="#DCFFD0" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>

                        {{-- value --}}
                        <div class="flex flex-col w-[60%]">
                            <h4 class="poppins-semibold md:text-2xl lg:text-lg text-[#097E62]" id="value_pemasukan"></h4>
                            <p class="poppins-semibold md:text-xl lg:text-base text-[#565656] text-sm">Pemasukan</p>
                        </div>

                    </div>

                    {{-- pengeluaran --}}
                    <div
                        class="flex justify-between items-center w-full lg:h-[45%] p-3 bg-white border-[1px] border-[#DCDADA] rounded-md">

                        {{-- icon --}}

                        <svg class="w-[30%] lg:w-[20%] aspect-video" viewBox="0 0 111 72" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M101.133 0.999962H111L111 71.71L0 71.71V23.3294H18.0889C26.3111 23.3294 32.8889 36.355 38.6444 35.4246C43.2489 34.6803 46.2974 31.7031 49.3333 26.1206C51.5259 22.0889 58.0489 11.4204 63.3111 12.1647C68.5733 12.909 72.3556 15.8864 76.4667 15.8863C80.5778 15.8863 83.8667 14.0255 87.9778 9.37355C90.4444 6.58237 96.1238 0.999962 101.133 0.999962Z"
                                fill="url(#paint0_linear_828_24)" />
                            <path
                                d="M111 0.999912C108.533 0.999912 106.067 0.999912 101.133 0.999912C96.1238 0.999912 90.4444 6.58232 87.9778 9.3735C83.8667 14.0255 80.5778 15.8862 76.4667 15.8863C72.3556 15.8863 68.5733 12.909 63.3111 12.1647C58.0489 11.4204 51.5259 22.0889 49.3333 26.1206C46.2974 31.703 43.2489 34.6803 38.6444 35.4246C32.8889 36.355 26.3111 23.3294 18.0889 23.3294C11.5111 23.3294 3.28889 23.3294 -1.43051e-06 23.3294"
                                stroke="#FB6363" />
                            <defs>
                                <linearGradient id="paint0_linear_828_24" x1="55.9111" y1="4.72158" x2="55.9111"
                                    y2="77.2923" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#FB6363" stop-opacity="0.53" />
                                    <stop offset="1" stop-color="white" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>


                        {{-- value --}}
                        <div class="flex flex-col w-[60%]">
                            <h4 class="poppins-semibold md:text-2xl lg:text-lg text-[#E20000]" id="value_pengeluaran">
                            </h4>
                            <p class="poppins-semibold md:text-xl lg:text-base text-[#565656] text-sm">Pengeluaran</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('otherjs')
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    <script src="{{ asset('js/swiper-element-bundle.min.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script> --}}
    <script src="{{ asset('js/controllers/akumulasi.js') }}"></script>
    @include('report.akumulasi_controller')
    @include('modal.filterDate.controller')
@endsection
