<?php
/**
 * Insert a new address
 *
 * @param  array  $args
 *
 * @return int|WP_Error
 */

function lb_ac_insert_address( $args = [] ) {
    global $wpdb;

    if ( empty( $args['name'] ) ) {
        return new \WP_Error( 'no-name', __( 'You must provide a name.', 'wedevs-academy' ) );
    }

    $defaults = [
        'name'       => '',
        'address'    => '',
        'email'      => '',
        'phone'      => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time( 'mysql' ),
    ];

    $data = wp_parse_args( $args, $defaults );
    // edit update and new
    if ( isset( $data['id'] ) ) {

        $id = $data['id'];
        unset( $data['id'] );

        $updated = $wpdb->update(
            $wpdb->prefix . 'ac_addresses',
            $data,
            [ 'id' => $id ],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            [ '%d' ]
        );

        return $updated;
    }else{
        $inserted = $wpdb->insert(
            $wpdb->prefix . 'ac_addresses',
            $data,
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
                '%s',
            ]
        );
    
        if ( ! $inserted ) {
            return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data: ' . $wpdb->last_error, 'linuxbangla-academy' ) );
        }
        return $wpdb->insert_id; 
    }


}



// function lb_get_addresses($args = []) { 
//     global $wpdb;

//     $defaults = [
//         'number'  => 15,
//         'offset'  => 0,
//         'orderby' => 'id',
//         'order'   => 'ASC',
//     ];

//     $args = wp_parse_args($args, $defaults);

//     // Sanitize the order and orderby values
//     $orderby = sanitize_sql_orderby($args['orderby']);
//     $order = strtoupper($args['order']) === 'DESC' ? 'DESC' : 'ASC';

//     // Build the query
//     $sql = $wpdb->prepare(
//         "SELECT * FROM {$wpdb->prefix}ac_addresses
//         ORDER BY {$orderby} {$order}
//         LIMIT %d, %d",
//         $args['offset'],
//         $args['number']
//     );

//     return $wpdb->get_results($sql);
// }

function lb_get_addresses($args = []) {
    global $wpdb;

    $defaults = [
        'number'  => 15,
        'offset'  => 0,
        'orderby' => 'name',  // Default orderby
        'order'   => 'ASC',   // Default order
    ];
    $args = wp_parse_args($args, $defaults);

    $orderby = esc_sql($args['orderby']);
    $order = esc_sql($args['order']);
    $number = intval($args['number']);
    $offset = intval($args['offset']);

    $table_name = $wpdb->prefix . 'ac_addresses'; // Replace with your table name

    return $wpdb->get_results("
        SELECT * 
        FROM $table_name
        ORDER BY $orderby $order
        LIMIT $offset, $number
    ");
}




function lb_address_count(){
    global $wpdb;
    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}ac_addresses");
}

// For Edit

function lb_ac_get_address($id){
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}ac_addresses WHERE id = %d", $id)
    );
    
}

function lb_ac_delete_address($id){
    global $wpdb;
    return $wpdb->delete(
        $wpdb->prefix.'ac_addresses',
        ['id'=> $id],
        ['%d']
    );
}