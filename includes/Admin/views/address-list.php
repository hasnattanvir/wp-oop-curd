<div class="wrap">
    <h1>
        <?php _e( 'Address Book', 'linuxbangla-academy' ); ?>
    </h1>
    <a href="<?php echo admin_url('admin.php?page=linuxbangla-academy&action=new','admin'); ?>">

        <?php _e( 'Add New', 'linuxbangla-academy' ); ?>

    </a>

    <?php 
    if(isset($_GET['inserted'])){ ?>
        <div class="notice notice-success">
            <p><?php _e('Address has been added successfully!','linuxbangla-academy') ?></p>
        </div>
    <?php
    } ?>

    <?php 
    if(isset($_GET['deleted']) && $_GET['deleted'] == 'true'){ ?>
        <div class="notice notice-success">
            <p><?php _e('Address has been Deleted successfully!','linuxbangla-academy') ?></p>
        </div>
    <?php
    } ?>

    <form action="" mehtod="post">
        <?php
            $table = new Linuxbangla\Academy\Admin\Address_List();
            $table->prepare_items();
            $table->display();
        ?>
    </form>
</div>