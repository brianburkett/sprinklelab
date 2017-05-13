<?php 
	require_once( ABSPATH . '/wp-includes/class-phpmailer.php' );
	require_once( ABSPATH . '/wp-includes/class-smtp.php' );

    add_action( 'wp_ajax_send_email', 'sendEmail' );
	add_action( 'wp_ajax_nopriv_send_email', 'sendEmail' );

    function sendEmail() {
	    $data = $_POST["data"];

			$phpmailer = new PHPMailer();

      $phpmailer->isSMTP();
 
	    // The hostname of the mail server
	    $phpmailer->Host = "smtp.gmail.com";
	 
	    // Use SMTP authentication (true|false)
	    $phpmailer->SMTPAuth = true;
	 
	    // SMTP port number - likely to be 25, 465 or 587
	    $phpmailer->Port = "587";
	 
	    // Username to use for SMTP authentication
	    $phpmailer->Username = "hello@sprinklelab.com";
	 
	    // Password to use for SMTP authentication
	    $phpmailer->Password = "100fuck99";
	 
	    // The encryption system to use - ssl (deprecated) or tls
	    $phpmailer->SMTPSecure = "tls";
	    $phpmailer->Subject    = 'Sprinkle Lab Contact Form';


	     foreach ($data as $key => $value) {
	    	$phpmailer->Body .= "$key: $value\n"; 
	    }

	    $phpmailer->AddAddress("cameron@sprinklelab.com");
	 
	    $phpmailer->From = $data['Email'];
	    $phpmailer->FromName = $data['Name'];
		$message = null;

        if($phpmailer->Send()) {
	      $message = 'success';
	    } else {
	      $message = 'error';
	    }
 
 		print $message;
	    exit();
    }
?>