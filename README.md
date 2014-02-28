Sqwiggle PHP SDK
================

Unofficial Sqwiggle SDK for PHP.

This package is compliant with [PSR-0][], [PSR-1][], and [PSR-2][]. If you
notice compliance oversights, please send a patch via pull request.

[PSR-0]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[PSR-2]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md

## Installation

Via [Composer](http://getcomposer.org):

``` json
{
    "require": {
        "ipalaus/sqwiggle-php-sdk": "0.1.*"
    }
}
```

## Usage

To use the Sqwiggle PHP SDK you need to authenticate to the Sqwiggle API using your access
token, which is passed via HTTP Based Authentication. A `BasicAuthentication` class is provided in
order to ease the process.

```php
use Ipalaus\Sqwiggle\Client;
use Ipalaus\Sqwiggle\BasicAuthentication;

$auth = new BasicAuthentication('access_token');

$client = new Client($auth);
```

### Attachments

```php
$client->getAttachment(3009);
$client->updateAttachment(3009, array('description' => 'An awesome image.'));
$client->removeAttachment(3009);
$client->getAttachments();
```

### Conversations

```php
$client->getConversation(88732);
$client->getConversations();
```

### Information

```php
$client->getInfo();
$client->getConfigurationInfo();
$client->getVersionsInfo();
```

### Invites

```php
$client->createInvite('isern@example.com');
$client->getInvite(16430);
$client->removeInvite(16429);
$client->getInvites();
```

### Messages

```php
$client->createMessage(4885, 'API posted message, yay!');
$client->getMessage(673750);
$client->updateMessage(673780, 'Updated message :)');
$client->removeMessage(673780);
$client->getMessages();
```

### Organizations

```php
$client->getOrganization(8579);
$client->updateOrganization(8579, 'ipalaus');
$client->getOrganizations();
```

### Rooms

```php
$client->getRooms();
$client->createRoom('github');
$client->getRoom(4885);
$client->updateRoom(5802, 'Isern');
$client->removeRoom(5800);
```

### Users

```php
$client->getUser(16898);
$client->updateUser(16898, array('name' => 'Isern Palaus', 'message' => 'Hi, I am Isern.'));
$client->getUsers();
```

## Support

Bugs and feature request are tracked on [GitHub](https://github.com/ipalaus/sqwiggle-php-sdk/issues).

## Credits

- [Isern Palaus](https://github.com/ipalaus)
- [All Contributors](https://github.com/ipalaus/sqwiggle-php-sdk/contributors)

## License

This package is released under the MIT License. See the bundled
[LICENSE](https://github.com/ipalaus/sqwiggle-php-sdk/blob/master/LICENSE) file for details.
