<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('is_active', true)->latest()->paginate(20);

        return response()->json([
            'data' => $documents->map(fn($d) => [
                'id'          => $d->id,
                'title'       => $d->title,
                'description' => $d->description,
                'file_name'   => $d->file_name,
                'file_size'   => $d->file_size,
                'created_at'  => $d->created_at->toISOString(),
            ]),
            'meta' => [
                'total'        => $documents->total(),
                'current_page' => $documents->currentPage(),
                'last_page'    => $documents->lastPage(),
            ],
        ]);
    }

    public function download(Document $document)
    {
        if (!$document->is_active) {
            return response()->json(['message' => 'Document not available.'], 403);
        }

        if (!Storage::disk('public')->exists($document->file_path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
