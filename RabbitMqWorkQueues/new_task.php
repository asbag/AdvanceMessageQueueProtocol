<?php
/**
 * @author David Mezquíriz Osés
 * 
 * The main idea behind Work Queues (aka: Task Queues) is to avoid doing a resource-intensive task immediately 
 * and having to wait for it to complete. Instead we schedule the task to be done later. We encapsulate a task as a 
 * message and send it to a queue. A worker process running in the background will pop the tasks and eventually 
 * execute the job. When you run many workers the tasks will be shared between them.
 * This concept is especially useful in web applications where it's impossible to handle a complex task during a short HTTP request window.
 */

//we need to include the library and use the necessary classes
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


// we can create a connection to the server:
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$data = implode('  ', array_slice($argv, 1));//Get rid of first argv field and then convert into string separated by  '  '
if(empty($data)) $data = "Hello World!";
$msg = new AMQPMessage($data,
		array('delivery_mode' => 2) # make message persistent
		);

$channel->basic_publish($msg, '', 'task_queue');

echo " [x] Sent ", $data, "\n";
