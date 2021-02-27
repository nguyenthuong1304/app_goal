<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class InfiniteScroll
{
  public static function requestAjax(Request $request, LengthAwarePaginator $articles)
  {
    if ($request->ajax()) {
      return response()->json([
          'html' => view('articles.list', ['articles' => $articles])->render(),
          'next' => $articles->nextPageUrl()
      ]);
    }
  }
}
