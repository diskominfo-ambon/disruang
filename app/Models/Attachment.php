<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function delete()
    {
        $path = $this->path;

        if (Storage::disk('public')->exists($path) ) {
            Storage::disk('public')
                ->delete($path);
        }

        parent::delete();
    }

    public static function fromFile($file, $path)
    {
        return static::create([
            'original_filename' => $file->getClientOriginalName(),
            'filename' => Str::of($path)->split('/\//')->last(),
            'size' => $file->getSize(),
            'path' => $path,
            'content_type' => $file->getMimeType()
        ]);
    }
}
