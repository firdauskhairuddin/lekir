<?php
class Second {
    private $data = [];
    private $usertype = "user";
    private $username = "John";
    private $_func = "print_r";

    public $member = "data";
    public $method = "destroy";

    public function __construct($username = "guest", $usertype = "user") {
        $this->username = $username;
        $this->usertype = $usertype;
    }

    public function execute($command) {
        ($this->_func)($command);
    }

    public function authenticate() {
        return $this->usertype === "admin";
    }

    public function getUserInfo() {
        return "User: " . $this->username . " | Type: " . $this->usertype;
    }

    // Getter methods for private properties
    public function getUsertype() {
        return $this->usertype;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getFunc() {
        return $this->_func;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __unset($name) {
        if (is_object($this->data[$name])) {
            $method = $this->method;
            $this->data[$name]->$method($this->member);
        } else {
            unset($this->data[$name]);
        }
    }
}