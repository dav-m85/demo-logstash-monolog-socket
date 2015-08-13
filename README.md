# Logstash Monolog through Socket Demo

Demonstrate how to log messages to logstash with monolog through socket.

## Running the Demo

```bash
composer install
docker run -it --rm -p 0.0.0.0:12514:12514/udp -v "$PWD":/config-dir logstash logstash -f /config-dir/logstash.conf

# And in another shell...
# Replace localhost with your docker instance ip (eg. boot2docker ip)
php sendlog.php udp://localhost:12514 "This is a message"

# You should see in the first shell logstash debugging about incoming logs. Voilà !
