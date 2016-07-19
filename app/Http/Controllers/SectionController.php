<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Exceptions\AdminException;
use FreshmanGuide\Section;

class SectionController extends Controller {

    public function home(Request $request) {
        $sections = Section::with(['articles' => function ($query) {
            $query->select('title', 'slug')->where('published', true);
        }])->get();
        if (!$sections) {
            throw new AdminException('Unable to fetch section', 0);
        }

        if ($request->ajax()) {
            return response()->json($sections);            
        } else {
            return view('material.sections', [
                'title' => 'Sections',
                'bodyClass' => 'index-page',
                'sections' => $sections,
            ]);
        }

    }

    public function articles(Request $request, $id) {
        $section = Section::where('id', $id)->first();
        if (!$section) {
            throw new AdminException('No such Section', 0);
        }

        return view('material.section-articles', [
            'title' => $section->name,
            'bodyClass' => 'index-page',
            'section' => $section,
            'articles' => $section->articles()->where('published', true)->get(),
        ]);

    }

    
}
