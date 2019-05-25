<?php

/** Custom SMTP */


/** Custom SMTP */
add_action('phpmailer_init', 'custom_mail_smtp_server');
function custom_mail_smtp_server($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->IsHTML(true);
    $phpmailer->Host = 'smtp.mandrillapp.com';
    $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
    $phpmailer->Port = 25;
    $phpmailer->Username = 'info@timevn.com';
    $phpmailer->Password = 'tlz_iDddZN4anbRHy2HiRA';
    $phpmailer->SMTPSecure = "tls"; // Choose SSL or TLS, if necessary for your server
    $phpmailer->From = 'info@timevn.com';
    $phpmailer->FromName = 'Time Universal';
    $phpmailer->SetFrom("info@timevn.com", "Time Universal");
    //$phpmailer->SMTPDebug  = 1;
}