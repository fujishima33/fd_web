@extends('layouts.common')
@section('title', '登録済みニュースの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>動画一覧</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="{{ action('Admin\NewsController@common') }}" method="get">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection