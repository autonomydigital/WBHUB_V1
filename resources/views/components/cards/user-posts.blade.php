@props(['user'])

@php
    $posts = $user->posts ?? collect();
@endphp

<div class="card border shadow-sm text-white">
    <div class="card-body">
        <h5 class="card-title text-white mb-4">
            <i class="ri-image-2-line me-2 text-info"></i>Posts
        </h5>

        @forelse ($posts as $post)
            <div class="mb-4 pb-4 border-bottom border-dark-subtle">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar-xs me-2">
                        <img src="{{ $user->avatarUrl() }}" alt="{{ $user->full_name }}" class="img-fluid rounded-circle">
                    </div>
                    <div>
                        <strong class="text-white">{{ $user->full_name }}</strong><br>
                        <small class="text-white-50">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>

                @if ($post->image)
                    <div class="ratio ratio-16x9 mb-3">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="rounded img-fluid object-fit-cover w-100 h-100">
                    </div>
                @endif

                @if ($post->caption)
                    <p class="text-white-50 mb-2">{{ $post->caption }}</p>
                @endif

                <div class="d-flex gap-3">
                    <button class="btn btn-sm btn-outline-light">
                        <i class="ri-heart-line me-1"></i> Like
                    </button>
                    <button class="btn btn-sm btn-outline-light">
                        <i class="ri-chat-1-line me-1"></i> Comment
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-image-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No posts yet.</p>
            </div>
        @endforelse
    </div>
</div>
