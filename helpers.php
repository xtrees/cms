<?php

function cms_view($view = null, $data = [], $mergeData = [])
{
    $prefix = config('cms.theme');
    $view = empty($prefix) ? $view : $prefix . '.' . $view;
    return view($view, $data, $mergeData);
}

