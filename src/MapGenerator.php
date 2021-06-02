<?php
declare(strict_types=1);

namespace Falgun\SiteMapper;

use Falgun\SiteMapper\Entities\URL;

class MapGenerator
{

    /** @var array<int, URL> */
    private array $urls;

    public function __construct()
    {
        $this->urls = [];
    }

    public function generate(string $path): bool
    {
        $urlSet = '';
        foreach ($this->urls as $url) {
            $urlSet .= $url->format() . PHP_EOL;
        }

        $sitemap = <<<SITEMAP
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{$urlSet}
</urlset>
SITEMAP;

        file_put_contents($path, $sitemap, LOCK_EX);

        $this->cleanSlate();

        return file_exists($path);
    }

    /**
     * Set new Url to be index
     *
     * @param string $url
     * @return URL
     */
    public function setURL(string $url)
    {
        return $this->urls[] = new URL($url);
    }

    public function cleanSlate(): void
    {
        $this->urls = [];
    }
}
