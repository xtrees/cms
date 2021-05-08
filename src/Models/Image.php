<?php

namespace XTrees\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    const STORAGE_REMOTE = 'remote';
    const STORAGE_OSS = 'oss';
    const STORAGE_LOCAL = 'local';

    use HasFactory;
}
