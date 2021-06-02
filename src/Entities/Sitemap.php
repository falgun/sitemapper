<?php
declare(strict_types=1);

namespace Falgun\SiteMapper\Entities;

class Sitemap
{

    private string $loc;
    private string $lastmod;

    public function __construct(string $path, string $url)
    {
        if (file_exists($path) === false) {
            throw new \Exception('Sitemap does not exists on ' . $path);
        }

        $this->loc = $url;
        $this->lastmod = date(\DateTime::W3C, filemtime($path));
    }

    public function getPath(): string
    {
        return $this->loc;
    }

    public function getLastmod(): string
    {
        return $this->lastmod;
    }

    public function setPath(string $path): Sitemap
    {
        $this->loc = $path;

        return $this;
    }

    public function setLastmod(string $lastmod): Sitemap
    {
        $this->lastmod = (new \DateTime($lastmod))->format(\DateTime::W3C);

        return $this;
    }

    public function format(): string
    {
        return <<<SITEMAP
    <sitemap>
      <loc>{$this->loc}</loc>
      <lastmod>{$this->lastmod}</lastmod>
   </sitemap>
SITEMAP;
    }
}
