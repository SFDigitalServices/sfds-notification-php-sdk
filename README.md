# SFDS Notification PHP SDK

### Requirements
1. SFDS API Key
2. API call to be made within the City Network

### Example Usage
```
<?php
// If you are using Composer (recommended)
require 'vendor/autoload.php';

$hello = new SFDSNotification\SFDSNotification(<YOUR_SFDS_APIKEY>);
$message = array(
  'to' => array(
      array(
          'email' => 'recipient.email@example.com',
          'name' => 'Recipient Name'
      )
  ),
  'subject' => 'example subject',
  'from_email' => 'message.from_email@example.com',
  'from_name' => 'Example Name',
  'body_text' => 'Example text content',
  'body_html' => '<p>Example HTML content</p>',
  'tags' => array('example')
);
$hello->mail($message);

``` 