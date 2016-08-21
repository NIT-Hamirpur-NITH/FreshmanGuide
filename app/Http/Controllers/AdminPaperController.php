<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use Yajra\Datatables\Datatables;
use FreshmanGuide\Paper;
use FreshmanGuide\Subject;
use FreshmanGuide\Branch;

class AdminPaperController extends Controller
{
  /**
   * Return a view for listing papers
   */
  public function viewPapers() {
    return view('admin.papers');
  }

  /**
   * List papers
   */
  public function listPapers() {
    $articles = Paper::select(['id', 'year', 'type'])->orderBy('year', 'desc');

    return Datatables::of($articles)
    ->make(true);
  }

}
