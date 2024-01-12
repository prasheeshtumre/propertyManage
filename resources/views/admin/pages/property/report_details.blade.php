@extends('admin.layouts.main')
@section('content')
<style>
    .apart-images img {
        width: 150px !important;
        height: 150px !important;
        padding: 2px !important;
        object-fit: cover !important;
    }

    .image-area {
        position: relative;
        /* width: 50%; */
        margin: 20px;
        background: #333;
        border-radius: 5px;
    }

    .image-area img {   
        max-width: 100%;

        height: auto;
    }

    .remove-image {
        display: none;
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 10em;
        padding: 2px 6px 3px;
        text-decoration: none;
        font: 700 21px/20px sans-serif;
        background: #555;
        border: 3px solid #fff;
        color: #FFF;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(0, 0, 0, 0.3);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        -webkit-transition: background 0.5s;
        transition: background 0.5s;
    }

    .remove-image:hover {
        background: #E54E4E;
        padding: 3px 7px 5px;
        top: -11px;
        right: -11px;
    }

    .remove-image:active {
        background: #E54E4E;
        top: -10px;
        right: -11px;
    }

</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Report Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row border-bottom mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Latitude</label>
                                <p>{{ $property->latitude ?? '-' }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Longitude</label>
                                <p>{{ $property->longitude ?? '-' }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>GIS ID</label>
                                <p>{{ $property->gis_id }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Category of the property</label>
                                <p>{{ $property->category->title }}</p>
                            </div>
                        </div>
                        <div class="row border-bottom mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Type of property</label>
                                <p>{{ $property->sub_category->title }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>House No</label>
                                <p>{{ $property->house_no }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Plot No</label>
                                <p>{{ $property->plot_no }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Street Name/No/Road No</label>
                                <p>{{ $property->street_details }}</p>
                            </div>
                        </div>
                        <div class="row border-bottom mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Colony/Locality Name</label>
                                <p>{{ $property->locality_name }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Owner Full Name</label>
                                <p>{{ $property->owner_name }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Contact No</label>
                                <p>{{ $property->contact_no }}</p>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Remarks</label>
                                <p>{{ $property->remarks }}</p>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label><b>Property Images</b></label>
                            <div class="apart-images">
                                @foreach ($property->images as $image)
                                <img src="{{ asset('uploads/property/images/' . $image->file_url) }}" class="img-fluid">
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Preview the Map
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-1" style="height:500px;">
                                            <div id="map" style="clear:both; height:100%;">
                                                <div id="map"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<button class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>-->
                        </div>
                    </div>
                    <div class="card-footer" style="background-color:#e1e1ef;">
                        <div class="d-flex justify-content-end">
                            {{-- <a href="{{ url('surveyor/property/edit_details') }}/{{ $property->id }}"
                            class="btn btn-warning me-2"><span class="mdi mdi-layers-edit me-2"></span> EDIT </a> --}}
                            <a class="btn btn-warning me-2 edit-modal-btn" href="{{ route('surveyor.property.edit_details', [$property->id]) }}"><span class="mdi mdi-layers-edit me-2 "></span> EDIT </a>
                            {{-- <a class="btn btn-warning me-2 edit-modal-btn" data-bs-toggle="modal"
                                    data-bs-target="#editProperty"><span class="mdi mdi-layers-edit me-2 "></span> EDIT </a> --}}
                            {{-- <a class="btn btn-primary"> <span class="mdi mdi-map me-2"></span> View on Map </a> --}}
                            <a class="btn btn-primary me-2" href="https://maps.google.com/?q={{ $property->latitude ?? '-' }},{{ $property->longitude ?? '-' }}">
                                <span class="mdi mdi-map me-2"></span> View on Google Map </a>
                            <!-- Button trigger modal -->
                            <!--<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"-->
                            <!--    data-bs-target="#exampleModal">-->
                            <!--    Preview the Map-->
                            <!--</button>-->
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
    <div class="modal fade" id="exampleModalLg" tabindex="-1" aria-labelledby="exampleModalLgLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalLgLabel">Large modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <!-- Modal -->
    <div class="modal fade" id="editProperty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> @lang('property.edit_property') </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form data-action="{{ route('surveyor.property.update_details', [$property->id]) }}" id="update_property" method="post" enctype="multipart/form-data">
                    <div class="modal-body">


                        <div class="row">

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">GIS ID</label>
                                    <input type="text" name="gis_id" class="form-control" id=" " placeholder="EX: 7255158845" value="{{ $property->gis_id }}" readonly>
                                    <div><span class="input-error err-gis_id" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3  mt-3">
                                <div>
                                    <label for="" class="form-label">Category of the property</label>
                                    <select class="form-select" name="category" id="category">
                                        <option selected disabled>-Select Category-</option>
                                        @forelse($categories as $key=>$category)
                                        <option {{ $property['cat_id'] == $category['id'] ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                        @empty
                                        {{-- <option>-no options are available-</option> --}}
                                        @endforelse

                                    </select>
                                    <div><span class="input-error err-category" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3  mt-3">
                                <div>
                                    <label for="" class="form-label">Type of property</label>
                                    <select class="form-select" name="sub_category" id="sub_category">
                                        <option selected disabled>-Select Category-</option>
                                        @forelse($sub_categories as $key=>$sub_category)
                                        <option {{ $property['sub_cat_id'] == $sub_category['id'] ? 'selected' : '' }} value="{{ $sub_category->id }}">{{ $sub_category->title }}
                                        </option>
                                        @empty
                                        {{-- <option>-no options are available-</option> --}}
                                        @endforelse

                                    </select>
                                    <div><span class="input-error err-sub_category" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">House No.</label>
                                    <input type="text" name="house_no" class="form-control" placeholder=" " value="{{ $property->house_no }}">
                                    <div><span class="input-error err-house_no" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Plot No.</label>
                                    <input type="text" name="plot_no" class="form-control" placeholder=" " value="{{ $property->plot_no }}">
                                    <div><span class="input-error err-plot_no" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Street Name/No/Road No.</label>
                                    <input type="text" name="street_details" class="form-control" placeholder=" " value="{{ $property->street_details }}">
                                    <div><span class="input-error err-street_details" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Colony/Locality Name</label>
                                    <input type="text" name="locality_name" class="form-control" placeholder=" " value="{{ $property->locality_name }}">
                                    <div><span class="input-error err-locality_name" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Owner Full Name </label>
                                    <input type="text" name="owner_name" class="form-control" placeholder=" " value="{{ $property->owner_name }}">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Contact No </label>
                                    <input type="text" name="contact_no" class="form-control" placeholder=" " value="{{ $property->contact_no }}">
                                    <div><span class="input-error err-contact_no" style="color: red"></span></div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-3 mt-3">
                                <div>
                                    <label for="" class="form-label">Capture Property Images </label>
                                    <div class="d-flex justify-content-center flex-column">
                                        <input type="file" name="files[]" id="files" class="form-control" multiple placeholder=" ">
                                        <div><span class="input-error err-files" style="color: red"></span></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div id="files-preview" class="row"></div>
                            </div>
                            @if (count($property->images) > 0)
                            <div class="col-xxl-12 col-md-12 mt-3">
                                <label><b>Property Images</b></label>
                                <div class="apart-images d-flex justify-content-start">
                                    @foreach ($property->images as $image)
                                    <div class="image-area rouded">
                                        <img src="{{ asset('public/uploads/property/images/' . $image->file_url) }}" alt="Preview">
                                        <span class="remove-image " data-href="{{ route('surveyor.property.image.destroy', [$image->id]) }}" style="display: inline;">&#215;</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif



                            <div class="col-xxl-12 col-md-12 mt-3">
                                <div>
                                    <label for="" class="form-label">Remarks </label>
                                    <textarea name="remarks" class="form-control" rows="3">{{ $property->remarks }}</textarea>
                                </div>
                            </div>

                            <!--<input type="hidden" name="latitude" id="latitude">-->
                            <!--<input type="hidden" name="longitude" id="longitude">-->

                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            @lang('property.close')</button>
                        <button type="submit" class="btn btn-primary"> @lang('property.save_changes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update_success" aria-labelledby="exampleModalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="success alert">
                            <div class="alert-body">
                                <h2>Property Updated Successfully</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="lat" value="{{ $property->latitude }}">
    <input type="hidden" id="long" value="{{ $property->longitude }}">





</div> <!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
@push('scripts')
<script>
    $(document).on('submit', "#update_property", function(e) {
        e.preventDefault();
        let url = $(this).data('action');
        // $('<span class="input-error" style="color: red">dfgs</span>')
        //     .insertAfter("input[name=category]");
        $.ajax({
            type: "POST"
            , data: new FormData($("#update_property")[0])
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: url
            , processData: false
            , contentType: false
            , dataType: 'json'
            , success: function(response) {
                console.log(response.success)
                if (response.success == true) {
                    $('#editProperty').modal('hide');
                    $('#update_success').modal('show');
                    setInterval(() => {
                        location.reload();
                    }, 3000);

                }
            }
            , error: function(data) {
                let errors = data.errors;
                if (data.responseJSON.success == false) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        $('.err-' + key).addClass("is-invalid");
                        $('.err-' + key).html('');
                        $('.err-' + key).append('<span class="text-danger">' +
                            value[0] + '</span>');
                        $(".name-msg").show();
                    });
                }
            }
        });
    });
    $(document).on('change', '#category', function(e) {
        let c_id = $(this).val();
        $.ajax({
            type: "GET"
            , data: {
                c_id: c_id
            }
            , url: "{{ url('surveyor/ajax/sub_categories') }}"
            , success: function(response) {
                $('#sub_category').empty();
                $("#sub_category").append(
                    '<option selected disabled>--Select Type of property--</option>');
                if (response) {
                    $.each(response, function(key, value) {
                        $('#sub_category').append($("<option/>", {
                            value: value.id
                            , text: value.title
                        }));
                    });
                }
            }
        });
    })

    $(document).on('click', ".remove-image", function(e) {
        // let url = $(this).attr('href');
        $.ajax({
            type: "GET"
            , url: $(this).data('href')
            , success: function(response) {
                console.log(response);
            }
        });
    });

</script>
<script>
    @foreach($errors - > all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}")
    @endif

</script>
<script type="text/javascript">
    var map;

    parseInt(string)($('#long').val());
    parseInt(string)($('#lat').val());

    function initMap() {
        var latitude = parseFloat($('#lat').val()); // YOUR LATITUDE VALUE
        var longitude = parseFloat($('#long').val()); // YOUR LONGITUDE VALUE
        // var latitude = 17.4563197; // YOUR LATITUDE VALUE
        // var longitude = 78.3728344; // YOUR LONGITUDE VALUE
        var myLatLng = {
            lat: latitude
            , lng: longitude
        };
        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng
            , zoom: 18
        });
        var marker = new google.maps.Marker({
            position: myLatLng
            , map: map,
            //title: 'Hello World'
            // setting latitude & longitude as title of the marker
            // title is shown when you hover over the marker
            title: latitude + ', ' + longitude
        });
    }
    $('.edit-modal-btn').on('click', function() {
        alert()
        $('#editProperty').modal('show');
    });

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap" async defer></script>
@endpush
