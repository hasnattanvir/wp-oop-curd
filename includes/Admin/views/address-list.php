<div class="wrap">
    <h1>
        <?php _e( 'Address Book', 'linuxbangla-academy' ); ?>
    </h1>
    <a href="<?php echo admin_url('admin.php?page=linuxbangla-academy&action=new','admin'); ?>">

        <?php _e( 'Add New', 'linuxbangla-academy' ); ?>

    </a>


    <form action="" mehtod="post">
        <?php
            $table = new Linuxbangla\Academy\Admin\Address_List();
            $table->prepare_items();
            $table->display();
        ?>
    </form>
</div>