<?php

namespace Molitor\Admin\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    private ?string $message = null;

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        return [
            'data' => $this->resource,
            'message' => $this->message,
        ];
    }
}
