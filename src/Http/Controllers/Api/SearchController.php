<?php

declare(strict_types=1);

namespace Molitor\Admin\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Molitor\Admin\Search\AdminSearchRegistry;

class SearchController extends Controller
{
    private const LIMIT = 5;

    private AdminSearchRegistry $registry;

    public function __construct(AdminSearchRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $q = trim((string) $request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json(['data' => [], 'query' => $q]);
        }

        return response()->json([
            'data' => $this->registry->search($q, self::LIMIT)->all(),
            'query' => $q,
        ]);
    }
}
