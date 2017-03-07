# Laravel Twilio API Wrapper

## New update is comming! (Using PHP chaining)

A Laravel 5.3+ wrapper for sending messages or calls with the Twilio API.

## Setting up

You can install the package via composer:

```
composer require sigfriedseldeslachts/twiliosms
```

Then, add the service provider and the alias
```php
// File: config/app.php

'providers' => [
    ...
    Sigfriedseldeslachts\twiliosms\TwilioSMSServiceProvider::class,
    ...
];

'aliases' => [
    ...
    'Twillio' => Sigfriedseldeslachts\twiliosms\Facades\Twilio::class,
    ...
];
```

After that you'll have to add a few lines to your .env file:
```
TWILIO_SID=Your Twilio SID Token
TWILIO_TOKEN=Yout Twilio Token
TWILIO_NUMBER=Your twilio phone number, without +
```

And now you're ready to go!

## Usage

### Global note
Removing the '+' from a phone number is not required as the plugin wil remove this automatically.

### Sending a text message (SMS)
```php
Twilio::SMS(string $to, string $message);
```
If you want to use a different phone number to send the text from:
```php
Twilio::SMS(string $to, string $message, string $from);
```

#### Example
```php
Twilio::SMS('+123456789', 'Hello from Laravel!', '+987456321');
```

### Sending a text message with image (MMS)
The image url needs to be a jpeg, gif or png file.

```php
Twilio::MMS(string $to, string $message, string $url);
```
If you want to use a different phone number to send the text from:
```php
Twilio::MMS(string $to, string $message, string $url, string $from);
```

#### Example
```php
Twilio::MMS('+123456789', 'Hello from Laravel!', 'http://www.hookinfo.com/wp-content/uploads/2016/08/laravel-1.png', '+987456321');
```

### Making a call
To make a call you need to have a valid [TwiML](https://www.twilio.com/docs/api/twiml "Twilio TwML Markup") which needs to be a url. See the example below.

```php
Twilio::Call(string $to, string $url);
```
If you want to use a different phone number to call from:
```php
Twilio::Call(string $to, string $url, string $from);
```

#### Example
```php
Twilio::Call('+123456789', 'http://demo.twilio.com/docs/voice.xml', '+987456321');
```

## Contributing
Feel free to help me out ;)

## Security issue
If the security issue is related to the wrapper please contact me with my email: sigfriedseldeslachts@gmail.com, if it's an Twilio API issue please contact them.

## License
MIT License, see license file for more info.
