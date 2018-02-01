# SFDS Notification PHP SDK

### Requirements
1. SFDS API Key
2. API call to be made within the City Network

### Install Package
Add SFDS Notification to your *composer.json*
```
{
  "repositories": [
      {
        "type": "vcs",
        "url": "https://github.com/SFDigitalServices/sfds-notification-php-sdk.git"
      }
    ],
  "require": {
    "sfdigitalservices/notification-php-sdk": "dev-master"
  }
}
```

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
  'from_email' => 'from_email@example.com',
  'from_name' => 'Example Name',
  'body_text' => 'Example text content',
  'body_html' => '<p>Example HTML content</p>',
  'tags' => array('example')
);
$hello->mail($message);

``` 

### How to contribute / Roadmap
If you are interested in contributing or would like to know the future direction of this project, please take a look at our [open issues](https://github.com/SFDigitalServices/sfds-notification-php-sdk/issues) and [pull requests](https://github.com/SFDigitalServices/sfds-notification-php-sdk/pulls). We would love to hear your feedback.
