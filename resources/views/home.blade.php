@extends('layouts.front')

@section('content')
    <!-- Post preview-->
    @if ($posts->count())
        @foreach ($posts as $post)
            <div class="post-preview">
                <a href="{{ route('post.show', $post->slug) }}">
                    <h2 class="post-title">{{ $post->title }}</h2>
                    <p class="post-content">{{ $post->content }}</p>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">{{ $post->user->name }}</a>
                    <span class="d-block">
                        {{ $post->created_at }}
                    </span>
                </p>
            </div>
            <hr class="my-4" />
        @endforeach

        <!-- Pager-->
        @if ($posts->onFirstPage())
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary text-uppercase" href="{{ $posts->nextPageUrl() }}">
                    Next Posts
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @elseif (!$posts->onLastPage())
            <div class="d-flex justify-content-between mb-4">
                <a class="btn btn-primary text-uppercase" href="{{ $posts->previousPageUrl() }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    Previous Posts</a>
                <a class="btn btn-primary text-uppercase" href="{{ $posts->nextPageUrl() }}">
                    Next Posts
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="d-flex justify-content-start mb-4">
                <a class="btn btn-primary text-uppercase" href="{{ $posts->PreviousPageUrl() }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    Previous Posts</a>
            </div>
        @endif
    @else
        <div class="text-center">
            <p class="fs-3">
                <em>
                    Oops, it seems there are no posts in this page at the moment!
                </em>
            </p>
        </div>
    @endif

@endsection
