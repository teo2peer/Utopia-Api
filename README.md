# Utopia-Api
An easy way to integrate Utopia Api in your PHP App 

**Requeriments**
- PHP 7.2 or later
- Curl

### Installation

You can install using [composer](http://getcomposer.org).

```
composer require teo2peer/utopia-api
```

Or download the php file and add it to your project
```
git clone https://github.com/teo2peer/utopia-api
```


### Add to your code

```php

// downloaded
require_once('utopia-api.php')

//composer 
use utopiaApi\Api;


$api = new api("URL", "TOKEN");

$result = $api->call()-getSystemInfo();

$api->call()->sendChannelMessage("channelId", "message");


```

Response will be a json array, like if you make the request directly to the api.

# Join Utopia

Join as a developer into Utopia Ecosystem [Join Now](https://u.is)

# Contributing

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create new Pull Request