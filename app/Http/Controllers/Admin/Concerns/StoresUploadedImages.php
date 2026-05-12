<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait StoresUploadedImages
{
    protected function imagePath(Request $request, string $fileField, string $textField, string $directory, ?string $current = null): ?string
    {
        if ($request->hasFile($fileField)) {
            $path = $request->file($fileField)->store($directory, 'public');

            return Storage::url($path);
        }

        return $request->filled($textField) ? $request->string($textField)->toString() : $current;
    }
}
