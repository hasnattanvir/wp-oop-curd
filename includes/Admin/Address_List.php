<?php
namespace Linuxbangla\Academy\Admin;

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Address_List extends \WP_List_Table {
    function __construct() {
        parent::__construct([
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false,
        ]);
    }

    public function get_columns() {
        return [
            'cb'        => '<input type="checkbox" />',
            'name'      => __('Name', 'linuxbangla-academy'),
            'address'   => __('Address', 'linuxbangla-academy'),
            'email'     => __('Email', 'linuxbangla-academy'),
            'phone'     => __('Phone', 'linuxbangla-academy'),
            'created_at'=> __('Date', 'linuxbangla-academy'),
        ];
    }

    protected function column_default($item, $column_name){
        switch ($column_name){
            case 'value':
                break;
            default:
                return isset($item->$column_name) ? $item->$column_name : '';
        }
    }

    public function column_name($item) {
        $action = [];
    
        // Edit action
        $actions['edit'] = sprintf(
            '<a href="%s">%s</a>',
            admin_url('admin.php?page=linuxbangla-academy&action=edit&id=' . $item->id),
            __('Edit', 'linuxbangla-academy')
        );
    
        // Delete action
        $actions['delete'] = sprintf(
            '<a href="%s" onclick="return confirm(\'Are you sure?\');">%s</a>',
            admin_url('admin.php?page=linuxbangla-academy&action=delete&id=' . $item->id),
            __('Delete', 'linuxbangla-academy')
        );
    
        // Display the name with actions
        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s',
            admin_url('admin.php?page=linuxbangla-academy&action=view&id=' . $item->id),
            $item->name,
            $this->row_actions($actions) // Display actions like edit and delete
        );
    }
    

    protected function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }


    public function prepare_items() {
        $columns = $this->get_columns();
        $hidden = [];
        $per_page = 15;

        // Sorting
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];

        // Get data
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        // Fetch addresses
        $args = [
            'number'  => $per_page,
            'offset'  => $offset,
        ];
        $this->items = lb_get_addresses($args);

        // Set pagination args
        $total_items = lb_get_total_addresses(); // A separate function to count total records
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ]);
    }

    // Define sortable columns
    public function get_sortable_columns() {
        return [
            'name'      => ['name', true],
            'created_at'=> ['created_at', false],
        ];
    }
}

function lb_get_total_addresses() {
    global $wpdb;
    return $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}ac_addresses");
}