<?php

namespace XTrees\CMS;

use Illuminate\Database\Eloquent\Collection;
use XTrees\CMS\Models\Tag;
use XTrees\CMS\Repositories\CMSRepo;

class CMS
{
    // Build wonderful things
    public function tagCloud($limit = 10): Collection
    {
        return (new CMSRepo())->tagPosition(Tag::PS_CLOUD, $limit);
    }
}
