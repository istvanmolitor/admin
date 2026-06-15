<?php

declare(strict_types=1);

namespace Molitor\Admin\Search;

use Illuminate\Database\Eloquent\Builder;

abstract class AdminSearch
{
    abstract public function search(string $q, int $limit, AdminSearchResults $results): void;

    protected function filter(Builder $query, string $q, array $fields): Builder
    {
        return $query->where(function (Builder $sub) use ($q, $fields) {
            $first = array_shift($fields);
            $sub->where($first, 'like', "%{$q}%");
            foreach ($fields as $field) {
                $sub->orWhere($field, 'like', "%{$q}%");
            }
        });
    }
}
