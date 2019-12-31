<?php


class customer
{
    private $name;
    private $table;
    private $id;

    public function get_ID() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_table() {
        return $this->table;
    }

    public function set_ID($id) {
        $this->id = $id;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_table($table) {
        $this->table = $table;
    }

}