<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Services\ImageUploader;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function slugify(Request $request): JsonResponse
    {
        $slug = str($request['slug'])->slug();

        return response()->json(compact('slug'));
    }

    public function uploadShopLogo(): JsonResponse
    {
        try {
            $image = ImageUploader::from('file')
                ->resize(170)
                ->save('upload');

            return response()->json([
                'path'   => $image->getPath(),
                'width'  => $image->getWidth(),
                'height' => $image->getHeight()
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function uploadBase(): JsonResponse
    {
        try {
            $image = ImageUploader::from('file')
                ->save('upload');

            return response()->json([
                'path'   => $image->getPath(),
                'width'  => $image->getWidth(),
                'height' => $image->getHeight()
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
