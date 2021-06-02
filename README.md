# SiteMapper

Simple Sitemap generator Library.

## Install
 *Please note that PHP 8.0 or higher is required.*

Via Composer

``` bash
$ composer require falgunphp/sitemapper
```

## Usage
```php
<?php
use Falgun\SiteMapper\MapGenerator;

$mapGenerator = new MapGenerator();

$mapGenerator
    ->setURL('https://site.com/page-1')
    ->setLastmod('2021-06-01 00:00:00')
    ->setChangefreq('monthly')
    ->setPriority('0.9');

$mapGenerator
    ->setURL('https://site.com/page-2')
    ->setLastmod('2021-06-02 00:00:00')
    ->setChangefreq('weekly')
    ->setPriority('0.9');

$mapGenerator->generate('/path/to/sitemap.xml');
// sitemap.xml will be generated & saved in that file path
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
