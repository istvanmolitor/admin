<?php

namespace Molitor\Admin\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataTableResource extends JsonResource
{
    protected $resourceClass;

    protected $filters;

    protected $columns;

    public function __construct($resource, $resourceClass, $filters = [], $columns = [])
    {
        parent::__construct($resource);
        $this->resourceClass = $resourceClass;
        $this->filters = $filters;
        $this->columns = $columns;
    }

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->resourceClass::collection($this->resource->items()),
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
                'per_page' => $this->resource->perPage(),
                'total' => $this->resource->total(),
            ],
            'filters' => $this->filters,
            'columns' => $this->columns,
        ];
    }
}
