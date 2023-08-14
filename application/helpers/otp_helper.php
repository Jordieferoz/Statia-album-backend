<?php

function sendsms($email, $message)
{
    // $from = 'info@statiamultimedialibrary.com';//'statiagallery@gmail.com';
    // $ci = &get_instance();

    // $ci->load->library('email');
    // $config = array();
    // $config['protocol']     = "smtp";
    // $config['smtp_host']    = "mail.statiamultimedialibrary.com";
    // $config['smtp_user']    = $from;
    // $config['smtp_pass']    = "V;c7n}+hZY3@";//"Stati@dmin";
    // $config['smtp_port']    =  465;
    // $config['smtp_crypto']  = 'ssl';
    // $config['smtp_timeout'] = "";
    // $config['mailtype']     = "html";
    // $config['charset']      = "iso-8859-1";
    // $config['newline']      = "\r\n";
    // $config['wordwrap']     = TRUE;
    // $config['validate']     = FALSE;
    // $ci->email->initialize($config);

    // $message = 'Hello,\nPlease use this OTP for your account. \n\n OTP: ' . $vars['var1'];
    // $ci->email->set_newline("\r\n");
    // $ci->email->from($from);
    // $ci->email->to($email);
    // $ci->email->subject('Mail from Statia Pictures');
    // $ci->email->message($message);
    // if ($ci->email->send()) {
    //     echo 'Email sent.';
    // } else {
    //     echo ($ci->email->print_debugger());
    // }

    $from = 'info@statiamultimedialibrary.com';//'statiagallery@gmail.com';
    $ci = &get_instance();
    $ci->load->library("email");
    $configEmail = array(
        'useragent' => "CodeIgniter",
        'mailpath'  => "/usr/bin/sendmail", // or "/usr/sbin/sendmail"
        'protocol'  => 'smtp',
        'smtp_host' => 'mail.statiamultimedialibrary.com',// URL check: http://www.yetesoft.com/free-email-marketing-resources/godaddy-pop-smtp-server-settings/,
        'smtp_port' => 465, // Usually 465
        'smtp_crypto' => 'ssl', // or tls
        'smtp_user' => 'info@statiamultimedialibrary.com',
        'smtp_pass' => 'V;c7n}+hZY3@',
        'mailtype'  => 'html',
        'charset'   => 'utf-8',
        'newline'   => "\r\n"
    );
    //Load config
    $ci->email->initialize($configEmail);
    $ci->email->from($from);
    $ci->email->to($email);
    $ci->email->subject('Statia Multimedia Library');
    $ci->email->message($message);
    $ci->email->send();

    // See result
    echo $ci->email->print_debugger();
}
