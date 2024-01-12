@extends('admin.layouts.main')
@section('content')
    @php use App\Models\SecondaryUnitLevelData; @endphp
    <link href="{{ asset('assets/css/view-units.css?v=9') }}" rel="stylesheet" type="text/css" />
    <style>
        p {

            margin-bottom: 0px;

        }

        .count-list,
        .check-list {
            margin: 0;
            padding: 0;
            width: 100%
        }

        .count-list li {
            list-style: none;
            float: left;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 100px;
            margin: 5px;
            height: 36px;
            width: 36px;
            text-align: center;
            line-height: 10px;
            transition: 0.3s
        }

        .count-list li:hover {
            background: #f7ecff;
            border: solid 1px #000;
            transition: 0.3s;
            cursor: pointer;
        }

        .count-list li.active {
            background: #f7ecff;
            border: solid 1px #662e93;
            transition: 0.3s;
            color: #662e93
        }



        .check-list li {
            list-style: none;
            float: left;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 100px;
            margin: 5px;
            text-align: center;
            line-height: 10px;
            transition: 0.3s
        }

        .check-list li:hover {
            background: #f7ecff;
            border: solid 1px #000;
            transition: 0.3s;
            cursor: pointer;
        }

        .check-list li.active {
            background: #f7ecff;
            border: solid 1px #662e93;
            transition: 0.3s;
            color: #662e93
        }


        .btn-primary {
            background: #662e93 !important;
            border: solid 1px #662e93;
        }



        .form-label {
            position: relative;
        }

        .required::after {
            content: '*';
            color: red;
            position: absolute;
            right: -10px;
        }

        .box-bdr {
            border: solid 1px #ddd;
            padding: 0px;
            border-radius: 6px;
        }

        .form-control-b0 {
            border: none !important;
        }

        .form-control,

        .form-select {
            /*            min-height: 50px*/
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu span {
            line-height: 24px;
            display: flex
        }

        input[type=checkbox] {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .input-step.step-primary button {
            background: #f7ecff;
            border: solid 1px #662e93;
            color: #662e93
        }

        .simplecheck span {
            line-height: 24px;
            display: flex
        }

        .screen {
            display: none;
        }

        .visible {
            display: block;
        }


        /*.progress-bar {*/
        /*  transition: width 0.3s ease-in-out;*/
        /*}*/
        .progress-bar {
            background-color: #deedf6 !important;
            color: black !important;
        }

        .progress-bar1 {
            background-color: #299cdb !important;
            color: white !important;
        }

        .progress-bar.active {

            background-color: #299cdb !important;
            color: white !important;
        }

        .progress-info .progress-bar::after {
            border-left-color: #7ed1ff !important;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid pm-0">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    @if (
                        $secondary_level_unit_data->unit_cat_id == '102' &&
                            ($secondary_level_unit_data->property_cat_id == '1' || $secondary_level_unit_data->property_cat_id == '3'))
                        <h4 class="mb-sm-0">Office View</h4>
                    @elseif($secondary_level_unit_data->unit_cat_id == '104' && $secondary_level_unit_data->property_cat_id == '1')
                        <h4 class="mb-sm-0">Retail View</h4>
                    @elseif($secondary_level_unit_data->unit_cat_id == '150' && $secondary_level_unit_data->property_cat_id == '1')
                        <h4 class="mb-sm-0">Storage/Indusrty View</h4>
                    @elseif($secondary_level_unit_data->unit_cat_id == '151' && $secondary_level_unit_data->property_cat_id == '1')
                        <h4 class="mb-sm-0">Other View</h4>
                    @elseif($secondary_level_unit_data->unit_cat_id == '109' && $secondary_level_unit_data->property_cat_id == '1')
                        <h4 class="mb-sm-0">Hospitality View</h4>
                    @elseif($property->cat_id == '4' && $property->plot_land_type == '13')
                        <h4 class="mb-sm-0">Plot/Land View</h4>
                    @elseif($property->cat_id == '4' && $property->plot_land_type == '14')
                        <h4 class="mb-sm-0">Villa View</h4>
                    @elseif(
                        ($property->cat_id == '2' &&
                            $property->residential_type == '7' &&
                            $property->residential_sub_type == '9' &&
                            $unit_data->apartment_id == '1') ||
                            $unit_data->apartment_id == '2')
                        <h4 class="mb-sm-0">Serviced Apartments View</h4>
                    @elseif($property->cat_id == '2' && $property->residential_type == '7' && $property->residential_sub_type == '10')
                        <h4 class="mb-sm-0">Apartment View</h4>
                    @elseif($property->cat_id == '2' && $property->residential_type == '8' && $property->residential_sub_type == '12')
                        <h4 class="mb-sm-0">Villa View</h4>
                    @elseif($secondary_level_unit_data->property_cat_id == '6')
                        <h4 class="mb-sm-0">Demolished View</h4>
                    @elseif(
                        ($secondary_level_unit_data->property_cat_id == '2' || $secondary_level_unit_data->property_cat_id == '3') &&
                            $unit_data->apartment_id &&
                            $unit_data->apartment_id == '3')
                        <h4 class="mb-sm-0">1 RK View</h4>
                    @elseif(
                        $property->cat_id == config('constants.RESIDENTIAL') &&
                            $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
                            $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
                        <h4 class="mb-sm-0">Individual House</h4>
                    @endif

                </div>
            </div>
            <!-- end page title -->

            <div class=" p-0 mb-3 mt-3">
                @include('admin.pages.property.units.views.includes.property_basic_details')
                <hr class="pb-3">
                <h4 class="page-header"><span>Property Details</span></h4>

                @include('admin.pages.property.units.views.includes.unit_property_details')


                @if ($secondary_level_unit_data->property_cat_id != '6')
                    <hr class="pb-3">
                    <h4 class="page-header"><span> Pricing & Other Details</span></h4>
                    @include('admin.pages.property.units.views.includes.unit_pricing_other_details')
                @endif

                <hr class="mb-3">
                <h4 class="page-header"><span> Add Images</span></h4>
                @include('admin.pages.property.units.views.includes.unit_image_details')

                @if ($secondary_level_unit_data->property_cat_id == '6')
                    <hr class="mb-3">
                    <div class="mainDiiv">
                        <div class=" ">
                            <div class="viewbedroomsText">
                                <div class="widthImage">
                                    <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid"
                                        style="width:50px;">
                                </div>
                                <hr class="mb-3">
                                <div>
                                    <div>
                                        <p><strong>Property History</strong></p>
                                    </div>
                                    <div class="extra-content">
                                        <p>{{ $secondary_level_unit_data->property_history }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" ">
                            <div class="viewbedroomsText">
                                <div class="widthImage">
                                    <img src="{{ url('public/assets/images/Layer_7.svg') }}" class="img-fluid"
                                        style="width:50px;">
                                </div>
                                <div>
                                    <div>
                                        <p><strong>Development Potential</strong></p>
                                    </div>
                                    <div class="extra-content">
                                        <p>{{ $secondary_level_unit_data->development_potential ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if ($property->cat_id != '4' && $property->plot_land_type != '13' && $secondary_level_unit_data->property_cat_id != '6')
                    <hr class="mb-3">
                    <h4 class="page-header"><span> Ameneties</span></h4>
                @endif
                @include('admin.pages.property.units.views.includes.unit_amenities_details')

                <div class="card-footer">
                    <div class="ms-auto text-end">
                        @php
                            $sub_type = $property->cat_id == config('constants.RESIDENTIAL') ? $property->residential_type : $property->plot_land_type;
                        @endphp
                        @if ($property->cat_id == 4 && $property->plot_land_type == 13)
                            <a href="{{ url('surveyor/property/plot-land/edit_unit_details/' . $property->id) }}"
                                class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                        @elseif($secondary_level_unit_data->property_cat_id == '6')
                            <a href="{{ url('surveyor/property/demolished/edit_unit_details/' . $property->id) }}"
                                class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                        @elseif(
                            $property->cat_id == config('constants.RESIDENTIAL') &&
                                $property->residential_type == config('constants.INDEPENDENT_HOUSE_VILLA') &&
                                $property->residential_sub_type == config('constants.INDIVIDUAL_HOUSE_APARTMENT'))
                            <a href="{{ url('surveyor/property/edit_unit_details/' . $secondary_level_unit_data->unit_id) }}"
                                class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                        @else
                            <a href="{{ url('surveyor/property/edit_unit_details/' . $secondary_level_unit_data->unit_id . '/' . $sub_type) }}"
                                class=" btn btn-done btn-primary ">Edit &nbsp;<i class=" fa fa-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- End Page-content -->

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © ProperT.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end  d-sm-block">
                            Design & Develop by <a href="https://vmaxindia.com/">VMAX</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@push('scripts')
    <script src="{{ url('public/assets/js/property/extra.js') }}"></script>
@endpush
