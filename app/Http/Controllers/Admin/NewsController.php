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
}