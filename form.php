<?php
    // this is an example form for MailRelay
    // you can remove this file
?>

<html lang="fi">
    <head>
        <meta charset="uft-8">
        <title>MailRelay Example Form</title>
    </head>

    <body>
        <!-- The Actual form -->
        <form method="post" action="index.php">
            <input type="hidden" name="mailrelay_form_id" value="form_1">
            <table>
                <tr>
                    <td><label>Your name:</label></td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td><label>Subject:</label></td>
                    <td><input type="text" name="subject"></td>
                </tr>

                <tr>
                    <td><label>Your message:</label></td>
                    <td><textarea name="message"></textarea></td>
                </tr>

                <tr>
                    <td><input type="submit" value="Send a message" name="mailrelay_submit"></td>
                </tr>
        </table>
        </form>

        <!-- / The Actual form -->
    </body>
</html>
