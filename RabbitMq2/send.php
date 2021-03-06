<?php
/**
 * @author David Mezquíriz Osés
 */

//we need to include the library and use the necessary classes
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


// we can create a connection to the server:
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('hello', false, false, false, false);

// we create a channel, which is where most of the API for getting things done resides.
//To send, we must declare a queue for us to send to; then we can publish a message to the queue:
$msg = new AMQPMessage('Hello World!');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";
//Declaring a queue is idempotent - it will only be created if it doesn't exist already. 
//The message content is a byte array, so you can encode whatever you like there.
//Close channel and connection
$channel->close();
$connection->close();



