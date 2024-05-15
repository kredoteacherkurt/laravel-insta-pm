<!-- Clickable image -->
<div class="container p-0">
    <a href="{{ route('post.show', $post) }}">
        <img src="{{ $post->image }}" alt="{{ $post->id }}" class="w-100">
    </a>
</div>

<div class="card-body">
    <!-- Heart Button + Number of Likes + Categories -->
    <div class="row align-items-center">
        <div class="col-auto">
            <!-- This condition checks if the current user has liked the post. If the condition isLiked() returns true -->

            <form action="#" method="post">
                @csrf

                <button type="submit" class="btn btn-sm shadow-none p-0">
                    <i class="fa-regular fa-heart"></i>
                </button>
            </form>

        </div>
        <div class="col-auto px-0">
            <span>3</span>
            <!-- displaying the number of likes a particular post has. -->
        </div>
        <div class="col text-end">

            <div class="badge bg-secondary bg-opacity-50">
                @foreach ($post->categoryPost as $category_post)
                    {{ $category_post->category->name }}
                @endforeach
            </div>

        </div>
    </div>

    <!-- Owner + Description -->
    <a href="#" class="text-decoration-none text-dark fw-bold">
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
    <!-- Include comments here -->

</div>
