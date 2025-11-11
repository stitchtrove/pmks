<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Note;
use App\Http\Resources\NoteResource;

Route::prefix('v1')->group(function () {
    Route::get('/content', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => NoteResource::collection(Note::where('is_public', true)->orderBy('created_at')->get()),
        ]);
    });
});