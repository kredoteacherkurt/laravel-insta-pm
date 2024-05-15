@extends('layouts.app')
@section('title', 'home')
@section('content')
    <div class="row">
        <div class="col-8">
            @forelse($all_posts as $post)
                <div class="card mb-4">
                    <!-- title -->
                    @include('users.posts.contents.title')
                    <!-- @ include means Inserts content from file 'users/posts/contents/title' into current file. -->

                    <!-- body -->
                    @include('users.posts.contents.body')
                </div>
            @empty
                <!-- If the site doesnt have any pst yet. -->
                <div class="text-center">
                    <h2>Share Photos</h2>

                    <p class="text-muted">
                        When you share photos, they'll appear on your profile.
                    </p>

                    <a href="{{ route('post.create') }}" class="text-decoration-none">
                        Share your first photo.
                    </a>
                </div>
            @endforelse
        </div>
        <div class="col-4 bg-secondary">
            profile overview + suggestions
        </div>
    </div>
@endsection
