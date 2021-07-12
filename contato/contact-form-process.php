<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "victor.abreu.pessanha@gmail.com";
    $email_subject = "New form submissions";

    function problem($error)
    {
        echo "Nos desculpe, mas algum erro ocorreu.";
        echo "Este erro aparece embaixo.<br><br>";
        echo $error . "<br><br>";
        echo "Por favor conserte esse erro.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Nos desculpe, mas algum erro ocorreu.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'O endereço de E-mail que você inseriu não parece ser válido.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'O nome inserido não é válido.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'A mensagem inserida não é válida.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Detalhes do formulário embaixo.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nome: " . clean_string($name) . "\n";
    $email_message .= "E-mail: " . clean_string($email) . "\n";
    $email_message .= "Mensagem: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'De: ' . $email . "\r\n" .
        'Responder para: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Obrigado por nos contatar. Entraremos em contato com você em breve.

<?php
}
?>