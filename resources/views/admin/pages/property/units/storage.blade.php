@extends('admin.layouts.main')
@section('content')
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
    @push('css')
        <link href="{{ asset('assets/css/unit-details.css') }}?v=2385" rel="stylesheet" type="text/css" />
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Storage Details </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="progress progress-step-arrow progress-info">
                            <a href="javascript:void(0);" class="progress-bar progress-bar1 active" role="progressbar"
                                style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property
                                Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                            <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%"
                                aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Add Images</a>
                            <a href="javascript:void(0);" class="progress-bar text-dark" role="progressbar"
                                style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities
                                Details(Optional)</a>
                        </div>
                        <!-- step -1 -->
                        <div class="mt-3 mb-3">
                            <div id="screens">
                                <!--1st screen-->

                                <form id="SubmitPropertyDetails" method="post">
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <input type="hidden" name="property_cat_id" value="{{ $property->cat_id }}">
                                    <input type="hidden" name="unit_id" value="{{ $unit_data->id }}">
                                    <input type="hidden" name="unit_type_id" value="{{ $unit_data->unit_type_id }}">
                                    <input type="hidden" name="unit_cat_id" value="{{ $unit_data->unit_cat_id }}">
                                    <input type="hidden" name="unit_sub_cat_id" value="{{ $unit_data->unit_sub_cat_id }}">
                                    <div class=" screen visible">
                                        <h4 class="mb-3">Property Details </h4>
                                        <div class="row mt-3 mb-3">
                                            <div class="col-md-4">
                                                <p><b>GIS Id : </b> <span class="project-head">
                                                        {{ $property->gis_id }}</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><b>Locality Name : </b> <span class="project-head">
                                                        {{ $property->locality_name }}</span></p>
                                            </div>
                                            <div class="col-md-4">
                                                <p><b>Address : </b> <span class="project-head">
                                                        {{ $property->street_details }}</span></p>
                                            </div>
                                        </div>

                                        <label class="form-label required">No of Bathrooms</label>
                                        <div class="row align-items-start mb-3">
                                            <div class="col-md-12 mb-3">

                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="radio-toolbar" id="AppendStaricase">
                                                            <input type="radio" id="radio2" name="no_of_bathrooms"
                                                                value="1">
                                                            <label for="radio2">1</label>
                                                            <input type="radio" id="radio3" name="no_of_bathrooms"
                                                                value="2">
                                                            <label for="radio3">2</label>
                                                            <input type="radio" id="radio4" name="no_of_bathrooms"
                                                                value="3">
                                                            <label for="radio4">3</label>
                                                            <input type="radio" id="radio5" name="no_of_bathrooms"
                                                                value="4">
                                                            <label for="radio5">4</label>
                                                        </div>
                                                    </div>
                                                    <span id="errno_of_bathrooms"></span>
                                                </div>
                                            </div>
                                            <div class=" col-md-2">
                                                <a style="color: var(--vz-link-color);" id="AddStaircase"> + Add other</a>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="text" style="display:none" class="form-control col-md-3"
                                                    id="ExtraStaircase">
                                            </div>
                                            <div class="col-md-2" id="ShowStaircaseDone" style="display:none">
                                                <button type="button" class="btn btn-done btn-primary"
                                                    id="AddExtraStaircase">Done</button>
                                            </div>
                                            <span id="errstaircase"></span>
                                        </div>

                                        <label class=" form-label required">Add Area Details </label>
                                        <div class="row align-items-center mt-3 mb-3">
                                            <div class="col-md-4">
                                                <div class="box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text"
                                                                class="form-control form-control-b0 col-md-3 border-none"
                                                                maxlength="11" onkeypress="return isNumber(event)"
                                                                name="carpet_area" id="CarpetArea"
                                                                placeholder="carpet area">
                                                        </div>

                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0"
                                                                name="carpet_area_unit">
                                                                @forelse($area_detail_units as $unit)
                                                                    <option value="{{ $unit->id }}">
                                                                        {{ $unit->name }}</option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="errcarpet_area"></span>

                                            <div class="clearfix mb-3"></div>

                                            <div class="col-md-4" id="BuiltUp" style="display:none">
                                                <div class=" box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11"
                                                                class="form-control form-control-b0 col-md-3 border-none"
                                                                name="buildup_area" onkeypress="return isNumber(event)"
                                                                id="BuildupArea" placeholder="Add Built up area">
                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0"
                                                                name="buildup_area_unit">
                                                                @forelse($area_detail_units as $unit)
                                                                    <option value=" {{ $unit->id }}">
                                                                        {{ $unit->name }}</option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix mb-3"></div>

                                            <div class="col-md-4" id="SuperBuiltUp" style="display:none">
                                                <div class="box-bdr">
                                                    <div class="d-flex">
                                                        <div>
                                                            <input type="text" maxlength="11"
                                                                class="form-control form-control-b0 col-md-3 border-none"
                                                                onkeypress="return isNumber(event)"
                                                                name="super_buildup_area" id="SuperBuildupArea"
                                                                placeholder="Add Super Built up area">
                                                        </div>
                                                        <div class="ms-auto" style="">
                                                            <select class="form-select form-control-b0"
                                                                name="super_buildup_area_unit">
                                                                @forelse($area_detail_units as $unit)
                                                                    <option value=" {{ $unit->id }}">
                                                                        {{ $unit->name }}</option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix mb-3"></div>
                                            <div class="col-md-2">
                                                <a style="color: var(--vz-link-color);" id="ShowBuiltUp"> + Add Built up
                                                    area</a>
                                            </div>

                                            <div class="col-md-3">
                                                <a style="color: var(--vz-link-color);" id="ShowSuperBuiltUp"> + Add Super
                                                    Built up area</a>
                                            </div>

                                        </div>



                                        <label class="form-label required">Property Facing</label>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar-text">
                                                    @forelse($property_facings as $prop_face)
                                                        <input type="radio" id="PropFace-{{ $prop_face->id }}"
                                                            name="property_facing" value="{{ $prop_face->id }}">
                                                        <label
                                                            for="PropFace-{{ $prop_face->id }}">{{ $prop_face->name }}</label>
                                                    @empty
                                                    @endforelse
                                                </div>
                                                <span id="errproperty_facing"></span>
                                            </div>
                                        </div>

                                        <label class="form-label required">Availability Status</label>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-12 mb-3">
                                                <div class="radio-toolbar-text">
                                                    @forelse($availability_status as $avlbl_sts)
                                                        <input type="radio" id="avlbl_sts-{{ $avlbl_sts->id }}"
                                                            name="availability_status" value="{{ $avlbl_sts->id }}">
                                                        <label
                                                            for="avlbl_sts-{{ $avlbl_sts->id }}">{{ $avlbl_sts->name }}</label>
                                                    @empty
                                                    @endforelse
                                                </div>
                                                <span id="erravailability_status"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="AgeOfProperty" style="display:none">
                                            <label class="form-label m-0 required">Age of Property <span
                                                    style="color:red">*</span></label>
                                            <div class=" col-md-12">
                                                <div class="radio-toolbar-text">
                                                    @forelse($age_of_property as $property_age)
                                                        <input type="radio" id="property_age-{{ $property_age->id }}"
                                                            name="property_age" value="{{ $property_age->id }}">
                                                        <label
                                                            for="property_age-{{ $property_age->id }}">{{ $property_age->name }}</label>
                                                    @empty
                                                    @endforelse
                                                </div>
                                                <span id="errproperty_age"></span>
                                            </div>
                                        </div>

                                        <div class="row mb-3" id="PossesionBy" style="display:none">
                                            <label class="form-label m-0 required">Possesion by<span
                                                    style="color:red">*</span></label>
                                            <div class="col-md-3  align-items-center mt-1">
                                                <input type="date" class="form-control " name="possesion_by"
                                                    id="">
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="ms-auto text-end">
                                                <button class="btn btn-done btn-primary ">Next &nbsp;<i
                                                        class="fa fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @include('admin.pages.property.units.includes.pricing_and_other_details')
                            <!-- screen 3 -->
                            @include('admin.pages.property.units.includes.add_images')
                            <!--screen3 end-->

                            <!-- Section Amenities start -->
                            @include('admin.pages.property.units.includes.amenities')
                            <!-- Section Amenities end -->

                        </div>

                    </div> <!-- container-fluid -->
                </div>
            </div>










        </div> <!-- container-fluid -->
    </div> <!--End Page-content -->
