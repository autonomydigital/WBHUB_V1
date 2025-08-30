<div class="listing-item-container two-columns-grid fw-listing-item fw-listing-item2">
    @foreach ($properties as $property)
        <div class="listing-item">
            <div class="geodir-category-listing">
                <div class="geodir-category-img">
                    <a href="{{ route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug]) }}" class="geodir-category-img_item">
                        <div class="bg" data-bg="{{ $property->coverImageUrl }}"></div>
                        <div class="overlay"></div>
                    </a>
                    <div class="geodir-category-location">
                        <a href="#" class="map-item tolt single-map-item"
                           data-newlatitude="{{ $property->latitude }}"
                           data-newlongitude="{{ $property->longitude }}"
                           data-microtip-position="top" data-tooltip="On the map">
                            <i class="fas fa-map-marker-alt"></i> {{ $property->address }}
                        </a>
                    </div>
                    <ul class="list-single-opt_header_cat">
                        <li><a href="#" class="cat-opt">{{ ucfirst($property->listing_type) }}</a></li>
                        <li><a href="#" class="cat-opt">{{ $property->category }}</a></li>
                    </ul>
                    <a href="#" class="geodir_save-btn tolt" data-microtip-position="left" data-tooltip="Save">
                        <span><i class="fal fa-heart"></i></span>
                    </a>
                    <div class="geodir-category-listing_media-list">
                        <span><i class="fas fa-camera"></i> {{ $property->image_count }}</span>
                    </div>
                </div>

                <div class="geodir-category-content">
                    <h3><a href="{{ route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug]) }}">
                        {{ $property->title }}</a></h3>
                    <div class="geodir-category-content_price">{{ $property->price_formatted }}</div>
                    <p>{{ Str::limit($property->description, 120) }}</p>
                    <div class="geodir-category-content-details">
                        <ul>
                            <li><i class="fa-light fa-bed"></i><span>{{ $property->bedrooms }}</span></li>
                            <li><i class="fa-light fa-bath"></i><span>{{ $property->bathrooms }}</span></li>
                            <li><i class="fa-light fa-chart-area"></i><span>{{ $property->area }} ft<sup>2</sup></span></li>
                        </ul>
                    </div>
                </div>

                <div class="geodir-category-footer">
                    <a href="#" class="gcf-company">
                        <img src="{{ optional($property->agent)->avatarUrl ?? asset('default-avatar.jpg') }}" alt="Agent Avatar">
                        <span>
                            By {{ optional($property->agent)->name ?? 'Unknown Agent' }}
                        </span>
                    </a>
                    <a href="{{ route('plp.property.show', ['business' => $business->subdomain, 'slug' => $property->slug]) }}" class="gid_link">
                        <span>View Details</span> <i class="fa-solid fa-caret-right"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if ($properties->hasPages())
<div class="pagination-wrap ajax-pagination">
    {!! $properties->appends(request()->except('page'))->links('websitecontent::websites.plp.partials.pagination') !!}
</div>
@endif