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

    public function __construct(protected readonly Request $request)
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

    protected function getDefaultDirection(): string
    {
        return 'asc';
    }

    protected function getDirection(): string
    {
        $direction = $this->request->input('direction', $this->getDefaultDirection());
        return $direction === 'asc' ? 'asc' : 'desc';
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

    protected function getSort(): string
    {
        $defalutSort = $this->getDefaultSort();
        $sort = $this->request->input('sort', $defalutSort);
        if (in_array($sort, $this->getOrderFields())) {
            return $sort;
        }
        return $defalutSort;
    }

    protected function applyFilters(Builder $query): Builder
    {
        $search = $this->getSearch();

        if ($search === '') {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            foreach ($this->getSearchFields() as $index => $field) {
                if ($index === 0) {
                    $q->where($field, 'like', "%{$search}%");
                } else {
                    $q->orWhere($field, 'like', "%{$search}%");
                }
            }
        });
    }

    protected function applySort(Builder $query): Builder
    {
        return $query->orderBy($this->getSort(), $this->getDirection());
    }

    protected function getBaseQuery(): Builder
    {
        return $this->getModelClass()::query();
    }

    public function query(Builder $query): Builder
    {
        return $query;
    }

    protected function buildQuery(): Builder
    {
        return $this->applySort($this->applyFilters($this->getBaseQuery()));
    }

    protected function getPerPage(): int
    {
        return $this->request->integer('per_page', 10);
    }

    protected function paginate(): LengthAwarePaginator
    {
        return $this->buildQuery()->paginate($this->getPerPage());
    }

    protected function getFilters(): array
    {
        return [
            'search' => $this->getSearch(),
            'sort' => $this->getSort(),
            'direction' => $this->getDirection(),
        ];
    }

    private function buildMeta(LengthAwarePaginator $data): array
    {
        return [
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'per_page' => $data->perPage(),
            'total' => $data->total(),
        ];
    }

    protected function getColumnsForClient(): array
    {
        return array_values(array_map(
            fn(DataTableColumn $c) => $c->toClientArray(),
            array_filter($this->columns, fn(DataTableColumn $c) => ! $c->isHidden())
        ));
    }

    protected function getResourceAdditionals(LengthAwarePaginator $data): array
    {
        return [
            'meta' => $this->buildMeta($data),
            'filters' => $this->getFilters(),
            'columns' => $this->getColumnsForClient(),
        ];
    }

    public function getResponse(): AnonymousResourceCollection
    {
        $data = $this->paginate();
        $resourceClass = $this->getResourceClass();

        return $resourceClass::collection($data)->additional($this->getResourceAdditionals($data));
    }
}
