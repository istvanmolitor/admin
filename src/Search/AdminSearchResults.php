<?php

declare(strict_types=1);

namespace Molitor\Admin\Search;

class AdminSearchResults
{
    private array $items = [];

    public function addResult(string $type, string $typeLabel, int|string $id, string $title, string $subtitle, string $url): void
    {
        $this->items[] = [
            'type' => $type,
            'type_label' => $typeLabel,
            'id' => $id,
            'title' => $title,
            'subtitle' => $subtitle,
            'url' => $url,
        ];
    }

    public function all(): array
    {
        return $this->items;
    }
}
