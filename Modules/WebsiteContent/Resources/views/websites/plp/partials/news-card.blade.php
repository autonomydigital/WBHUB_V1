<div class="post-item">
    <div class="post-item_wrap">
        <div class="post-item_media">
            <a href="#"><img src="{{ asset('images/all/1.jpg') }}" alt=""></a>
            <ul class="post_header_cat">
                <li><a href="#" class="cat-opt">News</a></li>
            </ul>
        </div>
        <div class="post-item_content">
            <h3><a href="#">{{ $post->title }}</a></h3>
            <p>{{ $post->excerpt }}</p>
            <div class="post-card-details">
                <ul>
                    <li><i class="fa-light fa-calendar-days"></i><span>{{ $post->published_at->format('F j, Y') }}</span></li>
                </ul>
            </div>
            <a href="#" class="post-card_link">View Details <i class="fa-solid fa-caret-right"></i></a>
        </div>
    </div>
</div>