<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset('css/output/main.css')); ?>">
    <title>Document</title>
</head>

<body class="bg-[#F7F7F7] w-full h-full box-border">
    <div class="flex flex-row w-full h-full justify-between">

        <div class="z-[100]">
            <?php echo $__env->yieldContent('modal'); ?>
        </div>

        
        <div>
            <?php echo $__env->make('layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        

        
        <div class="flex flex-col w-full lg:ml-[390px]">

            
            <div>
                <?php echo $__env->make('layout.topBar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            

            
            <div class="">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            

        </div>
        


    </div>
    <script src="<?php echo e(asset('js/jquery-3.6.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <?php echo $__env->yieldContent('otherjs'); ?>
</body>

</html>
<?php /**PATH D:\Development\Web\Tijara\src\resources\views/layout/main.blade.php ENDPATH**/ ?>