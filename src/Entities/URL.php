<?php
declare(strict_types=1);

namespace Falgun\SiteMapper\Entities;

class URL
{

    private string $loc;
    private string $lastmod;
    private string $changefreq;
    private string $priority;

    public function __construct(string $loc, string $lastmod = null, string $changefreq = 'monthly',
        string $priority = '0.9')
    {
        $this->loc = $loc;
        $this->lastmod = $lastmod ?? (new \DateTime())->format(\DateTime::W3C);
        $this->changefreq = $changefreq;
        $this->priority = $priority;
    }

    public function getLoc(): string
    {
        return $this->loc;
    }

    public function getLastmod(): string
    {
        return $this->lastmod;
    }

    public function getChangefreq(): string
    {
        return $this->changefreq;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function setLoc(string $loc): URL
    {
        $this->loc = $loc;

        return $this;
    }

    public function setLastmod(string $lastmod): URL
    {
        $this->lastmod = (new \DateTime($lastmod))->format(\DateTime::W3C);

        return $this;
    }

    public function setChangefreq(string $changefreq): URL
    {
        $this->changefreq = $changefreq;

        return $this;
    }

    public function setPriority(string $priority): URL
    {
        $this->priority = $priority;

        return $this;
    }

    public function format(): string
    {
        return <<<SITEMAP
    <url>
        <loc>{$this->loc}</loc>
        <lastmod>{$this->lastmod}</lastmod>
        <changefreq>{$this->changefreq}</changefreq>
        <priority>{$this->priority}</priority>
    </url>
SITEMAP;
    }
}
