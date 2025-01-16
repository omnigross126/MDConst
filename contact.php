<?php
$indexfile='index.html';
$contactfile='contact.html';

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $phone= $_POST['phone'];
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        

        // Check that data was sent to the mailer.
        if ( empty($name)  OR empty($phone) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "<h1>Please complete the form.</h1>";
            echo '<a href="' . $contactfile . '"><h2>Click here to try again</h2></a>';
            exit;
        }

       // if(isset($_POST['g-recaptcha-response'])){
         //   $recaptcha=$_POST['g-recaptcha-response'];
        
        //if(!$recaptcha){
         //   echo 'Please check recaptcha box';
          //  exit;

        
       



        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "sanjivanimore315@gmail.com";
        // $recipient = "sanjivani.s.more@gmail.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "Name: $name\n\n";
       // $email_content .= "Company Name: $company\n\n";
        $email_content .= "Mobile: $phone\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message: $message\n\n";

        //Build the email headers.
        $email_headers = "From: $name <$email>";

       // $secretKey="6LeqRGQjAAAAANWMcL7yivUmU4VTMBaCOCi2mMcC";
        //$responseKey=$_POST['g-recaptcha-response'];
       // $UserIP=$_SERVER['REMOTE_ADDR'];
       // $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

       // $response = file_get_contents($url);
       // $response = json_decode($response);


        
        if(mail($recipient, $subject, $email_content, $email_headers)){
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "<h1>Thank You! Your message has been sent. </h1> ";
            echo '<a href="' . $indexfile . '"><h2>Please click here to return to home</h2></a>';
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "<h1>Oops! Something went wrong and we couldn't send your message.</h1>";
            echo '<a href="' . $contactfile . '"><h2>Please click here to try again</h2></a>';
        }
    

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "<h1>There was a problem with your submission.</h1>";
        echo '<a href="' . $contactfile . '"><h2>Please click here to try again</h2></a>';
    }


?>
