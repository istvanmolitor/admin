<?php

namespace Molitor\Admin\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasAdminFilters
{
    /**
     * Apply common admin filters (search, sort) to the query.
     */
    protected function applyAdminFilters(Builder $query, Request $request, array $searchFields = ['name'], string $defaultSort = 'name'): Builder
    {
        return $query
            ->when($request->input('search'), function ($query, $search) use ($searchFields) {
                $query->where(function ($q) use ($search, $searchFields) {
                    foreach ($searchFields as $index => $field) {
                        if ($index === 0) {
                            $q->where($field, 'like', "%{$search}%");
                        } else {
                            $q->orWhere($field, 'like', "%{$search}%");
                        }
                    }
                });
            })
            ->when($request->input('sort'), function ($query, $sort) use ($request) {
                $direction = $request->input('direction', 'asc');
                $query->orderBy($sort, $direction);
            }, function ($query) use ($defaultSort) {
                if ($defaultSort) {
                    $query->orderBy($defaultSort, 'asc');
                }
            });
    }
}
