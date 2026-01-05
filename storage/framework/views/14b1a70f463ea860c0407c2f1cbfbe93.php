<nav>
    <div style="display: flex; justify-content: center; align-items: center; gap: 0.25rem; margin-top: 1rem;">
        <?php if($paginator->hasPages()): ?>
            <?php if($paginator->onFirstPage()): ?>
                <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">‹</span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">‹</a>
            <?php endif; ?>

            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_string($element)): ?>
                    <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;"><?php echo e($element); ?></span>
                <?php endif; ?>

                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <span style="padding: 0.25rem; background: #3b82f6; color: white; border: 1px solid #3b82f6; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;"><?php echo e($page); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;"><?php echo e($page); ?></a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">›</a>
            <?php else: ?>
                <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">›</span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</nav><?php /**PATH C:\Users\subha\OneDrive\Desktop\Pro\E-Commerce\resources\views/pagination/custom.blade.php ENDPATH**/ ?>