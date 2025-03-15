<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class ImageOptimizationTestController extends Controller
{public function testOptimization()
    {
        // Path to the image before optimization
        $relativePath = 'avatars/ghibli.jpg';
        $absolutePath = storage_path("app/public/{$relativePath}");
    
        // Check if the file exists
        if (!Storage::disk('public')->exists($relativePath)) {
            return response()->json(['error' => 'File does not exist'], 404);
        }
    
        // Get file sizes
        $originalSize = Storage::disk('public')->size($relativePath);
    
        // Optimize the image
        ImageOptimizer::optimize($absolutePath);
    
        // Get file size after optimization
        $optimizedSize = Storage::disk('public')->size($relativePath);
    
        // Output sizes for comparison
        return response()->json([
            'original_size' => $originalSize,
            'optimized_size' => $optimizedSize
        ]);
    }
    
}