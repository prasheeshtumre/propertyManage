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

            @if (!empty($property->secondary_unit_data))
                <div class="" style="height:250px; overflow:auto;">

                    <div class="d-flex pt-2">
                        <div class="left_pr">
                            @if (!empty($property->secondary_unit_data))
                                @if (count($property->secondary_unit_data->unit_images) > 0)
                                    {{-- @forelse($property->secondary_unit_data->unit_images as $image) --}}
                                    <a target="_blank"
                                        href="{{ config('app.propert') }}public{{ $property->secondary_unit_data->unit_images[0]->file_path }}/{{ $property->secondary_unit_data->unit_images[0]->file_name }}"
                                        data-fancybox="gallery">
                                        <img
                                            src="{{ config('app.propert') }}public{{ $property->secondary_unit_data->unit_images[0]->file_path }}/{{ $property->secondary_unit_data->unit_images[0]->file_name }}">
                                    </a>
                                    {{-- @empty
                                @endforelse --}}
                                @else
                                    <a target="_blank"
                                        href="{{ config('app.propert') }}public/assets/images/svg/image-na.svg"
                                        data-fancybox="gallery">
                                        <img src="{{ config('app.propert') }}public/assets/images/svg/image-na.svg">
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="right_pr">
                            <a target="_blank"
                                href="{{ url('/') }}/admin/property/plot-land/unit_details/{{ $property->id }}">
                                <div class="rr_price">
                                    &#8377;{{ $property->secondary_unit_data->expected_price ? $property->secondary_unit_data->expected_price : ($property->secondary_unit_data->expected_rent ? $property->secondary_unit_data->expected_rent : 'N/A') }}
                                </div>
                                <div><small>{{ $property->secondary_unit_data->plot_area ?? 'N/A' }} sq.
                                        ft.</small></div>
                                <div><small>{{ $property->locality_name ?? 'N/A' }}</small></div>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
