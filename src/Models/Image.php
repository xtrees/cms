<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;

class Image extends Model
{
    const STORAGE_REMOTE = 'remote';
    const STORAGE_OSS = 'oss';
    const STORAGE_LOCAL = 'local';

    use HasFactory;


    public function getUrlAttribute(): string
    {
        $storage = $this->getStorage();
        return $storage->url($this->path);
    }

    public function getStorage(): FilesystemAdapter
    {
        $storage = $this->storage;
        if (empty($storage)) {
            $storage = self::STORAGE_LOCAL;
        }
        return \Storage::disk($storage);
    }
}
