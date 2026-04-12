<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Note;
use App\Http\Resources\NoteResource;
use App\Models\Bake;
use App\Http\Resources\BakeResource;

Route::prefix('v1')->group(function () {
    Route::get('/content', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => NoteResource::collection(Note::where('is_public', true)->orderBy('created_at')->get()),
        ]);
    });
    Route::get('/bakes', function (Request $request) {
        return response()->json([
            'status' => 'success',
            'data' => BakeResource::collection(Bake::where('published', true)->orderBy('created_at')->get()),
        ]);
    });
    Route::get('/dailyactions', function (Request $request) {
        $data = \App\Models\DailyAction::with('action', 'subject')
            ->orderBy('action_date', 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    });
});