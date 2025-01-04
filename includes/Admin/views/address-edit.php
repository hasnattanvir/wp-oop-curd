<div class="wrap">
    <h1>
        <?php _e( 'Edit Address Book', 'linuxbangla-academy' ); ?>
    </h1>
    
    <?php 
    // echo '<pre>';
    // var_dump($address);
    // echo '</pre>'; 
    ?>

    <?php 
    if(isset($_GET['address-updated'])){ ?>
    <div class="notice notice-success">
        <p><?php _e('Address has been updated successfully!','linuxbangla-academy') ?></p>
    </div>
    <?php
    }
    ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row <?php echo $this->has_error('name') ? 'form-invalid' : ''; ?> ">
                    <th scope="row">
                        <label for="name">
                            <?php _e( 'Name', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $address->name ); ?>">

                        <!-- oop process show error -->
                        <?php
                            if($this->has_error('name')){ ?>
                                <p class="description error">
                                    <?php echo $this->get_error('name'); ?>
                                </p>
                        <?php
                            }
                        ?>

                        <!-- normal process  show error -->
                        <?php // if(isset($this->errors['name'])){ ?>
                                <p class="description error">
                                    <?php // echo $this->errors['name']; ?>
                                </p>
                        <?php // } ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="phone">
                            <?php _e( 'Phone', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( $address->phone ); ?>">
                        <!-- oop process show error -->
                        <?php
                            if($this->has_error('phone')){ ?>
                                <p class="description error">
                                    <?php echo $this->get_error('phone'); ?>
                                </p>
                        <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="email">
                            <?php _e( 'Email', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="email" id="email" class="regular-text" value="<?php echo esc_attr( $address->email ); ?>">
                        <!-- oop process show error -->
                        <?php
                            if($this->has_error('email')){ ?>
                                <p class="description error">
                                    <?php echo $this->get_error('name'); ?>
                                </p>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="address">
                            <?php _e( 'Address', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <textarea name="address" id="address" class="regular-text"><?php echo esc_textarea( $address->address ); ?></textarea>
                       <!-- oop process show error -->
                       <?php
                            if($this->has_error('address')){ ?>
                                <p class="description error">
                                    <?php echo $this->get_error('address'); ?>
                                </p>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="id" value="<?php echo esc_attr($address->id); ?>">
        <?php wp_nonce_field('new-address'); ?>
        <?php submit_button( __('Update Address','linuxbangla-academy'), 'primary','submit_address'); ?>
    </form>
</div>