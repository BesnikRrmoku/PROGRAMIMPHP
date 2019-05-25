<?php 

include('../db.php');

session_start();

$obj = new Shopping();


// varesishte nga ky parameter dihet se cili funksion i klases shoping do te 
// thirret dhe pastaj
// mirren te dhenat nga sesionet perkate dhe ruhen te dhenat ne databaze.
$q = $_GET['q'];

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array(); 
    $_SESSION['proID'] = 0;
}
if($q == 'addtocart'){
    $product = $_POST['product'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $obj->addtocart($product,$price,$qty);
}else if($q == 'emptycart'){
    unset($_SESSION['cart']); 
    unset($_SESSION['proID']); 
    header("location:../cart.php");
}else if($q == 'removefromcart'){
    $id = $_GET['id'];
    $obj->removefromcart($id);
}else if($q == 'updatecart'){
    $id = $_GET['id'];
    $qty = $_POST['qty'];
    $obj->updatecart($id,$qty);
}else if($q == 'countcart'){
    $obj->countcart();
}else if($q == 'countorder'){
    $obj->countorder();
}else if($q == 'countproducts'){
    $obj->countproducts();
}else if($q == 'countcategory'){
    $obj->countcategory();
}else if($q == 'checkout'){
    $obj->checkout();
}else if($q == 'verify'){
    $obj->verify();   
}

class Shopping {   

    // te gjitha keto funksione te klases shoping thirren nga onclick ngjarjet 
    // kryesishte keto ngjarje jane nga karta por ka edhe te logini etj.
    function addtocart($product, $price, $qty){
        $cart = array(
            'proID' => $_SESSION['proID'],
            'product' => $product,
            'price' => $price,
            'qty' => $qty
        );
        $_SESSION['proID'] = $_SESSION['proID'] + 1;
        array_push($_SESSION['cart'],$cart); 
        
        return true;
    }
    
    function removefromcart($id){        
        $_SESSION['cart'][$id]['qty'] = 0;
        //print_r($_SESSION['cart'][$id]['qty']);
        header("location:../cart.php");
    }
    
    function updatecart($id,$qty){
        $_SESSION['cart'][$id]['qty'] = $qty;      
        
       header("location:../cart.php");
    }
    
    function countcart(){
        $count = 0;
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart']:array();
        foreach($cart as $row){
            if($row['qty']!=0){
                $count = $count + 1;
            }            
        }

        echo $count;   
    }

    function countorder(){
        try {
            $db = Databasei::getInstance();
            $mysqli = $db->getConnection();

            $q = "select * from giftshopdb.order where status='unconfirmed'";
            $result = $mysqli->query($q);            
            echo mysqli_num_rows($result);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    function countproducts(){        
        $db = Databasei::getInstance();
        $mysqli = $db->getConnection();

        $q = "select * from giftshopdb.products";
        $result = $mysqli->query($q);
        echo mysqli_num_rows($result);
    }

    function countcategory(){
        $db = Databasei::getInstance();
        $mysqli = $db->getConnection();

        $q = "select * from giftshopdb.category";
        $result = $mysqli->query($q);
        echo mysqli_num_rows($result);
    }
    
    function checkout(){
        //include('../db.php');
        $db = Databasei::getInstance();
        $mysqli = $db->getConnection();

        $fname = $_POST['fname'];   
        $lname = $_POST['lname'];   
        $contact = $_POST['contact'];   
        $email = $_POST['email'];   
        $address = $_POST['address'];   
        $fullname = $fname.' '.$lname;
        $date = date('m/d/y h:i:s A');
        $item = '';
        foreach($_SESSION['cart'] as $row){
            if($row['qty'] != 0){
                $product = '('.$row['qty'].') '.$row['product'];
                $item = $product.', '.$item;
            }
        }
        $amount = $_SESSION['totalprice'];
        echo $q = "INSERT INTO giftshopdb.order VALUES (NULL, '$fullname', '$contact', '$address', '$email', '$item', '$amount', 'unconfirmed', '$date', '')";
        
        $mysqli->query($q);
        
        unset($_SESSION['cart']); 
        header("location:../success.php");
    }    
    
    function verify(){  

        $db = Databasei::getInstance();
        $mysqli = $db->getConnection();

        $username = $_POST['username'];   
        $password = $_POST['password'];

        $q = "SELECT * from giftshopdb.user where username='$username' and password='$password'";
        $result = $mysqli->query($q);       
        $_SESSION['login']='yes';
        echo mysqli_num_rows($result);
    }
}

?>