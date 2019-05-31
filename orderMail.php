<?php

  if (isset($_POST['order_sbmt'])) {
    $items = array("QT-Atta_500g", "QT-Panjeeri_250g", "QT-Panjeeri_100g", "QT-Sev_250g", "QT-Sev_100g", "QT-Cookies_4");

    $admin_num = $_POST['number'];
    $chd_name = $_POST['child'];
    $person = $_POST['person'];

    if (strcmp($person, "Teacher") == 0) {
      $admin_num = "N/A";
      $chd_name = "N/A";
    }	

    $price = $_POST['price'];
    $name = $_POST['name'];
    $phone_num = $_POST['phone'];
    $hidden_fields = "";

    foreach ($items as $qt) {
      if (isset($_POST[$qt])) {
        $hidden_fields .= "Quantity of " . substr($qt, 3) . " is " . $_POST[$qt] . "\r\n";
      }
    }

    // Create the email and send the message

    $separator = "\r\n\r\n---------------------------------------------------\r\n\r\n";
    $to = "manisha.trivedi@sbs-school.org,keshar.mehra@sbs-school.org"; // Email address between the '' - This is where the form will send a message to, with or without the password!!
    $email_subject = "A new request for prebooking Madua Atta has been received from a $person!";
    $email_body = "You have received a new message from your website contact form.\r\n\r\nHere are the details he/she has provided:\r\n\r\nName: $name\r\nContact Info: $phone_num\r\n\r\nThe $person's child's name: $chd_name\r\nThe child's admission number: $admin_num\r\n\r\n$hidden_fields\r\nTotal cost of order: $price\r\n\r\n~ Automated Message from SAHYOG";
    $headers = "From: sahyog@sbs-school.org\n"; // This is the email address the generated message will be from.

    mail($to, $email_subject, $email_body, $headers);

    // Add this order to the text file too

    $file = fopen("allOrders.txt", "a");
    fwrite($file, ($email_body . $separator));
    fclose($file);
    
  } else {
    echo "Access Denied! This is a secret page, you cannot just open it like that!";
  }

  header ("Location: madua.html#buy");
  return true;
  
?>