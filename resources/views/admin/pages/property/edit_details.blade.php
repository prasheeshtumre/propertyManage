@extends('admin.layouts.main')
@section('content')
<style>
     .image-area {
            position: relative;
            /* width: 50%; */
            margin: 20px;
            min-width: 50px;
            background: #333;
            border-radius: 5px;
        }
        .apart-images img {
            padding: 4px !important;
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

        #files-preview {
            border: 2px dashed gray;
            background: lightgray;
            /* visibility: hidden; */

        }
</style>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Edit Basic Details</h4>

                        {{--                         
                            <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                            <li class="breadcrumb-item active">Basic Elements</li>
                            </ol>
                            </div> 
                        --}}


                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('surveyor.property.update_details', [$property->id]) }}"  method="post" enctype="multipart/form-data">
                <!---->
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">

               <!--             <div class="card-body">-->
               <!--                 <div class="row">-->

               <!--                     <div class="col-xxl-4 col-md-6">-->

               <!--                         <div class="">-->
                                            <!--<div class="form-group picking">-->
                                            <!--    <label>City</label>-->
                                            <!--    <input type="text" placeholder="" name="city" id="searchInput"-->
                                            <!--        class="form-control controls" placeholder="Enter a location">-->
                                            <!--    <div  class="picklocation"><span class="mdi mdi-crosshairs-gps"></span> Pick-->
                                            <!--        my location</div>-->
                                            <!--</div>-->
                                            
               <!--                             <div onclick="getCordinates()" class="form-group picking row" >-->
    										 <!--   <label style="cursor:pointer;"> <span class="mdi mdi-crosshairs-gps " ></span> Pick my location </label>-->
    										 <!--   <div class="col-md-4">-->
    										 <!--       <input type="text" placeholder="Latitude" name="latitude" id="latitude" class="form-control controls" value="{{$property->latitude}}">-->
    										 <!--   </div>-->
    										 <!--   <div class="col-md-4">-->
    										 <!--       <input type="text" placeholder="Longitude" name="longitude" id="longitude" class="form-control controls" value="{{$property->longitude}}">-->
    										 <!--   </div>-->
    										    
    										    
    										     
    										 <!--</div>-->
    										 
               <!--                             {{-- <input type="text" name="myAddress" placeholder="Enter your address" --}}-->
               <!--                             {{-- value="333 Alberta Place, Prince Rupert, BC, Canada" id="myAddress" /> --}}-->

                                            <!-- Search input -->


                                            <!-- Google map -->
               <!--                             <div id="map"></div>-->

                                            <!-- Display geolocation data -->
               <!--                             {{-- <ul class="geo-data">-->
               <!--                                 <li>Full Address: <span id="location"></span></li>-->
               <!--                                 <li>Postal Code: <span id="postal_code"></span></li>-->
               <!--                                 <li>Country: <span id="country"></span></li>-->
               <!--                                 <li>Latitude: <span id="lat"></span></li>-->
               <!--                                 <li>Longitude: <span id="lon"></span></li>-->
               <!--                             </ul> --}}-->
               <!--                         </div>-->

               <!--                     </div>-->
               <!--                 </div>-->
               <!--             </div>-->


                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">GIS ID</label>
                                            <input type="text" name="gis_id" class="form-control" id=" "
                                                placeholder="EX: 7255158845" value="{{$property->gis_id}}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4  mt-3">
                                        <div>
                                            <label for="" class="form-label">Category of the property</label>
                                            <select class="form-select" name="category" id="category">
                                                <option selected disabled>-Select Category-</option>
                                                @forelse($categories as $key=>$category)
                                                    <option {{ ($property['cat_id'] == $category['id'] ? "selected":"") }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4  mt-3">
                                        <div>
                                            <label for="" class="form-label">Type of property</label>
                                            <select class="form-select" name="sub_category" id="sub_category">
                                                <option selected disabled>-Select Category-</option>
                                                @forelse($sub_categories as $key=>$sub_category)
                                                    <option {{ ($property['sub_cat_id'] == $sub_category['id'] ? "selected":"") }} value="{{ $sub_category->id }}">{{ $sub_category->title }}
                                                    </option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">House No.</label>
                                            <input type="text" name="house_no" class="form-control" placeholder=" " value="{{$property->house_no}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Plot No.</label>
                                            <input type="text" name="plot_no" class="form-control" placeholder=" " value="{{$property->plot_no}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Street Name/No/Road No.</label>
                                            <input type="text" name="street_details" class="form-control"
                                                placeholder=" " value="{{$property->street_details}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Colony/Locality Name</label>
                                            <input type="text" name="locality_name" class="form-control" placeholder=" " value="{{$property->locality_name}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Owner Full Name </label>
                                            <input type="text" name="owner_name" class="form-control" placeholder=" " value="{{$property->owner_name}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Contact No </label>
                                            <input type="text" name="contact_no" class="form-control" placeholder=" " value="{{$property->contact_no}}">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Capture Property Images </label>
                                            <div class="d-flex justify-content-center flex-column">
                                                <input type="file" name="files[]" id="files" class="form-control"
                                                    multiple placeholder=" ">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div id="files-preview" class="apart-images d-flex justify-content-center flex-wrap"></div>
                                    </div>
                                    @if(count($property->images) >0)
                                     <div class="col-xxl-12 col-md-12 mt-3">
                                        <label><b>Property Images</b></label>
                                        <div class="apart-images d-flex justify-content-center  flex-wrap">
                                            @foreach ($property->images as $image)
                                            <span class="image-area rounded" id="pimg{{$image->id}}">
                                                <img class="imageThumb" width="130" src="{{ asset('uploads/property/images/' . $image->file_url) }}" title="undefined">
                                                <br>
                                                <span class="remove-image btn remove" data-imgid="{{$image->id}}" data-href="{{url('surveyor/property/image/destroy/' .$image->id )}}" style="display: inline;">×</span>
                                            </span>
                                                <!--<img src="{{ asset('public/uploads/property/images/' . $image->file_url) }}"-->
                                                <!--    class="img-fluid">-->
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    
                                    
                                    

                                    <div class="col-xxl-12 col-md-12 mt-3">
                                        <div>
                                            <label for="" class="form-label">Remarks </label>
                                            <textarea name="remarks" class="form-control" rows="3">{{$property->remarks}}</textarea>
                                        </div>
                                    </div>

                                    <!--<input type="hidden" name="latitude" id="latitude">-->
                                    <!--<input type="hidden" name="longitude" id="longitude">-->

                                </div>

                                <div class="text-end mt-4">
                                    <!--<button -->
                                    <!--    class="btn btn-warning waves-effect waves-light w_100">Update</button>-->
                                        <button type="submit" class="btn btn-primary"><span class="mdi mdi-sync me-2"></span> UPDATE</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('change', '#category', function(e) {
            let c_id = $(this).val();
            $.ajax({
                type: "GET",
                data: {
                    c_id: c_id
                },
                url: "{{ url('surveyor/ajax/sub_categories') }}",
                success: function(response) {
                    $('#sub_category').empty();
                    $("#sub_category").append('<option>--Select Nation--</option>');
                    if (response) {
                        $.each(response, function(key, value) {
                            $('#sub_category').append($("<option/>", {
                                value: value.id,
                                text: value.title
                            }));
                        });
                    }
                }
            });
        })
        $(document).on('click', '.picklocation', function(e) {
            $.ajax({
                type: "GET",
                url: "{{ url('user_loc_details') }}",
                success: function(response) {
                    $('#city').val(response.cityName);
                    console.log(response.cityName)
                }
            });
        });
        
        
        $(document).on('click', ".remove-image", function(e) {
            // let url = $(this).attr('href');
            let ele = $(this).data('imgid');
            $.ajax({
                type: "GET",
                url: $(this).data('href'),
                success: function(response) {
                    if(response.success == true){
                       $('#pimg'+ele).remove();
                        toastr.success("Property Image Removed Successfully")
                    }
                }
            });
        }); 

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                             $("#files-preview").append("<span class=\"image-area rounded\">" +
                            "<img class=\"imageThumb\" width='130' src=\"" + e.target
                            .result +
                            "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "<span class='remove-image btn remove'  style = 'display: inline;' >&#215;</span>" +
                            "</span>");
                        $(".remove").click(function() {
                            $(this).parent(".image-area").remove();
                        });
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
        
        function getCordinates(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var lat = position.coords.latitude;
                  var lon = position.coords.longitude;
                  $('#latitude').val(lat);
                  $('#longitude').val(lon);
                  
                });
              } else {
                toastr.error("Geolocation is not supported by this browser.");
              }
        }
    </script>
    <script>
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
            toastr.success("{{ Session::get('message') }}")
        @endif
    </script>
    {{-- <script src="https://maps.google.com/maps/api/js?key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&sensor=false"></script> --}}



    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13
            });

            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['(cities)']
            });

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry.location.lat())
                $('#longitude').val(place.geometry.location.lng())
                // console.log(place.name);
                // console.log(place.geometry.location.lat());
                // console.log(place.geometry.location.lng());
                //alert("This function is working!");
                //alert(place.name);
                // alert(place.address_components[0].long_name);

            });
            //This will get only the address
            // input.value = placeResult.name;
            // cosole.log(autocomplete)

            // autocomplete.bindTo('bounds', map);

            // var infowindow = new google.maps.InfoWindow();
            // var marker = new google.maps.Marker({
            //     map: map,
            //     anchorPoint: new google.maps.Point(0, -29)
            // });

            // autocomplete.addListener('place_changed', function() {
            //     infowindow.close();
            //     marker.setVisible(false);
            //     var place = autocomplete.getPlace();
            //     if (!place.geometry) {
            //         window.alert("Autocomplete's returned place contains no geometry");
            //         return;
            //     }

            //     // If the place has a geometry, then present it on a map.
            //     // if (place.geometry.viewport) {
            //     //     map.fitBounds(place.geometry.viewport);
            //     // } else {
            //     //     map.setCenter(place.geometry.location);
            //     //     map.setZoom(17);
            //     // }
            //     // marker.setIcon(({
            //     //     url: place.icon,
            //     //     size: new google.maps.Size(71, 71),
            //     //     origin: new google.maps.Point(0, 0),
            //     //     anchor: new google.maps.Point(17, 34),
            //     //     scaledSize: new google.maps.Size(35, 35)
            //     // }));
            //     // marker.setPosition(place.geometry.location);
            //     // marker.setVisible(true);

            //     // var address = '';
            //     // if (place.address_components) {
            //     //     address = [
            //     //         (place.address_components[0] && place.address_components[0].short_name || ''),
            //     //         (place.address_components[1] && place.address_components[1].short_name || ''),
            //     //         (place.address_components[2] && place.address_components[2].short_name || '')
            //     //     ].join(' ');
            //     // }

            //     // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            //     // infowindow.open(map, marker);
            //     $('#latitude').val(place.geometry.location.lat())
            //     $('#longitude').val(place.geometry.location.lng())
            //     // Location details
            //     // for (var i = 0; i < place.address_components.length; i++) {
            //     //     if (place.address_components[i].types[0] == 'postal_code') {
            //     //         document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
            //     //     }
            //     //     if (place.address_components[i].types[0] == 'country') {
            //     //         document.getElementById('country').innerHTML = place.address_components[i].long_name;
            //     //     }
            //     // }
            //     // document.getElementById('location').innerHTML = place.formatted_address;
            //     // document.getElementById('lat').innerHTML = place.geometry.location.lat();
            //     // document.getElementById('lon').innerHTML = place.geometry.location.lng();
            // });
        }
        var input1 = document.getElementById('searchInput');
        input1.addEventListener('blur', function() {
            // timeoutfunction allows to force the autocomplete field to only display the street name.


            setTimeout(function() {
                let s = input1.value;
                let cityName = s.split(',')[0];
                input1.value = cityName;
            }, 500);

        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"
        async defer></script>
        <script>
    @if(Session::has('message'))
       var type="{{Session::get('alert-type','info')}}"

        switch(type){
            // case 'info':
            //     toastr.info("{{ Session::get('message') }}");
            //     break;
            // case 'success':
            //     toastr.success("{{ Session::get('message') }}");
            //     break;
            // case 'warning':
            //     toastr.warning("{{ Session::get('message') }}");
            //     break;
            case 'error':
               toastr.error("{{ Session::get('message') }}");
               break;
        }
    @endif
</script>
@endpush
