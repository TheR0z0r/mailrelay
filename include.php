<?php
    /*
    // This file contains the core functions
    // No need to touch...
    */
    require_once "validate.php";
    require_once "config/config.php";

    // entry point
    function mailrelay_send($postData){
        if( !mailrelay_validate_forms() ){
            die('One or more errors detected in the settings. Unable to deliver mail.');
        }

        // checking if form_id from postData exists
        // if anonymous submissions is allowed, load defaults
        if( !mailrelay_get_form( $postData ) ){
            if( ALLOW_ANONYMOUS == true ){
                $form = array(
                    'validate'  => false,
                    'emails'    => array( DEFAULT_EMAIL ),
                    'redirect'  => DEFAULT_REDIRECT,
                    'from'      => DEFAULT_FROM,
                    'title'     => DEFAULT_TITLE
                );
            }else{
                die('Unable to load form.');
            }
        } else {
            $form = mailrelay_get_form( $postData );
        }

        $headers = mailrelay_generate_headers( $form );
        $email = mailrelay_generate_email( $postData );

        global $emails;
        $send_result = array();
        foreach( $form['emails'] as $address ){
            $send_result[] = mail( $emails[$address], $form['title'], $email, $headers );
        }
        if( in_array( false, $send_result ) ){
            die("One or more emails failed to be delivered.");
        } else {
            header("location: ".$form['redirect']);
        }
    }

    // Check settings for forms and emails before proceeding
    function mailrelay_validate_forms(){
        global $forms;
        global $emails;

        if( !isset( $forms ) || !isset( $emails ) ){
            return false;
        }

        // checking email addresses
        foreach( $emails as $key => $email ){
            if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
                return false;
            }
        }

        // checking that forms have valid settings
        foreach( $forms as $key => $form ){
            if( !array_key_exists( 'validate', $form ) || !array_key_exists( 'emails', $form ) || !array_key_exists( 'redirect', $form ) || !array_key_exists( 'title', $form ) ){
                return false;
            }else{
                // checking that email exists where form points to
                foreach( $form['emails'] as $email ){
                    if( !array_key_exists( $email, $emails ) ){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function mailrelay_get_form($postData){
        global $forms;

        if( !isset( $postData['mailrelay_form_id'] ) || !array_key_exists( $postData['mailrelay_form_id'], $forms ) ){
            return false;
        }

        return $forms[$postData['mailrelay_form_id']];
    }

    function mailrelay_generate_email($postData){
        $message = array();
        foreach($postData as $key => $value){
            if( $key != 'mailrelay_form_id' && $key != 'mailrelay_submit'){
                $message[] = $key.': '.$value;
            }
        }
        return implode("\r\n", $message);
    }

    function mailrelay_generate_headers( $form ) {
        $headers = array();
        $headers[] = 'Content-Type: text/plain; charset=utf-8';
        $headers[] = 'From: '.$form['from'];
        $headers[] = 'X-Priority: 1';
        $headers[] = 'MIME-Version: 1.0';
        return implode("\r\n", $headers);
    }
?>
