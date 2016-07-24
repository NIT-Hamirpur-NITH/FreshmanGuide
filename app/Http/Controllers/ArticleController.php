<?php

namespace FreshmanGuide\Http\Controllers;
use Log;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Article;
use FreshmanGuide\Comment;

class ArticleController extends Controller
{
    public function add(Request $request) {

        return view('articles.add', [
            'title' => 'Add Article',
            'bodyClass' => 'no-sidebar',
        ]);
    }

    public function create(Request $request) {
        if ($request->input('title') == '') {
            return reponse()->json([
                'success' => false,
                'error' => 'Please enter a title',
            ]);
        } 

        $slug = \Slugify::slugify($request->input('title'));
        $article = Article::where('slug', $slug)->first();

        if ($article) {
            return response()->json([
                'success' => false,
                'error' => 'This title is not available',
            ]);
        }

        $article = new Article();
        $id = uniqid('article');
        $article->title = $request->input('title');
        $article->slug = $slug;
        $article->content = '';
        $article->published = false;
        $article->new = true;
        $article->searchid = $id;
        $article->edited = false;

        if ($article->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Article created',
                'searchId' => $article->searchid, 
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Unable to create, something bad happened',
            ]);
        }
        $article->save();

        return redirect()->to('/edit/' . $article->searchid);
    }


    public function edit(Request $request, $searchid) {

        $article = Article::where('searchid', '=', $searchid)->first();
        // dd($slug);
        if (!$article) {
            return response('The article is not found', 404);
        }

        return view('material.edit', [
            'article' => $article,
            'bodyClass' => 'index-page',
            'comments' => $article->comments()->where('hide', false)->orderBy('created_at', 'decr')->get(),
            'title' => 'Editing',
        ]);

    }

    /**
     *  Change the title of the article
     **/
    public function titleChange(Request $request, $searchid) {

        if ($request->input('title') == '') {
            return reponse()->json([
                'success' => false,
                'error' => 'Please enter a title',
            ]);
        } 

        $slug = \Slugify::slugify($request->input('title'));
        $article = Article::where('slug', $slug)->first();

        if ($article && $article->searchid != $searchid) {
            return response()->json([
                'success' => false,
                'error' => 'This title is not available',
            ]);
        }

        if ($article && $article->searchid == $searchid) {
            return response()->json([
                'success' => false,
                'error' => 'You have not changed anything',
            ]);
        }

        $article = Article::where('searchid', $searchid)->first();

        if (!$article) {
            return response()->json([
                'success' => false,
                'error' => 'Article not found',
            ]);
        }

        $article->title = $request->input('title');
        $article->slug = $slug;

        if ($article->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Title has been changed',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Unable to save the title, something bad happened',
            ]);
        }

    }


    public function save(Request $request, $searchid) {
        $oldTitle = false;

        $article = Article::where('searchid', '=', $searchid)->first();
        if (!$article) {
            return response('There is no article to save', 404);
        }

        if ($request->has('content')) {
            $article->content = $request->input('content');
        }
        if ($request->has('title')) {
            if ('Temporary Title' === $request->input('title')) {
                $oldTitle = true;
            }
            $article->title = $request->input('title');
        }

        if (!$oldTitle) {
            $article->slug = \Slugify::slugify($article->title);
        }

        if ($article->published || $article->new || $article->edited) {
            $article->edited = true;
            $article->new = false;
            $article->published = false;
        }

        if (!$article->new && !$article->published && !$article->edited) {
            $article->new = true;
        }

        if($article->save()) {
            if ($oldTitle) {
                return response('Article saved, but please change the title', 200);    
            } else {
                return response('Article saved', 200);
            }
        } else {
            return response('Error saving', 500);
        }

    }

    
    public function read(Request $request, $slug) {

        $article = Article::where('slug', $slug)->where('published', true)->first();
        if (!$article) {
            return response('There is no article to save', 404);
        }

        $read = $request->cookie('freshman_read');
        $articles = '' . $article->id;
        if ($read) {
            $articles = explode(',', $read);
            if (!in_array($article->id, $articles)) {
                array_push($articles, $article->id);
                $articles = implode(',', $articles);
                $article->visits = $article->visits + 1;
                $article->save();
            } else {
                $articles = implode(',', $articles);
            }
        } else {
            $article->visits = $article->visits + 1;
            $article->save();
        }
        

        $response = new \Illuminate\Http\Response(view('material.read', [
            'article' => $article,
            'title' => $article->title,
            'bodyClass' => 'index-page',
            'read' => $read,
        ]));
        $response->withCookie('freshman_read', $articles);
        return $response;

    }


    public function addComment(Request $request, $searchid) {

        if ($request->input('message') == '') {
            return response()->json([
                'success' => false,
                'error' => 'Please enter a comment',
            ]);
        }

        $article = Article::where('searchid', $searchid)->first();

        if (!$article) {
            return response()->json([
                'success' => false,
                'error' => 'Article not found',
            ]);
        }

        $comment = new Comment();
        $comment->message = $request->input('message');
        $comment->reply = '';
        $comment->article()->associate($article);

        if ($comment->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment has been added',
                'id' => $comment->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Unable to save the comment',
            ]);
        }

    }


}
