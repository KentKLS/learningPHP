<?php
class Customer{
    public string $customer_lastname, $customer_firstname, $customer_address, $customer_city;
    public int $customer_zipcode;

    function __construct($customer_lastname, $customer_firstname, $customer_address, $customer_zipcode, $customer_city){
        $this->customer_lastname = $customer_lastname;
        $this->customer_firstname= $customer_firstname;
        $this->customer_address= $customer_address;
        $this->customer_zipcode= $customer_zipcode;
        $this->customer_city= $customer_city;

    }


}