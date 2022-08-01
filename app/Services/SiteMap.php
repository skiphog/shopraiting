<?php

namespace App\Services;

use DOMElement;
use DOMDocument;
use DOMException;
use App\Models\Shop;
use App\Models\Article;
use App\Models\Category;
use App\Models\Question;

class SiteMap
{
    public const PRETTY_FILE = false;

    protected static array $static_url = [
        '',
        '/shops',
        '/reviews',
        '/articles',
        '/authors',
        '/questions',
        '/about',
        '/privacy',
        '/feedback'
    ];

    /**
     * @return bool
     */
    public function makeSiteMap(): bool
    {
        try {
            return $this->makeXml($this->generateData());
        } catch (DOMException) {
            return false;
        }
    }

    /**
     * @return array
     */
    protected function generateData(): array
    {
        return array_merge(
            static::$static_url,
            $this->generateShops(),
            $this->generateCategories(),
            $this->generateArticles(),
            $this->generateQuestions()
        );
    }

    /**
     * @param array $data
     *
     * @return bool
     * @throws DOMException
     */
    protected function makeXml(array $data): bool
    {
        $dom = new DOMDocument('1.0', 'UTF-8');

        if (true === self::PRETTY_FILE) {
            $dom->formatOutput = true;
        }

        $root = $this->getRoot($dom);

        foreach ($data as $item) {
            $url = $dom->createElement('url');
            $loc = $dom->createElement('loc', config('app.url') . $item);
            $url->appendChild($loc);
            $root->appendChild($url);
        }

        $dom->appendChild($root);

        return (bool)$dom->save(public_path('/sitemap.xml'));
    }

    /**
     * Сгенерировать Slug магазинов
     *
     * @return array
     */
    protected function generateShops(): array
    {
        $shops = Shop::select('slug')
            ->oldest('id')
            ->pluck('slug')
            ->transform(static fn($item) => "/shops/{$item}");

        return $shops
            ->merge($shops->map(static fn($item) => "{$item}/reviews"))
            ->all();
    }

    /**
     * Сгенерировать Slug категорий
     *
     * @return array
     */
    protected function generateCategories(): array
    {
        return Category::select('slug')
            ->whereNot('id', 1)
            ->oldest('id')
            ->pluck('slug')
            ->transform(static fn($item) => "/cities/{$item}")
            ->all();
    }

    /**
     * Сгенерировать Slug статей
     *
     * @return array
     */
    protected function generateArticles(): array
    {
        return Article::select('slug')
            ->oldest('id')
            ->pluck('slug')
            ->transform(static fn($item) => "/articles/{$item}")
            ->all();
    }

    /**
     * Сгенерировать Slug вопросов
     *
     * @return array
     */
    protected function generateQuestions(): array
    {
        return Question::select('id')
            ->oldest('id')
            ->pluck('id')
            ->transform(static fn($item) => "/questions/{$item}")
            ->all();
    }

    /**
     * @param DOMDocument $dom
     *
     * @return DOMElement
     * @throws DOMException
     */
    private function getRoot(DOMDocument $dom): DOMElement
    {
        if (false === $root = $dom->createElement('urlset')) {
            throw new DOMException();
        }

        $root->setAttribute('xmlns', 'https://www.sitemaps.org/schemas/sitemap/0.9');
        $root->setAttribute('xmlns:xsi', 'https://www.w3.org/2001/XMLSchema-instance');
        $root->setAttribute('xsi:schemaLocation',
            'https://www.sitemaps.org/schemas/sitemap/0.9 https://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        return $root;
    }
}
