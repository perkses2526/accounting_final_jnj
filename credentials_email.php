<?php

$email_accounts = [
    ['username' => 'admin@salary-sync.com', 'password' => 'Salarysync*2024'],
    ['username' => 'admin2@salary-sync.com', 'password' => 'Salarysync*2024'],
    ['username' => 'admin3@salary-sync.com', 'password' => 'Salarysync*2024']
];

function send_email($subject, $body = "", $email, $path = "", $mail)
{
    global $email_accounts, $current_account_index, $errors;
    while (true) {
        try {
            $active_account = $GLOBALS['active_account'];
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.hostinger.com'; // Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = $active_account['username']; // Set username from the active account
            $mail->Password   = $active_account['password']; // Set password from the active account
            /*         $mail->Username   = 'admin@salary-sync.com'; // SMTP username
        $mail->Password   = 'Salarysync*2024';           // SMTP password */
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom($active_account['username'], 'Salary-Sync');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->clearAttachments();
            if ($path != "") {
                $mail->addAttachment($path);
            }
            /* $mail->AltBody = 'This is the body in plain text for non-HTML mail clients'; */

            $mail->send();
            // Clear attachments and unset sensitive variables after success
            $mail->clearAttachments();
            $mail->clearAttachments();
            $mail->smtpClose();
            unset($active_account['username']);
            unset($active_account['password']);
            unset($mail);
            unset($email);
            unset($body);
            return json_encode(
                array(
                    'message' => 'Message has been sent',
                    'status'  => 'success'
                )
            );
        } catch (Exception $e) {
            $mail->clearAttachments();
            $mail->smtpClose();

            unset($active_account['username']);
            unset($active_account['password']);
            unset($mail);
            unset($email);
            unset($body);

            $current_account_index++;
            $errors .= $active_account['username']  . ': ' . $e->getMessage() . '<br>';
            // Check if we've run out of accounts
            if ($current_account_index >= count($email_accounts)) {
                // If all accounts fail, return error response
                return json_encode(
                    array(
                        'message' => $errors . '<br><br>All email accounts have reached their limit. <br>Mailer Error: ' . $e->getMessage(),
                        'status'  => 'error'
                    )
                );
            }

            // Switch to the next account
            $GLOBALS['active_account'] = $email_accounts[$current_account_index];

            // Retry sending the email with the new account
            /*    return json_encode(
                array(
                    'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
                    'status'  => 'error'
                )
            ); */
        }
    }
}