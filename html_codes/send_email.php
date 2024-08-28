<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $csv = $_FILES['csv']['tmp_name'];
    $to = 'joinme.next@gmail.com';
    $subject = 'New RSVP Submission';
    $message = 'Please find the attached CSV file with the new RSVP submission.';
    $headers = 'From: no-reply@nepalicommunity.com' . "\r\n" .
               'Reply-To: no-reply@nepalicommunity.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    $attachment = chunk_split(base64_encode(file_get_contents($csv)));
    $filename = 'rsvp.csv';

    $boundary = md5(time());

    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"' . "\r\n";

    $body = '--' . $boundary . "\r\n";
    $body .= 'Content-Type: text/plain; charset=ISO-8859-1' . "\r\n";
    $body .= 'Content-Transfer-Encoding: 7bit' . "\r\n\r\n";
    $body .= $message . "\r\n";
    $body .= '--' . $boundary . "\r\n";
    $body .= 'Content-Type: application/octet-stream; name="' . $filename . '"' . "\r\n";
    $body .= 'Content-Transfer-Encoding: base64' . "\r\n";
    $body .= 'Content-Disposition: attachment; filename="' . $filename . '"' . "\r\n\r\n";
    $body .= $attachment . "\r\n";
    $body .= '--' . $boundary . '--';

    if (mail($to, $subject, $body, $headers)) {
        echo 'Email sent successfully.';
    } else {
        echo 'Email sending failed.';
    }
}
?>