@endsection
@push('scripts')
    <script src="{{ url('public/assets/js/property/extra.js') }}"></script>
    <script src="{{ url('public/assets/js/property/units/sqftPriceCalculator.js') }}?v=50"></script>
    <script>
        // @foreach ($errors->all() as $error)
        // toastr.error("{{ $error }}")
        // @endforeach
        // @if (Session::has('message'))
        // toastr.success("{{ Session::get('message') }}")
        // @endif
    </script>
    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        $(document).ready(function() {
            $("#Facilitis").hide();
            $("#ReceptionArea").hide();
            $("#ConferenceRoom").hide();
            $("#Pantry").hide();
            $("#MeetingRooms").hide();
            $("#NoOfCabins").hide();
            $("#MaxNoOfSeats").hide();
            $("#MinNoOfSeats").hide();

            $("#washroom-84").on('click', function() {
                $("#WashRooms").show();
            })
            $("#washroom-85").on('click', function() {
                $("#WashRooms").hide();
            })

            $("#TypeOfOffice").on("change", function() {
                if ($("#TypeOfOffice").val() == "82") {
                    console.log($("#TypeOfOffice").val());

                    $("#Facilitis").hide();
                    $("#ReceptionArea").hide();
                    $("#ConferenceRoom").hide();
                    $("#Pantry").hide();
                    $("#MeetingRooms").hide();
                    $("#NoOfCabins").hide();
                    $("#MaxNoOfSeats").hide();
                    $("#MinNoOfSeats").hide();

                } else {
                    $("#Facilitis").show();
                    $("#ReceptionArea").show();
                    $("#ConferenceRoom").show();
                    $("#Pantry").show();
                    $("#MeetingRooms").show();
                    $("#NoOfCabins").show();
                    $("#MaxNoOfSeats").show();
                    $("#MinNoOfSeats").show();
                }

            })

            $("#ForSale").on('click', function() {
                $('#OwnnershipClone').show();
                $('#PriceDetailsClone').show();
                $('#AdditionalPrcingDetailsClone').show();
                $("#RemarksOnPropertyClone").show();

                $("#RentDetailsClone").hide();
                $("#AdditionalrentDetailClone").hide();
                $("#SecurityDepositClone").hide();
                $("#AggrementDurationClone").hide();
                $("#NoticeMonthClone").hide();
                $("#AgreementTypeClone").hide();

            });

            $("#ForRent").on('click', function() {
                $('#OwnnershipClone').hide();
                $('#PriceDetailsClone').hide();
                $('#AdditionalPrcingDetailsClone').hide();
                $("#RemarksOnPropertyClone").hide();

                $("#AgreementTypeClone").show();
                $("#RentDetailsClone").show();
                $("#AdditionalrentDetailClone").show();
                $("#SecurityDepositClone").show();
                $("#AggrementDurationClone").show();
                $("#NoticeMonthClone").show();
            });

            $("#ShowBuiltUp").on('click', function() {
                $('#BuiltUp').show();
                $('#ShowBuiltUp').hide();
            });

            $("#ShowSuperBuiltUp").on('click', function() {
                $("#SuperBuiltUp").show();
                $("#ShowSuperBuiltUp").hide();
            })

            $("#AddStaircase").on('click', function() {
                $("#ExtraStaircase").show();
                $("#ShowStaircaseDone").show();
            })

            $("#ShowStaircaseDone").on('click', function() {
                const extra_staicase_value = $("#ExtraStaircase").val();
                var html = `<input type="radio" id="radio-${extra_staicase_value}" name="no_of_bathrooms" value="${extra_staicase_value}" checked>
                        <label for="radio-${extra_staicase_value}" class="width50">${extra_staicase_value}</label>`;
                $("#AppendStaricase").append(html);
                $("#ExtraStaircase").hide();
                $("#ShowStaircaseDone").hide();

                // console.log($('form[id=SubmitPropertyDetails] input[name=staircase][4]').length)
                const staircaseInputs = document.querySelectorAll('input[name="no_of_bathrooms"]');
                if (document.getElementsByName('no_of_bathrooms').length >= 6) {
                    const fifthStaircaseInput = staircaseInputs[4];
                    if (fifthStaircaseInput && fifthStaircaseInput.parentNode) {
                        fifthStaircaseInput.parentNode.removeChild(fifthStaircaseInput);
                        const labelElement = document.querySelector(`label[for=${fifthStaircaseInput.id}]`);
                        labelElement.style.display = "none";
                    }

                }

            })

            $("#avlbl_sts-23").on('click', function() {
                $("#AgeOfProperty").show();
                $("#PossesionBy").hide();
            })
            $("#avlbl_sts-24").on('click', function() {
                $("#AgeOfProperty").hide();
                $("#PossesionBy").show();
            })

            // $(document).ready(function() {
            const $screens = $(".screen");
            let currentScreen = 0;
            const $screens1 = $(".progress-bar");
            let progressbar = 0;

            function showScreen(screenIndex) {
                $screens.removeClass("visible highlight");
                $screens.eq(screenIndex).addClass("visible");

                if (screenIndex > 0) {
                    $screens.eq(screenIndex - 1).addClass("highlight");
                }
            }

            function showAtive(screenIndex) {

                $screens1.removeClass("active");
                $screens1.eq(screenIndex).addClass("active");

                if (screenIndex > 0) {
                    $screens1.eq(screenIndex - 1).addClass("active");

                }
                if (screenIndex === 2)
                    $screens1.eq(screenIndex).addClass("active");
            }

            // Initially show the first screen
            showScreen(currentScreen);
            // Next button click event handler
            $(".nextBtn").on("click", function() {
                if (currentScreen < $screens.length - 1) {
                    currentScreen++;
                    showScreen(currentScreen);
                    progressbar++;
                    showAtive(progressbar);
                }
            });

            // Previous button click event handler
            $(".prevBtn").on("click", function() {
                if (currentScreen > 0) {
                    currentScreen--;
                    showScreen(currentScreen);
                    progressbar--;
                    showAtive(progressbar);
                }
            });


            //First Tab Submission
            $('form[id=SubmitPropertyDetails]').submit(function(e) {
                toggleLoadingAnimation();
                $('.progress-bar').removeClass('active');

                // $(".nextBtn").on("click", function() {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.storage.store_property_details') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // Handle success response
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                if (key != 'property_facing' && key != 'parking_type' && key !=
                                    'washrooms' &&
                                    key != 'availability_status' && key != 'property_age' &&
                                    key != 'no_of_bathrooms' && key != 'carpet_area') {
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .addClass(
                                            'is-invalid');
                                    $('form[id=SubmitPropertyDetails] input[name=' + key + ']')
                                        .after(
                                            '<span class="text-danger input-error" role="alert">' +
                                            value +
                                            '</span>');
                                }
                                $('form[id=SubmitPropertyDetails] textarea[name=' + key + ']')
                                    .addClass('is-invalid');
                                $('form[id=SubmitPropertyDetails] textarea[name=' + key + ']')
                                    .after(
                                        '<span class="text-danger input-error" role="alert">' +
                                        value + '</span>');

                                $('#err' + key).after(
                                    '<span class="input-error" style="color:red">' + value +
                                    '</span>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    },

                });
            })

            //Second Tab Submission

            $('form[id=PricingDetailsForm]').submit(function(e) {
                toggleLoadingAnimation();
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.storage.store_pricing_details') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // Handle success response
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                    },
                    error: function(jqXHR, status, error) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                if (key != 'pricing_details_for' && key != 'ownership') {
                                    $('form[id=PricingDetailsForm] input[name=' + key + ']')
                                        .addClass(
                                            'is-invalid');
                                    $('form[id=PricingDetailsForm] input[name=' + key + ']')
                                        .after(
                                            '<span class="text-danger input-error" role="alert">' +
                                            value +
                                            '</span>');
                                }
                                $('form[id=PricingDetailsForm] textarea[name=' + key + ']')
                                    .addClass('is-invalid');
                                $('form[id=PricingDetailsForm] textarea[name=' + key + ']')
                                    .after(
                                        '<span class="text-danger input-error" role="alert">' +
                                        value + '</span>');

                                $('#err' + key).after(
                                    '<span class="input-error" style="color:red">' + value +
                                    '</span>');
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    }
                });
            })

            //Third Tab Submission
            $('form[id=AddImage]').submit(function(e) {
                toggleLoadingAnimation();
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.storage.store_images') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        // Handle success response
                        console.log(response);
                        if (currentScreen < $screens.length - 1) {
                            currentScreen++;
                            showScreen(currentScreen);
                            progressbar++;
                            showAtive(progressbar);
                        }
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        $('.btn-primary').addClass('nextBtn');
                    },
                    error: function(jqXHR, status, error) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                if (key.startsWith('gallery_images')) {
                                    $("#GalleryImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }

                                if (key.startsWith('amenities_images')) {
                                    $("#AmenityImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                                if (key.startsWith('interior_images')) {
                                    $("#InteriorImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                                if (key.startsWith('floor_plan_images')) {
                                    $("#FloorPlanImages").append(
                                        '<span class="input-error" style="color:red">' +
                                        value + '</span>');
                                }
                            }
                            $('.btn-primary').removeClass('nextBtn');

                        } else {
                            // alert('something went wrong! please try again..');
                        }
                    }
                });
            })

            //Fourth Tab Submission
            $('form[name=AmenitiesForm]').submit(function(e) {
                e.preventDefault();
                toggleLoadingAnimation();
                var formData = new FormData($(this)[0]);
                // console.log(formData, "formData")
                $.ajax({
                    url: "{{ route('surveyor.property.unit_details.commercial.storage.store_amenities') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toggleLoadingAnimation();

                        console.log(response.data)
                        toastr.success('Record Added Successfully');
                        var unit_id = response.data;
                        var url = "{{ route('surveyor.property.unit_details', [':id']) }}";
                        url = url.replace(':id', unit_id);
                        window.location.href = url;

                    },
                    error: function(jqXHR, status, error) {
                        toggleLoadingAnimation();
                        $('.input-error').remove();
                        $('input').removeClass('is-invalid');
                        if (jqXHR.status == 422) {
                            for (const [key, value] of Object.entries(jqXHR.responseJSON
                                    .errors)) {
                                toastr.error(value[0]);
                            }
                        }
                    }

                });
            })


        });
    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    $("#files-preview").html('');
                    var files = e.target.files,
                        filesLength = files.length;
                    console.log(filesLength, "files");
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("#files-preview").append("<span class=\"image-area rounded\">" +
                                "<img class=\"imageThumb\" width='130' src=\"" + e.target
                                .result +
                                "\" title=\"" + file.name + "\"/>" +
                                "" +
                                "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                                "</span>");
                            $(".remove").click(function() {
                                var imageArea = $(this).parent(".image-area");
                                var imageIndex = imageArea.index();
                                // alert(imageIndex);
                                imageArea.remove();
                                files = Array.from(files).filter((_, i) => i !==
                                    imageIndex);
                                // console.log(files)
                                var dataTransfer = new DataTransfer();
                                for (var i = 0; i < files.length; i++) {
                                    if (i !== imageIndex) {
                                        dataTransfer.items.add(files[i]);
                                    }
                                }
                                $('#files')[0].files = dataTransfer.files;
                            });
                            // $("#files-preview").css('visibility', 'visible');
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
            if (window.File && window.FileList && window.FileReader) {
                $("#AmenityFiles").on("change", function(e) {
                    $("#amenity-files-preview").html('');
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("#amenity-files-preview").append(
                                "<span class=\"image-area rounded\">" +
                                "<img class=\"imageThumb\" width='130' src=\"" + e.target
                                .result +
                                "\" title=\"" + file.name + "\"/>" +
                                "" +
                                "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                                "</span>");
                            $(".remove").click(function() {
                                var imageArea = $(this).parent(".image-area");
                                var imageIndex = imageArea.index();
                                // alert(imageIndex);
                                imageArea.remove();
                                files = Array.from(files).filter((_, i) => i !==
                                    imageIndex);
                                // console.log(files)
                                var dataTransfer = new DataTransfer();
                                for (var i = 0; i < files.length; i++) {
                                    if (i !== imageIndex) {
                                        dataTransfer.items.add(files[i]);
                                    }
                                }
                                $('#AmenityFiles')[0].files = dataTransfer.files;
                            });
                            // $("#files-preview").css('visibility', 'visible');
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
            if (window.File && window.FileList && window.FileReader) {
                $("#InteriorFiles").on("change", function(e) {
                    $("#interior-files-preview").html('');
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("#interior-files-preview").append(
                                "<span class=\"image-area rounded\">" +
                                "<img class=\"imageThumb\" width='130' src=\"" + e.target
                                .result +
                                "\" title=\"" + file.name + "\"/>" +
                                "" +
                                "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                                "</span>");
                            $(".remove").click(function() {
                                var imageArea = $(this).parent(".image-area");
                                var imageIndex = imageArea.index();
                                // alert(imageIndex);
                                imageArea.remove();
                                files = Array.from(files).filter((_, i) => i !==
                                    imageIndex);
                                // console.log(files)
                                var dataTransfer = new DataTransfer();
                                for (var i = 0; i < files.length; i++) {
                                    if (i !== imageIndex) {
                                        dataTransfer.items.add(files[i]);
                                    }
                                }
                                $('#InteriorFiles')[0].files = dataTransfer.files;
                            });
                            // $("#files-preview").css('visibility', 'visible');
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
            if (window.File && window.FileList && window.FileReader) {
                $("#FloorPlanFiles").on("change", function(e) {
                    $("#floor-plan-files-preview").html('');
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("#floor-plan-files-preview").append(
                                "<span class=\"image-area rounded\">" +
                                "<img class=\"imageThumb\" width='130' src=\"" + e.target
                                .result +
                                "\" title=\"" + file.name + "\"/>" +
                                "" +
                                "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                                "</span>");
                            $(".remove").click(function() {
                                var imageArea = $(this).parent(".image-area");
                                var imageIndex = imageArea.index();
                                // alert(imageIndex);
                                imageArea.remove();
                                files = Array.from(files).filter((_, i) => i !==
                                    imageIndex);
                                // console.log(files)
                                var dataTransfer = new DataTransfer();
                                for (var i = 0; i < files.length; i++) {
                                    if (i !== imageIndex) {
                                        dataTransfer.items.add(files[i]);
                                    }
                                }
                                $('#FloorPlanFiles')[0].files = dataTransfer.files;
                            });
                            // $("#files-preview").css('visibility', 'visible');
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>
@endpush
