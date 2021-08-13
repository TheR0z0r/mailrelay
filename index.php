<?php
    /*
    // Mailrelay v.1.0
    // Author: Juho Taskila
    // License: GNU General Public License
    // Requirements: Your PHP(7->) installation has to be able to send email messages
    */
    require_once "include.php";
    if( isset( $_POST['mailrelay_submit'] )){
        mailrelay_send($_POST);
    }
?>
