<div class="card">
    <div class="card-body">
        <div class="border-bottom pb-3">
            <div class="add_txt"><a target="_blank"
                    href="{{ route('admin.surveyor.report-property-details', $property->id) }}">{{ $property->street_details ?? 'N/A' }}</a>
            </div>
            <div class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                    {{ $property->locality_name ?? 'N/A' }}</small></div>
        </div>

        <div class="pt-2">
            @if ($property->up_for_sale > 0)
                <div class="sale_txt"> For Sale ({{ $property->up_for_sale }})</div>
            @endif
            @if ($property->up_for_rent > 0)
                <div class="sale_txt"> For Rent ({{ $property->up_for_rent }})</div>
            @endif
            <div class="" style="height:250px; overflow:auto;">

                <div class="d-flex pt-2">
                    <div class="left_pr">
                        @if (count($property->images) >= 1)
                            {{-- @forelse($property->images as $image) --}}
                            <a target="_blank"
                                href="{{ config('app.propert') }}public/uploads/property/images/{{ $property->images[0]->file_url }}"
                                data-fancybox="gallery">
                                <img
                                    src="{{ config('app.propert') }}public/uploads/property/images/{{ $property->images[0]->file_url }}">
                            </a>
                            {{-- @empty
                                @endforelse --}}
                        @else
                            <a target="_blank" href="{{ config('app.propert') }}public/assets/images/svg/image-na.svg"
                                data-fancybox="gallery">
                                <img src="{{ config('app.propert') }}public/assets/images/svg/image-na.svg">
                            </a>
                        @endif
                    </div>
                    <div class="right_pr">
                        <a target="_blank" href="{{ route('admin.surveyor.report-property-details', $property->id) }}">
                            <div class="unit_dd">{{ $property->project_name ?? 'N/A' }}</div>
                            <div class="unit_dd">{{ $property->getBuilderName->name ?? 'N/A' }}</div>
                            <div><small>{{ $property->locality_name ?? 'N/A' }}</small></div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
