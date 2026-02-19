<?php

use App\Http\Controllers\LinkPreviewController;
use Illuminate\Support\Facades\Route;


Route::get('/', function()
{
    return response()->json(['status'=>200, 'message'=>'success', 'timestamp'=>date('Y-m-d H:i:s')]);
});

Route::post('/link-preview', [LinkPreviewController::class, 'preview']);