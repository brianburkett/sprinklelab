<?php

add_action( 'wp_ajax_add_email_to_list', 'addEmailToList' );
add_action( 'wp_ajax_nopriv_add_email_to_list', 'addEmailToList' );

function addEmailToList() {
	$email = $_POST['email'];

	$apikey = 'f1d36ce3283e99029743af5bd4553426-us2';
	$listID = '775301d5a9';
	$fields_string = null;
	$arr['code'] = null;
	$errorMessage = null;

	$fields = array(
		'apikey' => urlencode($apikey), 
		'id' => urlencode($listID), 
		'email[email]' => urlencode($email),
		'output' => 'json'
		);	
	foreach ($fields as $key => $value) { 
		$fields_string .= $key . '=' . $value . '&'; 
	}
	rtrim($fields_string, '&');
	$url = 'https://us2.api.mailchimp.com/2.0/lists/subscribe';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	$data = curl_exec($ch);
	$arr = json_decode($data, true);
	curl_close($ch);

	$success = true;

	if (!isset( $arr['code'] )) {
		$success = true;
		$arr['code'] = null;
	} else {
	    switch ($arr['code']) {
	        case 214:
	        	$success = false;
	        	$errorMessage = 'You are already subscribed.';
	        	break;
	        default:
	        	$success = false;
	        	$errorMessage = 'There was an error. Try again later.';
	       		break;          
	    }
	}

	generateResponse($success, $arr['code'], $errorMessage);
}

function generateResponse($success, $errorCode = null, $errorMessage = null)
{

    $response = (object)array(
        'success' => $success,
        'errorCode' => $errorCode,
        'errorMessage' => $errorMessage
    );

    print json_encode($response);

    exit();
}
?>