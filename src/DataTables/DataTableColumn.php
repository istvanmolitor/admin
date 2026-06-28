<?php

namespace Molitor\Admin\DataTables;

class DataTableColumn
{
    private string $name;
    private bool $searchable = false;
    private bool $orderable = false;

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
}
