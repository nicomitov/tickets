<?php

function isActiveRoute($route, $output = "active")
{
    // $routes = [$route];

    // foreach ($routes as $route) {
        if (str_is($route, Route::currentRouteName())) return $output;
    // }
}

function isActiveMatch($string, $output = "active")
{
    if (strpos(url()->current(), $string)) {
        return $output;
    }
    return;
}

function isActiveUrl($string, $output = "active")
{
    if (str_is(url()->current(), $string)) {
        return $output;
    }
    return;
}

function sidebarIsActive($route, $segment_name, $segment_num = 1, $output = 'active')
{
    if (
        (str_is($route, Route::currentRouteName()) && Request::segment($segment_num) == $segment_name) ||
        (str_is('users.' . $route, Route::currentRouteName()) && Request::segment($segment_num + 2) == $segment_name)
    ) {
        return $output;
    }
}

function isActiveRouteAndSegment($route, $segment_name, $segment_num = 3, $output = 'active')
{
    if (str_is($route, Route::currentRouteName()) && Request::segment($segment_num) == $segment_name) {
        return $output;
    }
}

function isActiveSegment($route, $segment = 2, $output = "active")
{
    if (str_is(request()->segment($segment), $route)) return $output;
}

function isActiveSegments($route1, $route2, $segment1 = 2, $segment2 = 3, $output = "active")
{
    if ( str_is(request()->segment($segment1), $route1) && str_is(request()->segment($segment2), $route2) ) {
        return $output;
    }
}

// function entryType($segment = 1)
// {
//     $entryTypes = [
//         'articles',
//         'documents',
//         'passwds',
//         'tasks'
//     ];

//     if (in_array(request()->segment($segment), $entryTypes) ) {
//         return request()->segment($segment);
//     }
// }

function customPaginate($entries, $perPage = 10)
{
    $page = Request::input('page', 1); // Get the ?page=1 from the url
    //$perPage = 2; // Number of items per page
    $offset = ($page * $perPage) - $perPage;

    $entries = new Illuminate\Pagination\LengthAwarePaginator(
        array_slice($entries, $offset, $perPage, true), // Items we need
        count($entries), // Total items
        $perPage, // Items per page
        $page, // Current page
        ['path' => request()->url(), 'query' => request()->query()]
    );

    return $entries;
}

function implode_nm($array_expression, $col_name)
{
    $newArr = [];
    foreach ($array_expression as $value):
        $newArr[] = $value->$col_name;
    endforeach;
    return implode(', ', $newArr);
}

// function getThumb($img)
// {
//     $img_thumb = explode('/', $img);
//     $directory = dirname($img);
//     $thumbnail = $directory . '/thumbs/' . end($img_thumb);

//     return $thumbnail;
// }

// function getAvatar($img)
// {
//     if ($img == '/images/default.png') {
//         return '/images/thumb/default.png';
//     } else {
//         return getThumb($img);
//     }
// }

function newMsgsCount()
{
    $count = Auth::user()->newThreadsCount();
    if($count > 0) {
        return $count;
    }
}

function highlightString($str, $search_term = null) {
    if (is_null($search_term))
        return $str;

    $pos = strpos(strtolower($str), strtolower($search_term));

    if ($pos !== false) {
        $replaced = substr($str, 0, $pos);
        $replaced .= '<mark class="text-danger">' . substr($str, $pos, strlen($search_term)) . '</mark>';
        $replaced .= substr($str, $pos + strlen($search_term));
    } else {
        $replaced = $str;
    }

    return $replaced;
}

function getCheckitems($check)
{
    if($check->created_at->format('l') == 'Friday' && $check->created_at->format('H') > 18) {
        $checkitems = \App\Checkitem::evening()->orWhere('time', 'Петък')->get();
    }
    elseif($check->created_at->format('H') < 18) {
        $checkitems = \App\Checkitem::morning()->get();
    }
    else {
        $checkitems = \App\Checkitem::evening()->get();
    }

    return $checkitems;
}
