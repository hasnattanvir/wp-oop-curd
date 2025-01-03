<div class="wrap">
    <h1>
        <?php _e( 'New Address Book', 'linuxbangla-academy' ); ?>
    </h1>
    
    <?php var_dump($this->errors); ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="name">
                            <?php _e( 'Name', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="phone">
                            <?php _e( 'Phone', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="">
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        <label for="email">
                            <?php _e( 'Email', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="email" id="email" class="regular-text" value="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="address">
                            <?php _e( 'Address', 'linuxbangla-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <textarea name="address" id="address" class="regular-text" value=""></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('new-address'); ?>
        <?php submit_button( __('Add Address','linuxbangla-academy'), 'primary','submit_address'); ?>
    </form>
</div>