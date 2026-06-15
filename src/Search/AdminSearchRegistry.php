<?php

declare(strict_types=1);

namespace Molitor\Admin\Search;

class AdminSearchRegistry
{
    /** @var AdminSearch[] */
    private array $searchers = [];

    public function register(AdminSearch $searcher): void
    {
        $this->searchers[] = $searcher;
    }

    public function search(string $q, int $limit): AdminSearchResults
    {
        $results = new AdminSearchResults();

        foreach ($this->searchers as $searcher) {
            $searcher->search($q, $limit, $results);
        }

        return $results;
    }
}
