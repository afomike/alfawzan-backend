<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documents = Document::where('is_active', true)->latest()->paginate(20);
        return view('user.documents.index', compact('documents'));
    }

    public function download(Document $document)
    {
        if (!$document->is_active) {
            abort(404);
        }

        $filePath = storage_path('app/public/' . $document->file_path);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath, $document->file_name);
    }
}

