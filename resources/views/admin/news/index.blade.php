@extends('layouts.admin')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>動画一覧(管理用)</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="{{ action('Admin\NewsController@add') }}" role="button" class="btn btn-success m-5">新規投稿</a>
            </div>
            
            <div class="col-md-12 text-center">
                <form action="{{ action('Admin\NewsController@index') }}" method="get">
                    <div class="form-group row  d-flex justify-content-center">
                        <div class="col-md-6 mb-2">
                            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}" placeholder="タイトルを検索">
                        </div>
                        <div class="col-md-2 mb-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    @foreach($posts as $news)
                        <div  class="col-md-6">
                            <div class="border shadow p-3 my-2">
                                <div class="text-center h5">{{ \Str::limit($news->title, 20) }}</div>
                                <div class="movie-wrap">{!! $news->url !!}</div>
                                <div class="text-center">投稿日：{!! $news->created_at->format('Y/m/d') !!}</div>
                                <div class="text-center">編集日：{!! $news->updated_at->format('Y/m/d') !!}</div>
                                <div class="text-center d-flex justify-content-center">
                                    <div class="my-2 mr-4 btn btn-primary button-color">
                                        <a href="{{ action('Admin\NewsController@edit', ['id' => $news->id]) }}">編集</a>
                                    </div>
                                    <div class="my-2 ml-4 btn btn-danger button-color">
                                        <a href="{{ action('Admin\NewsController@delete', ['id' => $news->id]) }}">削除</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection