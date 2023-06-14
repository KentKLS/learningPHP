<?php
require_once 'customer.php';
require_once 'database.php';

class CustomersList {
    public array $customersList ;
    
    function __construct(){
        $db = new PDO('mysql:host=localhost;dbname=new_e-commerce;charset=utf8', 'Quentin', '');
        $customers = $this->getCustomers($db);
        foreach($customers as $customer){
            $this->customersList[]= new Customer($customer['customer_lastname'],$customer['customer_firstname'],$customer['customer_address'],$customer['customer_zipcode'],$customer['customer_city']);
        }
    }

    public function getCustomers(pdo $db):array
    {
        $selectCustomers = $db->prepare(
            "SELECT *
            FROM customers"
        );
        $selectCustomers->execute();
        $customers = $selectCustomers->fetchAll($mode = PDO::FETCH_ASSOC);
        return $customers;

    }
}