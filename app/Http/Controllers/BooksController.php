<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\DataTransferObjects\Books\CreateReadLogDTO;
use App\Http\Requests\SubmitBookReadRequest;
use App\Services\Books\BookService;
use Illuminate\Http\JsonResponse;

#[AllowDynamicProperties] class BooksController extends Controller
{
    public function __construct(protected BookService $bookService)
    {
        $this->seconds = 60 * 60 * 24;
    }

    public function SubmitReading(SubmitBookReadRequest $request): JsonResponse
    {
        $read_log = CreateReadLogDTO::fromRequest($request);
        $this->bookService->submitBookRead($read_log);
        return new JsonResponse(['message' => 'thanks']);
    }
}
