<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Response;

class PageController extends Controller
{
    public function __invoke(Page $page)
    {
        return Response::json(
            $page->only('title', 'content')
        );
    }
}
