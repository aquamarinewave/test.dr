<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "maryna.medynska@gmail.com";
    $email_subject = "Новий запит на прийом";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Phone'])
    ) {
        problem('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $phone = $_POST['Phone']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Вкажіть вірно Ваш Email.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= "Вкажіть Ваше І'мя.<br>";
    }
    if (preg_match("/^\+380\d{3}\d{2}\d{2}\d{2}$/", $phone)) {
        $error_message .= 'Вкажіть вірно номер телефону.<br>'; 
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Данні клієнта.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "І'мя: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Телефон: " . clean_string($phone) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TR-лікар психіатр</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./fonts/fontawesome-free-5.15.1-web/css/all.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-01MJ161R5E"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-01MJ161R5E');
    </script>

</head>
<body>
    <header>
        <div class="header-wrapp">
            <div class="header"> 
                <div class="logo-container">
                    <img class="logo" src="./image/logo.png" alt="TR-logo">
                </div>

                <div class="mob-menu">
                    <input type="checkbox" id="hmt" class="hidden-menu-ticker">
                    <label class="btn-menu" for="hmt">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                    </label>
                    <ul class="hidden-menu">
                        <li><a href="#top">Головна</a></li>  
                    </ul>
                </div>

                <div class="menu">
                    <a href="./index.html">Головна</a>
                </div>

            </div>
        </div>
    </header> 
    <!-- include your success message below -->

    <div class="thanks-container">
        <div class="thanks-message" style="padding: 250px 100px 0 100px; text-align: center; font-weight: bold;">Дякуємо. Ми отримали Ваш запит на прийом. Найближчим часом зв'яжемось з Вами для  визначення дати і часу візиту </div>
    </div>

    <div><a style="test-decoration:none; font-size: 20px; font-weight: bold; color: #fff; backgroung: rgb(55, 37, 99); padding: 10px 10px;" href="./index.html">Повернутись на головну</a></div>

<?php
}
?>