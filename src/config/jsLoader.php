<script type="text/javascript" src="<?php echo asset('vendor/laranotify/bootstrap-notify/bootstrap-notify.min.js'); ?>"></script>

<?php if (session()->exists(config('laranotify.container'))) { ?>

<script>
var laranotifySound;
const laranotify = $.notify(<?php echo session(config('laranotify.container')); ?>);
</script>

 <?php } ?>
