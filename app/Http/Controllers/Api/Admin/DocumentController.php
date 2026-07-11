<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('uploader')->latest()->paginate(20);

        return response()->json([
            'data' => $documents->map(fn($d) => $this->format($d)),
            'meta' => ['total' => $documents->total(), 'current_page' => $documents->currentPage(), 'last_page' => $documents->lastPage()],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:10240',
            'is_active'   => 'nullable|boolean',
        ]);

        $file     = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        $document = Document::create([
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path'   => $filePath,
            'file_name'   => $file->getClientOriginalName(),
            'file_size'   => $file->getSize(),
            'is_active'   => $validated['is_active'] ?? true,
            'uploaded_by' => $request->user()->id,
        ]);

        $document->load('uploader');
        return response()->json(['data' => $this->format($document)], 201);
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:10240',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($document->file_path);
            $file                    = $request->file('file');
            $fileName                = time() . '_' . $file->getClientOriginalName();
            $validated['file_path']  = $file->storeAs('documents', $fileName, 'public');
            $validated['file_name']  = $file->getClientOriginalName();
            $validated['file_size']  = $file->getSize();
        }

        $document->update($validated);
        $document->load('uploader');
        return response()->json(['data' => $this->format($document)]);
    }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return response()->json(['message' => 'Document deleted.']);
    }

    private function format(Document $d): array
    {
        return [
            'id'          => $d->id,
            'title'       => $d->title,
            'description' => $d->description,
            'file_name'   => $d->file_name,
            'file_size'   => $d->file_size,
            'is_active'   => $d->is_active,
            'created_at'  => $d->created_at->toISOString(),
            'uploader'    => $d->uploader ? ['name' => $d->uploader->name] : null,
        ];
    }
}
