<?php if($paginator->hasPages()): ?>
    <p class="mt-2 text-center">Menampilkan <b><?php echo e($paginator->count()); ?></b> data dari <b><?php echo e($paginator->total()); ?></b>
    </p>
    <div class="px-2 bg-white justify-center border-[#DCDADA] border-[1px] py-2 flex w-fit items-center">
        <ul class="flex flex-row gap-2">
            <?php if($paginator->onFirstPage()): ?>
                <li class="hidden items-center cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="<?php echo e($paginator->previousPageUrl()); ?>">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.5L11.25 0.00480938L11.25 12.9952L0 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            <?php else: ?>
                <li class="flex items-center cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="<?php echo e($paginator->previousPageUrl()); ?>">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 6.5L11.25 0.00480938L11.25 12.9952L0 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="py-2 bg-[#6F6F6F] px-4 text-white rounded-md cursor-pointer"><?php echo e($page); ?>

                            </li>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>">
                                <li
                                    class="py-2 bg-[#ffffff] px-4 text-black rounded-md cursor-pointer hover:bg-[#ebebeb]">
                                    <?php echo e($page); ?>

                                </li>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($paginator->hasMorePages()): ?>
                <li class="flex items-center cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="<?php echo e($paginator->nextPageUrl()); ?>">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.5L0.75 12.9952V0.00480938L12 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            <?php else: ?>
                <li class="hidden items-center cursor-pointer hover:bg-[#ebebeb]">
                    <a class="w-full px-4 items-center flex h-full" href="<?php echo e($paginator->nextPageUrl()); ?>">
                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.5L0.75 12.9952V0.00480938L12 6.5Z" fill="#787777" />
                        </svg>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH D:\Development\Web\Tijara\src\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>