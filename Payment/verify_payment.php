<?php
include_once "connect.php";

if (isset($_GET["ref_id"])) {
    $ref_id = $_GET["ref_id"];
    $curl = curl_init();

    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => "https://api.chapa.co/v1/transaction/verify/$ref_id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer CHASECK_TEST-9LS9lhxiepeE8UmN0T3kRecOUw7dnGE6'
            ),
        )
    );

    $response = curl_exec($curl);

    curl_close($curl);

    if (isset($response)) {
        $response = json_decode($response);
        if ($response->data->status = "success") {
            $conn = new connect;
            $conn = $conn->getConnection();
            $query = "CALL verify_payment($ref_id)";
            $result = mysqli_query($conn, $query);
        }
    } else {
        echo "error";
    }
    // echo $response;

} else {
    echo "Ref_id is null.";
}
?>