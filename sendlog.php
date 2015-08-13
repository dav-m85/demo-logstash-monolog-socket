<?php

require_once __DIR__."/vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\SocketHandler;
use Monolog\Formatter\LogstashFormatter;

/*
# Of course, replace localhost with your docker instance ip (eg. boot2docker ip)
docker run -it --rm -p 0.0.0.0:12514:12514/udp -v "$PWD":/config-dir logstash logstash -f /config-dir/logstash.conf
php sendlog.php udp://localhost:12514 "This is a message"
*/

// create a log channel
$log = new Logger('name');
$handler = new SocketHandler($argv[1], Logger::DEBUG);
$log->pushHandler($handler);

$formatter =  new LogstashFormatter(
  'appName', null, null, 'ctxt_', LogstashFormatter::V1
);
$handler->setFormatter($formatter);

// add records to the log
$log->addInfo($argv[2]);

echo "Done\n";
