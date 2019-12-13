<?php
$to = 'test@sher.biz';
//$to = "rentcargroup@privateisrael.com"; // this is your Email address
$reqemail = "rentcargroup@privateisrael.com";
$name = !empty($_POST['name']) ? filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING) : '';
$from = !empty($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : $to;

$phone = $_POST['phone'];
$car_select = $_POST['car-select'];
$pickup_location = $_POST['pickup-location'];
$pickup_date = $_POST['pickup-date'];
//#$pickup_time = $_POST['pickup-time'];
//#$dropoff_location = $_POST['dropoff-location'];
//$dropoff_date = $_POST['dropoff-date'];
//#$dropoff_time = $_POST['dropoff-time'];


$subject = $_POST['name'] . " " . $_POST['car-select'] . " " . "rentalcarsisrael.com";
//$message = '<html lang="ru"><body>';
//$message .= '<hr />';
//$message .= 'Rental car Israel http://www.rentalcarsisrael.com +972-58-7710101';
//$message .= '<hr />';
//$message .= '<img src="http://www.rentalcarsisrael.com/images/europcar.jpg" alt="Rental car Israel +972-58-7710101" />';
//$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message = "Name:" . strip_tags($_POST['name']);
//$message .= "<tr style='background: #eee;'><td><strong>Last Name:</strong> </td><td>" . strip_tags($_POST['Last_name']) . "</td></tr>";
$message .= "Email " . strip_tags($_POST['email']);
$message .= "Phone " . strip_tags($_POST['phone']);
$message .= "Car Category: " . strip_tags($_POST['car-select']);
$message .= "Pickup location: " . strip_tags($_POST['pickup-location']);
$message .= "Pickup date: " . strip_tags($_POST['pickup-date']);
//#$message .= "<tr style='background: #eee;'><td><strong>Pickup time:</strong> </td><td>" . strip_tags($_POST['pickup-time']) . "</td></tr>";
//#$message .= "<tr style='background: #eee;'><td><strong>Dropoff location:</strong> </td><td>" . strip_tags($_POST['dropoff-location']) . "</td></tr>";
//#$message .= "<tr style='background: #eee;'><td><strong>Dropoff date:</strong> </td><td>" . strip_tags($_POST['dropoff-date']) . "</td></tr>";
///#$message .= "<tr style='background: #eee;'><td><strong>Dropoff time:</strong> </td><td>" . strip_tags($_POST['dropoff-time']) . "</td></tr>";
//#$message .= "<tr><td><strong>Age:</strong> </td><td>" . strip_tags($_POST['age']) . "</td></tr>";
//#$message .= "<tr><td><strong>Driver Experience:</strong> </td><td>" . strip_tags($_POST['DriverExperience']) . "</td></tr>";
//#$message .= "<tr><td><strong>SuperCDW:</strong> </td><td>" . strip_tags($_POST['SuperCDW']) . "</td></tr>";
//#$message .= "<tr><td><strong>SuperTP:</strong> </td><td>" . strip_tags($_POST['SuperTP']) . "</td></tr>";
//#$message .= "<tr><td><strong>Children seat:</strong> </td><td>" . strip_tags($_POST['childseat']) . "</td></tr>";
// $message .= "<tr><td><strong>GPS:</strong> </td><td>" . strip_tags($_POST['GPS']) . "</td></tr>";
// $message .= "<tr><td><strong>Roadsafe:</strong> </td><td>" . strip_tags($_POST['RoadSafe']) . "</td></tr>";
//$message .= "<tr><td><strong>Additional driver:</strong> </td><td>" . strip_tags($_POST['addDriver']) . "</td></tr>";
//$message .= "<tr><td><strong>Tour:</strong> </td><td>" . strip_tags($_POST['tour']) . "</td></tr>";
//$message .= "<tr><td><strong>message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
//$message .= "</table>";
//$message .= "</body></html>";


//#$subject = !empty($_POST['subject']) ? filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING) : '';
//#$message = !empty($_POST['message']) ? filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING) : '';

$body = "Name: {$name}\r\nEmail: {$from}\r\nMessage: {$message}";

//$body = wordwrap($body, 70, "\r\n");

$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=utf-8',
    "From: $name <$from>",
    "Reply-To: <$from>",
    "Subject: $subject",
    'X-Mailer: PHP/' .phpversion()
];

$success = @mail($to, $subject, $body, implode('\r\n', $headers));

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    die(json_encode(['success' => $success]));
}

echo $success ? 'Sent Successfully.' : 'An error occurred';

