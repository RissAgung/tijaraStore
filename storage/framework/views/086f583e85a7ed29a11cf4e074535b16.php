

<div id="bg_modal" class="fixed bg-black w-full h-full opacity-0 transition pointer-events-none"></div>



<form id="form_product" action="/product/add" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div id="konten_modal"
        class="bg-white w-[90%] md:w-[70%] z-[101] h-[80%] fixed  left-[50%] top-[50%] -translate-y-[50%] -translate-x-[50%] rounded-md drop-shadow-lg flex flex-col scale-0 transition ease-linear duration-200">
        
        <div class="flex justify-start px-4 md:px-8 py-6">
            <p id="title_modal">Tambah Data</p>
        </div>
        <div class="h-[2px] w-full bg-[#DDDDDD]"></div>
        
        
        <div
            class="w-full flex-grow overflow-y-auto flex flex-col md:flex-row md:flex-wrap md:gap-4 md:pt-8 px-4 md:px-8">
            <input id="id" name="id" type="hidden" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="<?php echo e(old('id')); ?>">

            <div class="flex flex-col flex-grow md:w-[48%] md:mt-0 md:order-1 justify-start mt-6">
                <Label class="ml-2 text-sm">Nama Product</Label>
                <input id="txt_nama" name="txt_nama" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="<?php echo e(old('txt_nama')); ?>">
                <?php $__errorArgs = ['txt_nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="flex flex-col flex-grow md:w-1/2 md:mt-0 md:order-2 justify-start mt-2">
                <Label class="ml-2 text-sm">Warna</Label>
                <input id="txt_warna" name="txt_warna" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="<?php echo e(old('txt_warna')); ?>">
                <?php $__errorArgs = ['txt_warna'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-3 justify-start mt-2">
                <Label class="ml-2 text-sm">Kategori</Label>
                <select id="txt_kategori" name="txt_kategori" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none appearance-none">
                    <option <?php echo e(old('txt_kategori') == 'pria' ? 'selected' : ''); ?> value="pria">Pria</option>
                    <option <?php echo e(old('txt_kategori') == 'wanita' ? 'selected' : ''); ?> value="wanita">Wanita</option>
                    <option <?php echo e(old('txt_kategori') == 'anak' ? 'selected' : ''); ?> value="anak">Anak</option>
                </select>
            </div>
            <div class="flex flex-col  md:w-[32%] md:mt-0 md:order-4 justify-start mt-2">
                <Label class="ml-2 text-sm">Ukuran</Label>
                <select id="txt_ukuran" name="txt_ukuran" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none appearance-none">
                    <option <?php echo e(old('txt_ukuran') == 'S' ? 'selected' : ''); ?> value="S">S</option>
                    <option <?php echo e(old('txt_ukuran') == 'M' ? 'selected' : ''); ?> value="M">M</option>
                    <option <?php echo e(old('txt_ukuran') == 'L' ? 'selected' : ''); ?> value="L">L</option>
                    <option <?php echo e(old('txt_ukuran') == 'XL' ? 'selected' : ''); ?> value="XL">XL</option>
                    <option <?php echo e(old('txt_ukuran') == 'XXL' ? 'selected' : ''); ?> value="XXL">XXL</option>
                    <option <?php echo e(old('txt_ukuran') == 'XXXL' ? 'selected' : ''); ?> value="XXXL">XXXL</option>
                </select>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-8 justify-start mt-2">
                <Label class="ml-2 text-sm">Jenis</Label>
                <div class="flex flex-row flex-wrap mt-2 gap-3 ml-2">
                    <div class="flex flex-row gap-3">
                        <input value="jual" class="w-4 h-4 rounded mt-1"
                            type="radio" name="jenis" id="jual" <?php echo e(old('jenis') == 'jual' ? 'checked' : ''); ?>>
                        <label for="jual">Produk Jual</label>
                    </div>
                    <div class="flex flex-row gap-3">
                        <input value="free" class="w-4 h-4 rounded mt-1"
                            type="radio" name="jenis" id="free" <?php echo e(old('jenis') == 'free' ? 'checked' : ''); ?>>
                        <label for="free">Produk Free</label>
                    </div>
                    <?php $__errorArgs = ['jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-6 justify-start mt-2">
                <Label class="ml-2 text-sm">Tag</Label>
                <div
                    class="w-[70%] md:w-full h-44 border-2 rounded-md mt-2 overflow-x-auto flex flex-col flex-wrap px-4 py-4 gap-2">
                    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex flex-row gap-3 items-center">
                            <input name="tags[]" id="<?php echo e($item->kode_tag); ?>" class="w-4 h-4 rounded mt-1"
                                type="checkbox" value="<?php echo e($item->kode_tag); ?>"
                                <?php echo e(in_array($item->kode_tag, old('tags', [])) ? 'checked' : ''); ?>>
                            <label for="<?php echo e($item->kode_tag); ?>" class="flex-wrap"><?php echo e($item->nama_tag); ?></label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="w-[70%] bg-[#FFB015] py-2 px-4 mt-4 rounded-md">
                    <p class="w-full text-center">Tambah Tag</p>
                </div>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-5 justify-start mt-6">
                <Label class="ml-2 text-sm">Harga</Label>
                <input id="txt_harga" name="txt_harga" type="text" placeholder=""
                    class="border-2 rounded-md py-2 px-4 mt-1 outline-none" value="<?php echo e(old('txt_harga')); ?>">
                <?php $__errorArgs = ['txt_harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="flex flex-col flex-grow md:w-[32%] md:mt-0 md:order-7 justify-start mt-6 mb-8">
                <Label class="ml-2 text-sm">Foto</Label>
                <div class="w-[70%] md:w-full h-44 border-2 border-dashed rounded-md mt-2 flex relative p-2 overflow-hidden">
                    <input id="foto" name="foto" class="opacity-0 h-full w-full z-50" type="file" id="">
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
                    <img id="imgpreview" class="absolute left-[50%] top-[50%]  -translate-y-[50%] -translate-x-[50%] flex-col items-center justify-center gap-2 hidden"
                        src="https://images.unsplash.com/photo-1661956602868-6ae368943878?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                        alt="preview">
                </div>
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="label-error text-sm text-red-700"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <p>File : jpg, jpeg, png</p>
            </div>
        </div>

        
        
        <div class="w-full px-4 md:px-8 py-4">
            <button type="button" id="btn_submit" class="w-full bg-[#FFB015] flex justify-center py-4 rounded-md">
                <span id="button_submit" class="text-xs poppins-medium">Tambah Data</span>
            </button>
        </div>
        
    </div>
</form>
<?php /**PATH D:\Development\Web\Tijara\src\resources\views/modal/add_product.blade.php ENDPATH**/ ?>