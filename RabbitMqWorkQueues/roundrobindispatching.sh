#!/bin/bash

# David Mezquíriz Osés
#You need three consoles open. Two will run the "php worker.php" script. 
#These consoles will be our two consumers - C1 and C2, and in the third one we execute this roundrobin method new_task.php

php new_task.php First message.
php new_task.php Second message..
php new_task.php Third message...
php new_task.php Fourth message....
php new_task.php Fifth message.....
