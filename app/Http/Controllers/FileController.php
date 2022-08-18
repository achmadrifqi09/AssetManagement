<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function __invoke($file)
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);
        $path = "physical-pictures/$file";
        return response()->file(
            Storage::path($path)
        );
    }
}
