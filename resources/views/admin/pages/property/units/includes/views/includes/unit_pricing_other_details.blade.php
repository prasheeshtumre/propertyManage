  @php use App\Models\SecondaryUnitLevelData; @endphp
  <div class="mainDiiv">
      <div class="  ">
          <div class="viewbedrooms">
              <div>
                  <img src="{{ url('public/assets/images/Layer_rent.svg') }}" class="img-fluid">
              </div>
              <div>
                  <div>
                      <p><strong>Property Type</strong></p>
                  </div>
                  <div class="extra-content">
                      <p>{{ $secondary_level_unit_data->pricing_details_for == '1' ? 'Sale' : ($secondary_level_unit_data->pricing_details_for == 2 ? 'Rent' : ($secondary_level_unit_data->pricing_details_for == 3 ? 'Rented' : 'Sold')) }}
                      </p>
                  </div>
              </div>
          </div>
      </div>
      @if ($secondary_level_unit_data->pricing_details_for == '1')
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_Freehold.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Ownership Details</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOwnership($secondary_level_unit_data->ownership)->name ?? 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      @endif
      <div class="  ">
          <div class="viewbedrooms">
              <div>
                  <img src="{{ url('public/assets/images/Layer_PriceDetails.svg') }}" class="img-fluid">
              </div>
              <div>
                  <div>
                      <p><strong>{{ $secondary_level_unit_data->pricing_details_for == '1' ? 'Price Details' : 'Rent Details' }}</strong>
                      </p>
                      <p>{{ $secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->expected_price : $secondary_level_unit_data->expected_rent }}
                          ({{ $secondary_level_unit_data->price_per_sq_ft }} Sq.Ft)</p>
                  </div>
                  <div class="extra-content">
                      @if ($secondary_level_unit_data->pricing_details_for == '1')
                          @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'22') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) }}</p>
                          @empty
                          @endforelse
                      @else
                          @forelse(SecondaryUnitLevelData::getMultipleOptions($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id,'17') as $rec)
                              <p>{{ SecondaryUnitLevelData::getOptionName($rec->amenity_option_id) }}</p>
                          @empty
                          @endforelse
                      @endif
                  </div>
              </div>
          </div>
      </div>
      <div class="  ">
          <div class="viewbedrooms">
              <div>
                  <img src="{{ url('public/assets/images/Layer_AdditionaPricing.svg') }}" class="img-fluid img-mobile"
                      style="">
              </div>
              <div>
                  <div>
                      <p><strong>{{ $secondary_level_unit_data->pricing_details_for == '1'
                          ? 'Additional Pricing Details'
                          : 'Additional Rent Details' }}
                          </strong></p>
                      <p>{{ $secondary_level_unit_data->pricing_details_for == '1' ? $secondary_level_unit_data->expected_price : $secondary_level_unit_data->expected_rent }}{{ $secondary_level_unit_data->price_period }}
                      </p>
                  </div>
                  <div class="extra-content">
                      <p>Maintenance :
                          {{ $secondary_level_unit_data->pricing_details_for == '1'
                              ? $secondary_level_unit_data->mainteinance
                              : $secondary_level_unit_data->maintenance_rent }}
                          ({{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->maintenance_period) }})
                      </p>
                      @if ($secondary_level_unit_data->pricing_details_for == '1')
                          <p>Expected Rental :
                              {{ $secondary_level_unit_data->pricing_details_for == '1'
                                  ? $secondary_level_unit_data->expected_rental
                                  : $secondary_level_unit_data->expected_rent }}
                          </p>
                      @endif
                      <p>Booking Amount :
                          {{ $secondary_level_unit_data->pricing_details_for == '1'
                              ? $secondary_level_unit_data->booking_amount
                              : $secondary_level_unit_data->booking_amount_rent }}
                      </p>
                      <p>Annual dues payble :
                          {{ $secondary_level_unit_data->pricing_details_for == '1'
                              ? $secondary_level_unit_data->annual_due_pay
                              : $secondary_level_unit_data->annual_dues_rent }}
                      </p>
                      <p>Membership Charge :
                          {{ $secondary_level_unit_data->pricing_details_for == '1'
                              ? $secondary_level_unit_data->membership_charge
                              : $secondary_level_unit_data->membership_charge_rent }}
                      </p>
                  </div>
              </div>
          </div>
      </div>

      @if ($secondary_level_unit_data->pricing_details_for == '2')
          <div class="   ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_PreferredAgreement.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Preferred Agreement Type</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->agreement_type) : 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Duration of the Agreement</strong></p>
                      </div>
                      <div class="extra-content">
                          <p>{{ $secondary_level_unit_data->agreement_duration ? $secondary_level_unit_data->agreement_duration : 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Months of Notice</strong></p>
                      </div>
                      <div class="extra-content">
                          <!-- <p>None</p> -->
                          <p>{{ SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) ? SecondaryUnitLevelData::getOptionName($secondary_level_unit_data->notice_period) : 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      @endif


      @if (
          $secondary_level_unit_data->pricing_details_for == '1' ||
              ($secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1') ||
              ($property->cat_id == '2' && $property->residential_type == '7' && $property->residential_sub_type == '9'))
          <div class="  ">
              <div class="viewbedrooms">
                  <div>
                      <img src="{{ url('public/assets/images/Layer_DurationoftheAgreement.svg') }}" class="img-fluid">
                  </div>
                  <div>
                      <div>
                          <p><strong>Remarks On Property</strong></p>
                      </div>
                      <div class="extra-content">
                          <!-- <p>None</p> -->
                          <p>{{ $secondary_level_unit_data->remark ? $secondary_level_unit_data->remark : 'N/A' }}
                          </p>
                      </div>
                  </div>
              </div>
          </div>
      @endif
  </div>
