<?php
    class User {
        protected $name;
        protected $age;

        public function __construct($name, $age) {
            $this->name = $name;
            $this->age = $age;
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function __set($property, $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
            return $this;
        }

        public function sayHello() {
            return $this->name . " Says Hello";
        }

        public function __destruct() {
            echo "class: " . __CLASS__ . " destructed <br />";
        }
    }

    class Customer extends User {
        private $balance;
        private static $minBalance = 10;

        public function __construct($name, $age, $balance) {
            $this->balance = $balance;
            parent::__construct($name, $age);
        }

        public function pay($amount) {
            return $this->name . " paid $" . $amount;
        }

        public static function validateBalance() {
            echo self::$minBalance;
        }
    }

    $user1 = new User("Kohei", 44);
    echo $user1->getName();
    echo "<br />";

    echo $user1->__get("name");
    echo "<br />";

    $user1->__set("age", 45);
    echo $user1->__get("age");
    echo "<br />";

    echo $user1->sayHello();
    echo "<br />----------<br />";

    $customer = new Customer("Brad", 35, 150);
    echo $customer->pay(100);
    echo "<br />";
    Customer::validateBalance();
    echo "<br />----------<br />";
?>