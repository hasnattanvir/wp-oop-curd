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
        return new \WP_Error( 'no-name', __( 'You Must Provide a Name.', 'linuxbangla-academy' ) );
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



function lb_get_addresses($args = []) {
    global $wpdb;

    $defaults = [
        'number'  => 15,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC',
    ];

    $args = wp_parse_args($args, $defaults);

    // Sanitize the order and orderby values
    $orderby = sanitize_sql_orderby($args['orderby']);
    $order = strtoupper($args['order']) === 'DESC' ? 'DESC' : 'ASC';

    // Build the query
    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}ac_addresses
        ORDER BY {$orderby} {$order}
        LIMIT %d, %d",
        $args['offset'],
        $args['number']
    );

    return $wpdb->get_results($sql);
}



function lb_address_count(){
    global $wpdb;
    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}ac_addresses");
}