<?php
    /*
    // Configuration for MailRelay
    */

    define('ALLOW_ANONYMOUS', false);
    define('DEFAULT_EMAIL', 'email_1');
    define('DEFAULT_REDIRECT', 'success.php');
    define('DEFAULT_TITLE', 'Message from MailRelay');
    define('DEFAULT_FROM', 'mailrelay@'.$_SERVER['HTTP_HOST']);

    // specify all email addresses to send messages to
    $emails = array(
        'email_1' => 'email@email',
    );

    // form ids
    // id has to be specified if ALLOW_ANONYMOUS flas is false
    $forms = array(
        "form_1" => array(
            'validate'  => true,
            'title'     => 'Message from test form 1',
            'emails'    => array( 'email_1' ),
            'from'      => DEFAULT_FROM,
            'redirect'  => DEFAULT_REDIRECT
        ),
    );
?>
