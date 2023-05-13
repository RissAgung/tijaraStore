{{-- TODO: INI BACKGROUND MODAL --}}
<div id="bg_modal_struk" class="z-[105] fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>


{{-- TODO: INI KONTEN MODAL --}}
<div id="konten_modal_struk"
    class="bg-white w-[90%] md:w-fit z-[105] max-h-[90%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
    {{-- ? start header ? --}}
    <div class="flex flex-row justify-between">
        <div class="flex justify-start px-4 md:px-8 py-6">
            <p id="title_modal">Digital Struk</p>
        </div>
        <div class="flex flex-row justify-start px-4 md:px-8 py-6 gap-3">
            <div onclick="downloadStruk()" class="cursor-pointer">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 15.575C11.8667 15.575 11.7417 15.5543 11.625 15.513C11.5083 15.4717 11.4 15.4007 11.3 15.3L7.7 11.7C7.51667 11.5167 7.425 11.2833 7.425 11C7.425 10.7167 7.51667 10.4833 7.7 10.3C7.88333 10.1167 8.121 10.021 8.413 10.013C8.705 10.005 8.94234 10.0923 9.125 10.275L11 12.15V5C11 4.71667 11.096 4.479 11.288 4.287C11.48 4.095 11.7173 3.99934 12 4C12.2833 4 12.521 4.096 12.713 4.288C12.905 4.48 13.0007 4.71734 13 5V12.15L14.875 10.275C15.0583 10.0917 15.296 10.004 15.588 10.012C15.88 10.02 16.1173 10.116 16.3 10.3C16.4833 10.4833 16.575 10.7167 16.575 11C16.575 11.2833 16.4833 11.5167 16.3 11.7L12.7 15.3C12.6 15.4 12.4917 15.471 12.375 15.513C12.2583 15.555 12.1333 15.5757 12 15.575ZM6 20C5.45 20 4.979 19.804 4.587 19.412C4.195 19.02 3.99934 18.5493 4 18V16C4 15.7167 4.096 15.479 4.288 15.287C4.48 15.095 4.71734 14.9993 5 15C5.28334 15 5.521 15.096 5.713 15.288C5.905 15.48 6.00067 15.7173 6 16V18H18V16C18 15.7167 18.096 15.479 18.288 15.287C18.48 15.095 18.7173 14.9993 19 15C19.2833 15 19.521 15.096 19.713 15.288C19.905 15.48 20.0007 15.7173 20 16V18C20 18.55 19.804 19.021 19.412 19.413C19.02 19.805 18.5493 20.0007 18 20H6Z"
                        fill="black" />
                </svg>
            </div>
            <div onclick="closeModalStruk()" class="cursor-pointer">
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
    <div class="px-4 md:px-8 flex flex-col overflow-y-auto h-full text-sm w-full">

        <div id="" class="flex justify-center w-full">
            <div id="html_struk" class="flex flex-col poppins-regular px-4 text-sm w-full max-w-[600px]">
                <div class="w-full flex flex-col justify-center items-center mt-2">
                    <h1 class="poppins-semibold text-lg">TIJARA STORE</h1>
                    <p class="text-center my-4">Alamat: Jl. Kaca Terbang No.55, Jember Utara, Garahan, Kec. Silo,
                        Kabupaten
                        Jember, Jawa Timur 68117</p>
                </div>
                <div class="w-full h-[2px] bg-black">
                </div>

                <div class="flex flex-row justify-between w-full py-2">
                    <p>Tanggal <span class="px-2">:</span> <span id="struk_tanggal">09-07-2022 19:30:27</span></p>
                    <p>Kasir <span class="px-2">:</span> <span id="struk_kasir">Mphstar</span></p>
                </div>

                <div class="w-full h-[2px] bg-black">
                </div>
                <div class="overflow-auto w-full flex flex-col py-4 relative">

                    <table class="">
                        <tr>
                            <th class="text-start">Nama</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                        <tbody id="detail_struk">
                            <tr>
                                <td class="text-start tracking-wide pr-2 w-[150px] max-w-[150px] min-w-[150px]">Dress
                                    Panjang Kondangan Anti Peluru</td>
                                <td class="text-center tracking-wide px-2 w-[80px] max-w-[80px] min-w-[80px]">5</td>
                                <td class="text-center tracking-wide px-2">10.000</td>
                                <td class="text-end tracking-wide pl-2">50.000</td>
                            </tr>
                        </tbody>

                        <tr>
                            <td colspan="4" class="">
                                <div class="w-full h-[2px] border-0 bg-black my-2">
                                </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="text-start tracking-wide pr-2 w-[150px] max-w-[150px] min-w-[150px]">Total
                                Item</td>
                            <td id="struk_total_item"
                                class="text-center tracking-wide px-2 w-[80px] max-w-[80px] min-w-[80px]">13</td>
                            <td class="text-center tracking-wide px-2"></td>
                            <td id="struk_total_harga" class="text-end tracking-wide pl-2">550.000</td>
                        </tr>
                        <tr>
                            <td class="text-start tracking-wide pr-2 w-[150px] max-w-[150px] min-w-[150px]">Tunai</td>
                            <td class="text-center tracking-wide px-2 w-[80px] max-w-[80px] min-w-[80px]"></td>
                            <td class="text-center tracking-wide px-2"></td>
                            <td id="struk_total_bayar" class="text-end tracking-wide pl-2">600.000</td>
                        </tr>
                        <tr>
                            <td class="text-start tracking-wide pr-2 w-[150px] max-w-[150px] min-w-[150px]">Kembalian
                            </td>
                            <td class="text-center tracking-wide px-2 w-[80px] max-w-[80px] min-w-[80px]"></td>
                            <td class="text-center tracking-wide px-2"></td>
                            <td id="struk_kembalian" class="text-end tracking-wide pl-2">50.000</td>
                        </tr>
                    </table>
                </div>
                <div class="w-full h-[2px] bg-black mb-2">
                </div>

                <div class="my-8 poppins-regular">
                    <div class="">
                        <img id="struk_barcode" class="w-full h-fit"
                            src="data:image/png;base64,{{ DNS1D::getBarcodePNG('TR0012133332431', 'C39', 1, 33, [0, 0, 0], true) }}"
                            alt="barcode">
                    </div>

                    <div class="px-8 flex w-full justify-center flex-col">
                        <p class="text-center mt-4">Kritik&Saran: BintangKabelPrekes@gmail.com</p>
                        <p class="text-center mt-2">SMS/WA: 081233764580</p>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                // var elementHTML = document.querySelector("#html_struk");
                // const {
                //     jsPDF
                // } = window.jspdf;


                // $("#html_struk").addClass('min-w-[600px]');
                // var pdf = new jsPDF('p', 'pt', 'a4');
                // pdf.setFont("Helvetica");
                // pdf.html(elementHTML, {
                //     callback: (pdf) => {
                //         pdf.save('web.pdf');
                //     },
                //     background: '#000',
                //     format: 'PNG',
                //     pagesplit: true,
                //     margin: [20, 0, 20, 0]
                // });

                // html2canvas(elementHTML).then((canvas) => {
                //     const imgData = canvas.toDataURL('image/png');
                //     const pdf = new jsPDF('p', 'pt', 'a4');
                //     const imgProps = pdf.getImageProperties(imgData);
                //     const pdfWidth = pdf.internal.pageSize.getWidth();
                //     const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                //     console.log(imgProps.height);
                //     pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight, '', 'FAST');
                //     pdf.save('download.pdf');
                //     $("#html_struk").removeClass('min-w-[600px]');
                // });
            </script>
        </div>
    </div>
    {{-- ? end isi modal ? --}}
</div>
