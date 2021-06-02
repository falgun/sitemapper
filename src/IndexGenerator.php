<?php
declare(strict_types=1);

namespace Falgun\SiteMapper;

use Falgun\SiteMapper\Entities\Sitemap;

class IndexGenerator
{

    /** @var array<int, Sitemap> */
    private array $sitemaps;

    public function __construct()
    {
        $this->sitemaps = [];
    }

    public function generate(string $path): bool
    {
        $sitemapIndex = '';
        foreach ($this->sitemaps as $sitemap) {
            $sitemapIndex .= $sitemap->format() . PHP_EOL;
        }

        $sitemap = <<<SITEMAPINDEX
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{$sitemapIndex}
</sitemapindex>
SITEMAPINDEX;

        file_put_contents($path, $sitemap, LOCK_EX);

        $this->cleanSlate();

        return file_exists($path);
    }

    /**
     * Set Sitemap in index
     *
     * @param string $path
     * @return Sitemap
     */
    public function setSitemap(string $path, string $url): Sitemap
    {
        return $this->sitemaps[] = new Sitemap($path, $url);
    }

    public function cleanSlate(): void
    {
        $this->sitemaps = [];
    }
}
