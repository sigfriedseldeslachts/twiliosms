# Laravel Twilio API Wrapper V2
A Laravel 5 wrapper for sending messages or calls with the Twilio API.

Supports:
- Laravel 5.3
- Laravel 5.4
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
    'Twilio' => Sigfriedseldeslachts\twiliosms\Facades\Twilio::class,
    ...
];
```

After that you'll have to add a few lines to your .env file:
```
TWILIO_SID=Your Twilio SID Token
TWILIO_TOKEN=Your Twilio Token
TWILIO_NUMBER=Your Twilio phone number
```

The Twilio test number is +15005550006, this number requires your Twilio test SID and token.
Beware that no messages will be send when you are using this number with test credentials,
it will just make a "real" response.

Now add this to your services.php file:
```php
// File: config/services.php
'twilio' => [
    'sid' => env('TWILIO_SID'),
    'token' => env('TWILIO_TOKEN'),
    'number' => env('TWILIO_NUMBER'),
],
```
If you did this then you're ready to go!

## Usage

### Global notes
- All phone numbers must be provided in the international format. Read more at [Twilio Support](https://support.twilio.com/hc/en-us/articles/223183008-Formatting-International-Phone-Numbers).
- Removing the '+' from a phone number is not required as the plugin wil remove this automatically.

### Sending a text message (SMS)
```php
Twilio::SMS()->to('+15005550006')->message('Hello from Laravel!')->start();
```
If you want to use a different phone number to send the text from:
```php
Twilio::SMS()->from('+9991231234')->to('+15005550006')->message('Hello from Laravel!')->start();
```

### Sending a text message with image (MMS)
A message is required, you are unable to send a MMS this without it.

The image url needs to be a jpeg, gif or png file.

```php
Twilio::MMS()->to('+15005550006')->message('Hello from Laravel!')->url('http://www.hookinfo.com/wp-content/uploads/2016/08/laravel-1.png')->start();
```
If you want to use a different phone number to send the text from:
```php
Twilio::MMS()->from('+9991231234')->to('+15005550006')->message('Hello from Laravel!')->url('http://www.hookinfo.com/wp-content/uploads/2016/08/laravel-1.png')->start();
```

### Making a call
To make a call you need to have a valid [TwiML](https://www.twilio.com/docs/api/twiml "Twilio TwML Markup") which needs to be a url. See the example below.

```php
Twilio::Call()->to('+15005550006')->url('https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient')->start();
```
If you want to use a different phone number to send the text from:
```php
Twilio::Call()->from('+9991231234')->to('+15005550006')->url('https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient')->start();
```

## Contributing
Feel free to help me out ;)

## Security issue
If the security issue is related to the wrapper please contact me with my email: sigfriedseldeslachts@gmail.com, if it's an Twilio API issue please contact them.

## License
MIT License, see license file for more info.
