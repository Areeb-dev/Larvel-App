
<?php if(!empty(\Auth::user()->avatar)): ?>
    <div class="avatar av-l" style="background-image: url('<?php echo e(asset('/storage/'.config('chatify.user_avatar.folder').\Auth::user()->avatar)); ?>');">
    </div>
<?php else: ?>
    <img class="avatar av-m" avatar="<?php echo e(\Auth::user()->name); ?>">
<?php endif; ?>

<p class="info-name"><?php echo e(config('chatify.name')); ?></p>
<div class="messenger-infoView-btns">

    <a href="#" class="danger delete-conversation"><i class="fas fa-trash-alt"></i> <?php echo e(__('Delete Conversation')); ?></a>
</div>

<div class="messenger-infoView-shared">
    <p class="messenger-title"><?php echo e(__('shared photos')); ?></p>
    <div class="shared-photos-list"></div>
</div>
<?php /**PATH /home/cloudtechni/public_html/gasilab/resources/views/messenger/layouts/info.blade.php ENDPATH**/ ?>