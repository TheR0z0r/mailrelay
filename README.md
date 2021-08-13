# MailRelay
MailRelay is a plug and play PHP script to forward HTML form messages to email(s).

# Installation
Download the repository and drop the "mailrelay-main" folder to your webhosts folder and rename it to "mailrelay" if you want.

# Features
1. Send messages to multiple emails.
2. Specify multiple forms with different email addresses.
3. Allow anonymous submissions from everywhere.

# Configuration
*Configuration file can be found in "config/config.php"*

# Email addresses
Emails where messages get delivered to can be specified in $emails array.

```
$emails = array(
    'email_1' => 'email@email',
);
```
Add new key => value pair for additional emails. Key can be whatever you want.

# Adding multiple forms
You can create multiple forms which get delivered to different places in $forms array.

```
$forms = array(
    "form_1" => array(
        'validate'  => true,
        'title'     => 'Message from test form 1',
        'emails'    => array( 'email_1' ),
        'from'      => DEFAULT_FROM,
        'redirect'  => DEFAULT_REDIRECT
    ),
);
```

Just add new array to $forms array. Make sure you specify all the fields in the example, otherwise the script won't work.

# Allowing anonymous forms
In configuration, change the ALLOW_ANONYMOUS constant to true, so you don't have to specify form ids. In that case, the form is sent to default address.

# HTML form
See form.php for an example.

# Version history
1.0 - First version
