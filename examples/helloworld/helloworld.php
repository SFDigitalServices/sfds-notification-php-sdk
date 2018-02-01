<?php

require 'vendor/autoload.php';

try{
  $dotenv = new Dotenv\Dotenv(__DIR__);
  $dotenv->load();

  $hello = new SFDSNotification\SFDSNotification();
  $message = array(
    'to' => array(
        array(
            'email' => 'recipient.email@example',
            'name' => 'Recipient Name'
        )
    ),
    'subject' => 'example subject',
    'from_email' => 'from_email@example',
    'from_name' => 'Example Name',
    'body_text' => 'Example text content',
    'body_html' => '<p>Example HTML content</p>',
    'tags' => array('demo')
  );
  $hello->mail($message);
}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}





