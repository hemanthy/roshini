    <?php
/**
 * Created by PhpStorm.
 * User: heman
 * Date: 2/15/2017
 * Time: 4:57 PM
 */

include_once ('proxy.php');


include_once '/pojo/FlipkartOrderDetailsPOJO.php';

// include_once ('');



//$jsonObj = json_decode($result);
//$mydata = json_decode($result,true);


  //  $json2 = '{"orderList": [  {    "price": 999,    "category": "Personal Care Appliances",    "title": "Philips QT4000 /15 Pro Skin Advanced Trimmer For Men",    "productId": "SHVDPGXHU2XNTYHC",    "quantity": 1,    "sales": {      "amount": 999,      "currency": "INR"    },    "status": "processed",    "affiliateOrderItemId": "39152399",    "orderDate": "26-10-2016 00:36:35",    "commissionRate": 8,    "tentativeCommission": {      "amount": 79.92,      "currency": "INR"    },    "affExtParam1": "435",    "affExtParam2": "",    "salesChannel": "APP",    "customerType": "EXISTING"  },{    "price": 999,    "category": "Personal Care Appliances",    "title": "Philips QT4000 /15 Pro Skin Advanced Trimmer For Men",    "productId": "SHVDPGXHU2XNTYHC",    "quantity": 1,    "sales": {      "amount": 999,      "currency": "INR"    },    "status": "Disapproved",    "affiliateOrderItemId": "39152378",    "orderDate": "26-10-2016 00:36:35",    "commissionRate": 8,    "tentativeCommission": {      "amount": 453543,      "currency": "INR"    },    "affExtParam1": "435",    "affExtParam2": "",    "salesChannel": "APP",    "customerType": "EXISTING"  },{    "price": 999,    "category": "Personal Care Appliances",    "title": "Philips QT4000 /15 Pro Skin Advanced Trimmer For Men",    "productId": "SHVDPGXHU2XNTYHC",    "quantity": 1,    "sales": {      "amount": 256,      "currency": "INR"    },    "status": "processed",    "affiliateOrderItemId": "391523933",    "orderDate": "26-10-23 00:36:3",    "commissionRate": 8,    "tentativeCommission": {      "amount": 32,      "currency": "INR"    },    "affExtParam1": "589",    "affExtParam2": "23",    "salesChannel": "APP",    "customerType": "EXISTING"  },{    "price": 999,    "category": "Personal Care Appliances",    "title": "Philips QT4000 /15 Pro Skin Advanced Trimmer For Men",    "productId": "SHVDPGXHU2XNTYHC",    "quantity": 1,    "sales": {      "amount": 256,      "currency": "INR"    },    "status": "processed",    "affiliateOrderItemId": "3915239332",    "orderDate": "26-10-23 00:36:3",    "commissionRate": 8,    "tentativeCommission": {      "amount": 765,      "currency": "INR"    },    "affExtParam1": "577",    "affExtParam2": "23",    "salesChannel": "APP",    "customerType": "EXISTING"  },{    "price": 999,    "category": "Personal Care Appliances",    "title": "Philips QT4000 /15 Pro Skin Advanced Trimmer For Men",    "productId": "SHVDPGXHU2XNTYHC",    "quantity": 1,    "sales": {      "amount": 256,      "currency": "INR"    },    "status": "processed",    "affiliateOrderItemId": "391523933232",    "orderDate": "26-10-23 00:36:3",    "commissionRate": 8,    "tentativeCommission": {      "amount": 4343,      "currency": "INR"    },    "affExtParam1": "547",    "affExtParam2": "23",    "salesChannel": "APP",    "customerType": "EXISTING"  }],"previous": "","next": "","first": "dfsafdsa","last": "fdsafdsa"}';

    $mydata = json_decode($result,true);

    $jsonObj = json_decode($result);
    $ar = json_decode($result,true);
    $fkdetailArray = array();
    if($ar!=null && !empty($ar) && count($ar) > 0 && count($ar['orderList']) > 0){

        foreach($jsonObj -> orderList as $mydata){
            echo $mydata->sales -> amount . "\n\r";
            $fkpojo = new FlipkartOrderDetailsPOJO();
            if($mydata->price!=null && $mydata->price!=''){
                $fkpojo -> setPrice($mydata->price);
            }else{
                $fkpojo -> setPrice(null);
            }
            $fkpojo -> setCategory($mydata->category);
            $fkpojo -> setTitle($mydata->title);
            $fkpojo -> setProductId($mydata->productId);
            if($mydata->quantity!=null && $mydata->quantity!=''){
                $fkpojo -> setQuantity($mydata->quantity);
            }else{
                $fkpojo -> setQuantity(null);
            }

            if($mydata-> sales -> amount !=null && $mydata-> sales -> amount !=''){
                $fkpojo -> setSalesAmount($mydata->sales -> amount);
            }else{
                $fkpojo -> setSalesAmount(null);
            }

            $fkpojo -> setStatus($mydata->status);
            $fkpojo -> setAffiliateOrderItemId($mydata->affiliateOrderItemId);

            if($mydata->orderDate!=null && $mydata->orderDate!=''){
                $test = new DateTime($mydata->orderDate);
                $fkpojo -> setOrderDate(date_format($test, 'Y-m-d H:i:s'));
            }else{
                $fkpojo -> setOrderDate(null);
            }

            if($mydata->commissionRate!=null && $mydata->commissionRate!=''){
                $fkpojo -> setCommissionRate($mydata->commissionRate);
            }else{
                $fkpojo -> setCommissionRate(null);
            }

            if($mydata-> tentativeCommission -> amount !=null && $mydata-> tentativeCommission -> amount !=''){
                $fkpojo -> setTentativeCommission($mydata-> tentativeCommission -> amount);
            }else{
                $fkpojo -> setTentativeCommission(null);
            }

            if($mydata-> affExtParam1 !=null && $mydata-> affExtParam1 !=''){
                $fkpojo -> setAffExtParam1($mydata-> affExtParam1);
            }else{
                $fkpojo -> setAffExtParam1(null);
            }

            if($mydata-> affExtParam2 !=null && $mydata-> affExtParam2 !=''){
                $fkpojo -> setAffExtParam2($mydata-> affExtParam2);
            }else{
                $fkpojo -> setAffExtParam2(null);
            }


            $fkpojo -> setSalesChannel($mydata->salesChannel);
            $fkpojo -> setCustomerType($mydata->customerType);
            array_push($fkdetailArray,$fkpojo);
        }
    }

    //$mysqli = new mysqli('localhost', 'root', 'root', 'affirmed');
    $storeId = 1;

    foreach ($fkdetailArray as $obj) {
        try{
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO user_store_order_details(category,title,productId,quantity,price,sales_amount,status_type,affiliate_order_id,order_date,commission_rate,tentative_commission_amount,aff_ext_param1,
	aff_ext_param2,sales_channel,customer_type,created_date,store_id) VALUES(:category,:title,:productId,:quantity,:price,:sales_amount,:status_type,:affiliate_order_id,:order_date,:commission_rate,:tentative_commission_amount,:aff_ext_param1,:aff_ext_param2,:sales_channel,:customer_type,:created_date,:store_id) ON DUPLICATE KEY UPDATE category =:category,title=:title,quantity=:quantity,price=:price,sales_amount=:sales_amount,status_type=:status_type,affiliate_order_id=:affiliate_order_id,order_date=:order_date,commission_rate=:commission_rate,tentative_commission_amount=:tentative_commission_amount,aff_ext_param1=:aff_ext_param1,aff_ext_param2=:aff_ext_param2,sales_channel=:sales_channel,customer_type=:customer_type");
            $stmt->bindParam(':category', $obj -> category, PDO::PARAM_STR);
            $stmt->bindParam(':title', $obj -> title, PDO::PARAM_STR);
            $stmt->bindParam(':productId', $obj -> productId,PDO::PARAM_STR);
            $stmt->bindParam(':quantity', $obj -> quantity, PDO::PARAM_INT);
            $stmt->bindParam(':price', $obj -> price, PDO::PARAM_INT);
            $stmt->bindParam(':sales_amount', $obj -> salesAmount, PDO::PARAM_INT);
            $stmt->bindParam(':status_type', $obj -> status, PDO::PARAM_STR);
            $stmt->bindParam(':affiliate_order_id', $obj -> affiliateOrderItemId, PDO::PARAM_STR);
            $stmt->bindParam(':order_date', $obj -> orderDate, PDO::PARAM_STR);
            $stmt->bindParam(':commission_rate', $obj -> commissionRate, PDO::PARAM_STR);
            $stmt->bindParam(':tentative_commission_amount', $obj -> tentativeCommission, PDO::PARAM_STR);
       //     $stmt->bindParam(':aff_ext_param1', $obj -> affExtParam1, PDO::PARAM_INT);
            $affId= 577;
            $stmt->bindParam(':aff_ext_param1', $affId);
            $stmt->bindParam(':aff_ext_param2', $obj -> affExtParam2, PDO::PARAM_INT);
            $stmt->bindParam(':sales_channel', $obj -> salesChannel, PDO::PARAM_STR);
            $stmt->bindParam(':customer_type', $obj -> customerType, PDO::PARAM_STR);
            $stmt->bindParam(':created_date', $currenttime);
            $stmt->bindParam(':store_id', $storeId);
            $stmt->execute();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    $d = array();

    // This appends a new element to $d, in this case the value is another array
    $d[] = array('item' => "dfas" ,'rate' => "dfas");

    $jsonarray = json_encode($d);
    echo $jsonarray;

    try{
        $stmt = $conn->prepare('select * from user_report_details where user_id=:user_id');
        $stmt->execute(array(':user_id' => 1));
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo $row['user_id'];
            echo $row['status'];

        }
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }


    //mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")


    //json_decode($json, true);
    // var_dump(json_decode($json));
    // var_dump(json_decode($json, true));
    ?>