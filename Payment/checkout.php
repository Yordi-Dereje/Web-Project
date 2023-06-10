<?php
session_start();
include("./connect.php");

if (isset($_POST['checkout']) && isset($_POST['cart_item_id'])) {
    //first update the cart quantity in the database
    for ($i = 0; $i < count($_POST['cart_item_id']); $i++) {
        $cart_item_id = $_POST['cart_item_id'][$i];
        $quantity = $_POST['quantity'][$i];
        if ($_POST['quantity'][$i] == '') {
            $quantity = 0;
        }
        $query = "CALL update_cart_items_quantity($cart_item_id, $quantity);";
        $connection = $conn->getConnection();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            header("Location: ../template/cart.php?error=1");
        }
    }

    //then make the transaction/order
    if (isset($_POST['checkout'])) {
        echo "checkout";
        //create order from cart for the user
        $user_id = $_SESSION['id'];
        $query = "CALL `create_order_from_cart`($user_id);";
        $connection = new connect;
        $connection = $connection->getConnection();
        $result = mysqli_query($connection, $query);
        $shop_order_id = $result->fetch_assoc()['tran_id'];
        //update shop order total
        $con2 = new connect;
        $con2 = $con2->getConnection();
        $query = "CALL update_shop_order_total($shop_order_id)";
        $result = mysqli_query($con2, $query);
        //get customer info and total from the order
        $query = "CALL `getTransactionInfo`($shop_order_id);";
        $connection = $conn->getConnection();
        $result2 = mysqli_query($connection, $query);
        $customer_fname = "";
        $customer_lname = "";
        $customer_email = "";
        $total;
        if ($row = $result2->fetch_assoc()) {
            $customer_fname = $row['first_name'];
            $customer_lname = $row['last_name'];
            $customer_email = $row['email'];
            $total = $row['total'];
        }
        // test code
        // echo "customer name: " . $customer_fname . "<br>";
        // echo "customer name: " . $customer_lname . "<br>";
        // echo "customer email: " . $customer_email . "<br>";
        // echo "total: " . $total . "<br>";
        // echo "ref_id: " . $shop_order_id . "<br>";

        $post_field = json_encode(
            [
                "amount" => $total,
                "currency" => "ETB",
                "email" => $customer_email,
                "first_name" => $customer_fname,
                "last_name" => $customer_lname,
                "tx_ref" => $shop_order_id,
                "callback_url" => "https://webhook.site/077164d6-29cb-40df-ba29-8a00e59a7e60",
                "return_url" => "http://localhost/jimla/template/purchase_info.php?ref_id=$shop_order_id",
                "customization[title]" => "Payment from Jimla Online Shop",
                // "customization[description]" => "I love online payments.",
                // "customization[logo]" => "../assets/image/logo/png/logo-color2.png"
            ]
        );
        echo "post_field: " . $post_field . "<br>";
        if ($result) {
            $curl = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.chapa.co/v1/transaction/initialize',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $post_field,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer CHASECK_TEST-9LS9lhxiepeE8UmN0T3kRecOUw7dnGE6',
                        'Content-Type: application/json'
                    ),
                )
            );

            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
            $response = json_decode($response);
            if ($response->status == "success") {
                header("Location: " . $response->data->checkout_url);
            } else {
                header("Location: ../template/cart.php?error=4");
            }
        } else {
            header("Location: ../template/cart.php?error=2");
        }
    } else {
        echo "not checkout";
    }
} else {
    header("Location: ../template/cart.php?error=3");
}