<?php

namespace App\Helpers;

class ImageHelper
{
    public static function uploadAndResize($file, $directory, $fileName, $width = null, $height = null)
    {
        // ✅ Simpan ke storage/app/public
        $destinationPath = storage_path('storage/app/public/storage/ruangan/' . $directory);

        // ✅ Auto buat folder kalau belum ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $image = null;

        // 🔍 Buat image dari file
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($file->getRealPath());
                break;
            case 'png':
                $image = imagecreatefrompng($file->getRealPath());
                break;
            case 'gif':
                $image = imagecreatefromgif($file->getRealPath());
                break;
            default:
                throw new \Exception('Unsupported image type');
        }

        // 🔄 Resize (kalau width diisi)
        if ($width) {
            $oldWidth = imagesx($image);
            $oldHeight = imagesy($image);
            $aspectRatio = $oldWidth / $oldHeight;

            if (!$height) {
                $height = $width / $aspectRatio;
            }

            $newImage = imagecreatetruecolor($width, $height);
            imagecopyresampled(
                $newImage,
                $image,
                0,
                0,
                0,
                0,
                $width,
                $height,
                $oldWidth,
                $oldHeight
            );

            imagedestroy($image);
            $image = $newImage;
        }

        // 💾 Simpan file ke storage
        $fullPath = $destinationPath . '/' . $fileName;

        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($image, $fullPath);
                break;
            case 'png':
                imagepng($image, $fullPath);
                break;
            case 'gif':
                imagegif($image, $fullPath);
                break;
        }

        imagedestroy($image);

        return $fileName;
    }
}