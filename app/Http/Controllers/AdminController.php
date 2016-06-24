<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Article;
use FreshmanGuide\Exceptions\AdminException;

class AdminController extends Controller
{
    
    public function lister(Request $request) {
        
        $articles = Article::orderBy('updated_at', 'desc')->get();
        if (!$articles) {
            abort(404);
        }

        return view('admin.list', [
            'articles' => $articles
        ]);

    } 


    public function delete(Request $request, $searchid) {
        $article = Article::where('searchid', $searchid)->first();
        if (!$article) {
            abort(404);
        }

        if ($article->delete()) {
            return redirect('/admin')->with([
                'success' => "Delted the article : " . $article->id
            ]);
        } else {
            throw new AdminException("Cann't delete, somthing happened", 500);
        }
    }


    public function publish(Request $request, $searchid) {
        $article = Article::where('searchid', $searchid)->first();
        if (!$article) {
            abort(404);
        }
        $article->published = true;
        $article->edited = false;
        $article->new = false;
        if ($article->save()) {
            return redirect('/admin')->with([
                'success' => "Published the article : " . $article->id
            ]);
        } else {
            throw new AdminException("Can't publish, somthing happened", 500);
        }
    }

    public function unpublish(Request $request, $searchid) {
        $article = Article::where('searchid', $searchid)->first();
        if (!$article) {
            abort(404);
        }
        $article->published = false;
        $article->edited = false;
        $article->new = true;
        if ($article->save()) {
            return redirect('/admin')->with([
                'success' => "Unpublished the article : " . $article->id
            ]);
        } else {
            throw new AdminException("Can't unpublish, somthing happened", 500);
        }
    }

    public function logout(Request $request) {
        \Auth::logout();
        return redirect()->to('/');
    }

}
