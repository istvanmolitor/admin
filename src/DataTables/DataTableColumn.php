<?php

namespace Molitor\Admin\DataTables;

class DataTableColumn
{
    private string $name;
    private ?string $queryName = null;
    private ?string $label = null;
    private bool $searchable = false;
    private bool $orderable = false;
    private bool $hidden = false;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getQueryName(): string
    {
        return $this->queryName ?? $this->name;
    }

    public function setQueryName(string $queryName): static
    {
        $this->queryName = $queryName;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label ?? ucfirst(str_replace('_', ' ', $this->name));
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function setSearchable(bool $searchable = true): static
    {
        $this->searchable = $searchable;

        return $this;
    }

    public function isOrderable(): bool
    {
        return $this->orderable;
    }

    public function setOrderable(bool $orderable = true): static
    {
        $this->orderable = $orderable;

        return $this;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden = true): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function toClientArray(): array
    {
        return [
            'key' => $this->name,
            'label' => $this->getLabel(),
            'sortable' => $this->orderable,
        ];
    }
}
