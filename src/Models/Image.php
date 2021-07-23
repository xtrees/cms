<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use XTrees\CMS\Database\Factories\ImageFactory;

/**
 * XTrees\CMS\Models\Image
 *
 * @property int $id
 * @property int $content_id
 * @property string $storage
 * @property string $path
 * @property int $cover
 * @property int $sort
 * @property int $display
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $url
 * @method static \Illuminate\Database\Eloquent\Builder|Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Image query()
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereDisplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Image whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Image extends Model
{
    const STORAGE_REMOTE = 'remote';
    const STORAGE_OSS = 'oss';
    const STORAGE_LOCAL = 'local';

    use HasFactory;

    public static function factory(...$parameters): ImageFactory
    {
        return ImageFactory::new();
    }

    public function getUrlAttribute(): string
    {
        $storage = $this->getStorage();
        if (\Str::startsWith($this->path,'http')){
            return  $this->path;
        }
        if ($this->path) {
            return $storage->url($this->path);
        }
        return config('cms.view.image_holder');
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
