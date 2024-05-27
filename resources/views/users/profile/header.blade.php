<div class="row">
    <div class="col-4">
        <div class="d-flex align-items-center justify-content-center">
            @if($user->avatar)
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle shadow p-1 avatar-lg">
            @else
                <i class="fa-solid fa-circle-user text-secondary icon-lg"></i>
            @endif
        </div>
    </div>
    <div class="col-8">
        <div class="row mb-3 ms-1">
            <div class="col-auto">
                <h2 class="display-6 mb-0">
                    {{ $user->name }}
                </h2>
            </div>
            <div class="col-auto p-2">
            <!-- If the user is viewing their own profile, it shows an "Edit Profile" button, and if they are viewing another user's profile, it shows a "Follow" button. -->
                @if(Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">
                        Edit Profile
                    </a>
                @else

                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">
                                Follow
                            </button>
                        </form>

                @endif
            </div>
        </div>
        <div class="row mb-3 ms-1">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong>{{ $user->posts->count() }}</strong>
                   Posts
                </a>
            </div>
            <div class="col-auto">
                <a href="#" class="text-decoration-none text-dark">
                    <strong>3</strong>
                    Followers
                </a>
            </div>
            <div class="col-auto">
                <a href="" class="text-decoration-none text-dark">
                    <strong>3</strong> following
                </a>
            </div>
        </div>
        <p class="fw-bold ms-3">{{ $user->introduction }}</p>
    </div>
</div>
