<?php

namespace App\Http\Controllers;

use App\article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ArticlesController extends Controller
{
    /*******************************dashboard*********************/
    public function ajouterArticle(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo'<pre>';print_r($data);die;
            $article = new article();
            $article->title = $data['title'];
            $article->content = $data['content'];
            $article->image = '';
            if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_path = 'img/articles/l/' . $filename;
                    $medium_path = 'img/articles/m/' . $filename;
                    Image::make($image_tmp)->save($large_path);
                    Image::make($image_tmp)->resize(520, 340)->save($medium_path);
                    $article->image = $filename;
                }
            }
            $article->quote = strtoupper($data['quote']);
            $article->author = ucfirst($data['author']);
            $article->save();
            return redirect('/voir-articles')->with('flash_message_success', 'Article a été ajouté');
        }
        return view('dashboard.article.Ajout_article');
    }
    public function voirArticles()
    {
        $article = article::paginate(10);
        return view('dashboard.article.Voir_Article')->with(compact('article'));
    }

    public function modifierArticle(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            article::where('id', $id)->update([
                'title' => $data['title'], 'content' => $data['content'],
                'quote' => $data['quote'], 'author' => $data['author']
            ]);
            if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_path = 'img/articles/l/' . $filename;
                    $medium_path = 'img/articles/m/' . $filename;
                    Image::make($image_tmp)->save($large_path);
                    Image::make($image_tmp)->resize(520, 340)->save($medium_path);
                    article::where('id', $id)->update(['image' => $filename]);
                }
            }
            return redirect('/voir-articles')->with('flash_message_success', 'Article modifiée avec succée');
        }
        $article = article::where('id', $id)->first();
        return view('dashboard.article.Modifier-article')->with(compact('article'));
    }


    public function delete(Request $request)
    {
        $id = $request->article_id;
        article::where('id', $id)->delete();
        return back()->with('flash_message_success', "L'article à été supprimé avec succés");
    }

    /*******************************vitrine*********************/
    public function viewArticles()
    {
        $articles = article::paginate(10);
        return view('vitrine.article.articles')->with(compact('articles'));
    }
    public function viewSingleArticle($id = null)
    {
        $article = article::where('id', $id)->first();
        $articles = article::where('id', '!=', $id)->limit(4)->get();
        $previous = article::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $next = article::where('id', '>', $id)->orderBy('id')->first();
        return view('vitrine.article.single-article')->with(compact('article', 'articles', 'previous', 'next'));
    }
}
