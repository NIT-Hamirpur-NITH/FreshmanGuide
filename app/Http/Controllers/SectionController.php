<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Exceptions\AdminException;
use FreshmanGuide\Section;

class SectionController extends Controller {

    public function home(Request $request) {
        $sections = Section::all();
        if (!$sections) {
            throw new AdminException('Unable to fetch section', 0);
        }

        return view('sections.home', [
            'title' => 'Sections',
            'bodyClass' => 'no-sidebar',
            'sections' => $sections,
        ]);

    }

    public function articles(Request $request, $id) {
        $section = Section::where('id', $id)->first();
        if (!$section) {
            throw new AdminException('No such Section', 0);
        }

        return view('sections.articles', [
            'title' => $section->name,
            'bodyClass' => 'no-sidebar',
            'section' => $section,
            'articles' => $section->articles()->where('published', true)->get(),
        ]);

    }

    
}
