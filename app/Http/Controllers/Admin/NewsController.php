<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
  
  public function add()
  {
      return view('admin.news.create');
  }
  
  public function create(Request $request)
  {
    
      // Varidationを行う
      $this->validate($request, News::$rules);
      
      $news = new News;
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      
      // データベースに保存する
      $news->fill($form);
      $news->save();
      
      return redirect('admin/news/create');
  }
  
  public function common(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', 'like', "%$cond_title%")->orderBy('created_at', 'desc')->paginate(6);
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::orderBy('created_at', 'desc')->paginate(6);
      }
      return view('admin.news.common', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', 'like', "%$cond_title%")->orderBy('created_at', 'desc')->paginate(6);
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::orderBy('created_at', 'desc')->paginate(6);
      }
      // dd($posts);
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.news.edit', ['news_form' => $news]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, News::$rules);
      // News Modelからデータを取得する
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      unset($news_form['_token']);

      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();

      return redirect('admin/news');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/news/');
  }
}