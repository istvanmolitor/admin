<?php

namespace Molitor\Admin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionsResource extends JsonResource
{
    public function __construct(
        $resource,
        public string $valueField = 'value',
        public string $labelField = 'label'
    )
    {
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'value' => $this->resource->{$this->valueField},
            'label' => $this->resource->{$this->labelField},
        ];
    }
}
