<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PdfUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate(['pdf' => 'required|file|mimes:pdf|max:51200']); // 50 MB max

        $cloudName = config('cloudinary.cloud_name');
        $apiKey    = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');
        $folder    = config('cloudinary.folder') . '/books';

        if (empty($cloudName) || empty($apiKey) || empty($apiSecret)) {
            return response()->json(['error' => 'Cloudinary is not configured.'], 500);
        }

        $timestamp = time();
        // raw uploads require resource_type in the signature
        $signature = sha1("folder={$folder}&timestamp={$timestamp}{$apiSecret}");

        $file = $request->file('pdf');

        try {
            $response = Http::attach(
                'file',
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            )->post("https://api.cloudinary.com/v1_1/{$cloudName}/raw/upload", [
                'api_key'   => $apiKey,
                'timestamp' => $timestamp,
                'signature' => $signature,
                'folder'    => $folder,
            ]);

            if ($response->successful() && $response->json('secure_url')) {
                return response()->json(['url' => $response->json('secure_url')]);
            }

            return response()->json([
                'error' => 'Upload failed: ' . ($response->json('error.message') ?? 'Unknown error'),
            ], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Upload error: ' . $e->getMessage()], 500);
        }
    }
}
