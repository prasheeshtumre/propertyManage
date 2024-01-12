 <div class="card">
     <div class="card-body">
         <div class="border-bottom pb-3">
             <div class="add_txt"><a target="_blank"
                     href="{{ route('admin.surveyor.report-property-details', $property->id) }}">{{ $property->project_name ?? 'N/A' }}</a>
             </div>
             <div class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                     {{ $property->club_house_details ?? 'N/A' }}</small></div>
             <div class="add_loc"><small><i class="fa-solid fa-location-dot"></i>
                     {{ $property->locality_name }}</small></div>
         </div>

         <div class="pt-2">
             @if ($propert_unit_sale->floor_units->count() > 0)
                 <div class="sale_txt"> For Sale ({{ $propert_unit_sale->floor_units->count() }})</div>
             @endif
             @if ($propert_unit_rent->floor_units->count())
                 <div class="sale_txt"> For Rent ({{ $propert_unit_rent->floor_units->count() }})</div>
             @endif

             <div class="" style="height:250px; overflow:auto;">

                 @forelse($property->floor_units as $units)
                     <div class="d-flex pt-2">

                         <div class="left_pr">
                             @if ($units->secondary_unit_data)
                                 @forelse($units->secondary_unit_data->unit_images as $unit_images)
                                     <a target="_blank"
                                         href="{{ config('app.propert') }}public{{ $units->secondary_unit_data->unit_images[0]->file_path }}/{{ $units->secondary_unit_data->unit_images[0]->file_name }}"
                                         data-fancybox="gallery">
                                         <img
                                             src="{{ config('app.propert') }}public{{ $units->secondary_unit_data->unit_images[0]->file_path }}/{{ $units->secondary_unit_data->unit_images[0]->file_name }}">
                                     </a>
                                 @empty
                                     <a target="_blank"
                                         href="{{ config('app.propert') }}public/assets/images/svg/image-na.svg"
                                         data-fancybox="gallery">
                                         <img src="{{ config('app.propert') }}public/assets/images/svg/image-na.svg">
                                     </a>
                                 @endforelse
                             @else
                                 <a target="_blank"
                                     href="{{ config('app.propert') }}public/assets/images/svg/image-na.svg"
                                     data-fancybox="gallery">
                                     <img src="{{ config('app.propert') }}public/assets/images/svg/image-na.svg">
                                 </a>
                             @endif
                         </div>

                         <div class="right_pr">
                             <a target="_blank"
                                 href="{{ url('/') }}/admin/property/unit_details/{{ $units->id }}">
                                 <div class="unit_dd">
                                     #{{ $units->unit_name == '' ? $units->property_floor_map->floor_name : $units->unit_name }}
                                 </div>
                                 <div class="rr_price">
                                     &#8377;{{ $units->secondary_unit_data->expected_price ?? ($units->secondary_unit_data->expected_rent ?? 'N/A') }}
                                 </div>
                                 <div><small>{{ $units->secondary_unit_data->rooms ?? 'N/A' }} beds ·
                                         {{ $units->secondary_unit_data->washrooms ?? 'N/A' }} baths </small></div>
                                 <div><small>{{ $units->secondary_unit_data->carpet_area ?? ($units->secondary_unit_data->buildup_area ?? ($units->secondary_unit_data->super_buildup_area ?? 'N/A')) }}
                                         sq. ft.</small></div>
                             </a>
                         </div>
                     </div>
                 @empty
                 @endforelse
             </div>
         </div>

     </div>
 </div>
