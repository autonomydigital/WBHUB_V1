<div class="sb-container fixed-bar">
    <div class="main-sidebar-widget">
        <div class="search-widget">
            <form action="#">
                <input type="text" class="search-inpt-item" placeholder="Search..">
                <button class="search-submit color-bg"><i class="fa-regular fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

    <div class="boxed-content">
        <div class="boxed-content-title"><h3>Recent Posts</h3></div>
        <div class="boxed-content-item bc-item_smal_pad">
            <ul>
                @foreach($recentPosts ?? [] as $recent)
                    <li>
                        <div class="recent-post-img"><img src="{{ asset('images/all/1.jpg') }}"></div>
                        <div class="recent-post-content">
                            <h4><a href="#">{{ $recent->title }}</a></h4>
                            <div class="recent-post-opt">
                                <span class="post-date">{{ $recent->published_at->format('F j, Y') }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>