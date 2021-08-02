<?php

namespace XTrees\CMS\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Role extends Model
{
    const UNLIMITED = -1;

    public function unlimited(): bool
    {
        return $this->permission == self::UNLIMITED;
    }
}
