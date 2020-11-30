<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Profile;

class ProfileController extends Controller
{
    //課題５で追記していく
     public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // 以下を追記
  // Varidationを行う
  $this->validate($request, Profile::$rules);
      $news = new Profile;
      $form = $request->all();
     
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
     
      // データベースに保存する
      $news->fill($form);
      $news->save();
      return redirect('admin/profile/create');
    }
    
     public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = News::where('title', $cond_title)->get();
      } else {
          $posts = News::all();
      }
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


    
   
    
     // 以下を追記

  public function edit(Request $request)
  {
      // Profile Modelからデータを取得する
      $news = Profile::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      return view('admin.profile.create', ['news_form' => $news]);
  }


  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Profile::$rules);
      // Profile Modelからデータを取得する
      $news = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $news_form = $request->all();
      if ($request->remove == 'true') {
          $news_form['image_path'] = null;
      } elseif ($request->file('image')) {
          $path = $request->file('image')->store('public/image');
          $news_form['image_path'] = basename($path);
      } else {
          $news_form['image_path'] = $news->image_path;
      }

      unset($news_form['image']);
      unset($news_form['remove']);
      unset($news_form['_token']);

      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();

      return redirect('admin/profile');
  }
}