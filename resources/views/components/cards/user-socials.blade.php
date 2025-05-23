@props(['user'])

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Socials</h5>

        @if ($user->socials->isEmpty())
            <div class="text-center">
                <div class="avatar-md mx-auto mb-3">
                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                        <i class="ri-links-line"></i>
                    </span>
                </div>
                <p class="mb-0 text-muted fst-italic">No social accounts linked yet.</p>
            </div>
        @else
            <div class="d-flex flex-wrap gap-2">
                @foreach ($user->socials as $social)
                    @php
                        $platform = strtolower($social->platform);
                        $handle = $social->handle;
                        $platformIcons = [
                            'github' => ['icon' => 'ri-github-fill', 'color' => 'bg-dark', 'url' => "https://github.com/{$handle}"],
                            'website' => ['icon' => 'ri-global-fill', 'color' => 'bg-primary', 'url' => $handle],
                            'dribbble' => ['icon' => 'ri-dribbble-fill', 'color' => 'bg-success', 'url' => "https://dribbble.com/{$handle}"],
                            'pinterest' => ['icon' => 'ri-pinterest-fill', 'color' => 'bg-danger', 'url' => "https://pinterest.com/{$handle}"],
                            'facebook' => ['icon' => 'ri-facebook-fill', 'color' => 'bg-primary', 'url' => "https://facebook.com/{$handle}"],
                            'instagram' => ['icon' => 'ri-instagram-line', 'color' => 'bg-danger', 'url' => "https://instagram.com/{$handle}"],
                            'twitter' => ['icon' => 'ri-twitter-fill', 'color' => 'bg-info', 'url' => "https://twitter.com/{$handle}"],
                            'linkedin' => ['icon' => 'ri-linkedin-fill', 'color' => 'bg-primary', 'url' => "https://linkedin.com/in/{$handle}"],
                        ];
                        $iconData = $platformIcons[$platform] ?? ['icon' => 'ri-links-line', 'color' => 'bg-secondary', 'url' => $handle];
                    @endphp

                    <div>
                        <a href="{{ $iconData['url'] }}" target="_blank" class="avatar-xs d-block">
                            <span class="avatar-title rounded-circle fs-16 {{ $iconData['color'] }}">
                                <i class="{{ $iconData['icon'] }}"></i>
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>