<?php

namespace Molitor\Admin\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class FormResource extends JsonResource
{
    private ?string $message = null;

    /**
     * @param string|null $message
     */
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
