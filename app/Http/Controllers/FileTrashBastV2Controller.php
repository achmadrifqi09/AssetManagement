<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileTrashBastV2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($file)
    {
        abort_if(auth()->guest(), Response::HTTP_FORBIDDEN);
        $path = "trash-bast-v2/$file";
        return response()->file(
            Storage::path($path)
        );
    }
}
