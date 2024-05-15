@extends('layouts.app')

@section('title', 'Show Post')

@section('content')
    <div class="row border shadow">
        <div class="col p-0 border-end">
            <img src="{{ $post->image }}" alt="{{ $post->id }}" class="w-100">
        </div>
        <div class="col-4 px-0 bg-white overflow-y-auto">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="">
                                @if ($post->user->avatar)
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-0">
                            <a href="" class="text-decoration-none text-dark">
                                {{ $post->user->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            <!-- If you are the owner of the post, you can EDIT or DELETE this post -->
                            @if (Auth::user()->id === $post->user->id)
                                <div class="dropdown">
                                    <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </a>

                                        <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete-post-{{ $post->id }}">
                                            <i class="fa-regular fa-trash-can"></i> Delete
                                        </button>
                                    </div>
                                    <!-- Include modal here -->

                                    @include('users.posts.contents.modals.delete')
                                </div>
                            @else
                                <!-- If you are NOT the owner of the post, show a Unfollow button. -->
                                @if ($post->user->isFollowed())
                                    <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary">
                                            Unfollow
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                                        @csrf

                                        <button type="submit" class="border-0 bg-transparent p-0 text-primary">
                                            Follow
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body w-100 position-absolute top-100">
                    <!-- Heart Button + Number of Likes + Categories -->
                    <div class="row align-items-center">
                        <div class="col-auto">

                            <form action="" method="post">
                                @csrf

                                <button type="submit" class="btn btn-sm shadow-none p-0">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                            </form>

                        </div>
                        <div class="col-auto px-0">
                            <span>3</span>
                        </div>
                        <div class="col text-end">
                            @forelse($post->categoryPost as $category_post)
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </div>
                            @empty
                                <div class="badge bg-dark text-wrap">Uncategorized</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Owner + Description -->
                    <a href="" class="text-decoration-none text-dark fw-bold">
                        {{ $post->user->name }}
                    </a>
                    &nbsp;
                    <p class="d-inline fw-light">{{ $post->description }}</p>
                    <p class="text-uppercase text-muted xsmall">
                        {{ date('M d, Y', strtotime($post->created_at)) }}
                        {{--
                            date() function: This is a PHP function used to format a date.

                            strtotime() function: This function parses an English textual datetime description into a Unix timestamp.

                            $post->created_at: A timestamp representing the date and time when the post was created.

                            The format string 'M d, Y' specifies the desired format:

                            M: Three-letter abbreviation of the month (e.g., Jan, Feb, Mar).

                            d: Day of the month, 2 digits with leading zeros (e.g., 01, 02, 03).

                            Y: Four-digit year (e.g., 2022, 2023, 2024).
                        --}}
                    </p>



                </div>

            </div>
        </div>
    </div>
@endsection
