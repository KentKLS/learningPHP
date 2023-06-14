<?php
include 'header.php';
include './database/customersList.php';
$customersList = new CustomersList;
$customers= $customersList->getCustomers($db);

?>

<div>

    <table>
        <thead>
            <th>Customer Lastname</th>
            <th>Customer Firstname</th>
            <th>Customer Address</th>
            <th>Customer City</th>
            <th>Customer Zipcode</th>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) :
            // var_dump($customer)
            ?>
            
                <tr>
                    <td><?= $customer['customer_lastname'] ?></td>
                    <td><?= $customer['customer_firstname'] ?></td>
                    <td><?= $customer['customer_address'] ?></td>
                    <td><?= $customer['customer_zipcode'] ?></td>
                    <td><?= $customer['customer_city'] ?></td>                    
                </tr>
            <?php
            endforeach
            ?>
        </tbody>

    </table>




</div>

<?php
include 'footer.php';
?>