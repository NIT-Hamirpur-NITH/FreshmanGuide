<?php

namespace FreshmanGuide\Http\Controllers;
use Log;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Article;

class ArticleController extends Controller
{
    public function create(Request $request) {

        $id = uniqid('article');
        $article = new Article();
        $article->title = 'You new title give it a new name';
        $article->slug = \Slugify::slugify($article->title. $id);
        $article->content = '<h1>Sample Content </h1>';
        $article->published = false;
        $article->new = false;
        $article->searchid = $id;
        $article->edited = false;
        $article->save();

        return redirect()->to('/edit/' . $article->searchid);
    }

    public function edit(Request $request, $searchid) {

        $article = Article::where('searchid', '=', $searchid)->first();
        // dd($slug);
        if (!$article) {
            return response('The article is not found', 404);
        }

        return view('articles.edit', [
            'article' => $article,
        ]);

    }


    public function save(Request $request, $searchid) {
        Log::info('Saving article..');
        $article = Article::where('searchid', '=', $searchid)->first();
        if (!$article) {
            return response('There is no article to save', 404);
        }

        $article->content = $request->input('content');


        if ($article->published || $article->new || $article->edited) {
            $article->edited = true;
            $article->new = false;
            $article->published = false;
        }

        if (!$article->new && !$article->published && !$article->edited) {
            $article->new = true;
        }

        if($article->save()) {
            return response('Article saved', 200);
        } else {
            return response('Error saving', 500);
        }

    }


    public function delete(Request $request, $slug) {

        $article = Article::where('slug', '=', $slug)->first();
        if (!$article) {
            return response('There is no article to save', 404);
        }

        $user = $request->user();
        if ($article->user->id != $user->id) {
            return response('You can\'t save this. Forbidden', 403);
        }

        if ($article->delete()) {
            return redirect('/add');
        } else {
            return response('Unable to delete', 200);
        }

    }


}
