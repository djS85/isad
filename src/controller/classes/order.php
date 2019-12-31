<?php


class order
{
    private $order_id;      // order id
    private $cm_id;         // customer id
    private $total;         // total price of order

    private $order_items = array();  // array of items on the order.

    // GETTERS
    function get_orderID() {
        return $this->order_id;
    }

    function get_cmID() {
        return $this->cm_id;
    }

    function get_total() {
        return $this->total;
    }

    function get_orderItems() {
        return $this->order_items;
    }

    // SETTERS
    function set_orderID($id) {
        $this->order_id = $id;
    }

    function set_cmID($id) {
        $this->cm_id = $id;
    }

    function set_total($total) {
        $this->total = $total;
    }

    function set_orderItems(Array $order) {
        $this->order_items = $order;
    }
}