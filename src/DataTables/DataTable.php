<?php

namespace Molitor\Admin\DataTables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class DataTable
{
    /** @var DataTableColumn[] */
    private array $columns = [];

    public function __construct(private readonly Request $request)
    {
        $this->initColumns();
    }

    abstract protected function getModelClass(): string;

    abstract protected function getResourceClass(): string;

    abstract protected function initColumns(): void;

    protected function addColumn(string $name): DataTableColumn
    {
        $column = new DataTableColumn($name);
        $this->columns[$name] = $column;
        return $column;
    }

    protected function getSearch(): ?string
    {
        return $this->request->input('search') ?: null;
    }

    protected function getSearchFields(): array
    {
        return array_values(array_map(
            fn($c) => $c->getName(),
            array_filter($this->columns, fn($c) => $c->isSearchable())
        ));
    }

    protected function getOrderFields(): array
    {
        return array_values(array_map(
            fn($c) => $c->getName(),
            array_filter($this->columns, fn($c) => $c->isOrderable())
        ));
    }

    protected function getDefaultSort(): string
    {
        return $this->getOrderFields()[0] ?? 'name';
    }

    protected function getFilteredQuery(Builder $query): Builder
    {
        $searchFields = $this->getSearchFields();
        $defaultSort = $this->getDefaultSort();

        return $query
            ->when($this->request->input('search'), function ($query, $search) use ($searchFields) {
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
            ->when($this->request->input('sort'), function ($query, $sort) {
                $direction = $this->request->input('direction', 'asc');
                $query->orderBy($sort, $direction);
            }, function ($query) use ($defaultSort) {
                if ($defaultSort) {
                    $query->orderBy($defaultSort, 'asc');
                }
            });
    }

    protected function buildQuery(): Builder
    {
        return $this->getFilteredQuery($this->getModelClass()::query());
    }

    protected function paginate(): LengthAwarePaginator
    {
        return $this->buildQuery()->paginate($this->request->integer('per_page', 10));
    }

    public function response(): AnonymousResourceCollection
    {
        $data = $this->paginate();
        $resourceClass = $this->getResourceClass();

        return $resourceClass::collection($data)->additional([
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ],
            'filters' => $this->request->only(['search', 'sort', 'direction']),
        ]);
    }
}
