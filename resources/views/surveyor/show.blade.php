<style>
    .label_show {
        font-weight: 600;
        font-size: 14px;
    }

    .show_main {
        background: #FAF3F0;
        /*border: 1px solid #e6e6ff;*/
        margin-bottom: 0px;
    }
    
    .border-top{
        border-top: 1px #efddd5 solid !important;
    }
    
</style>


@extends('admin.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">User Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">

                        <div class="card-body show_main">
                            <div class="row ">
                                <div class="col-xxl-3 col-md-3 mb-3">
                                    <label for="" class="label_show"> Role </label>
                                    <p>  
                                        @forelse($surveyor->roles as $role)
                                            {{$role->name ?? ''}}
                                        @empty
                                        @endforelse
                                    </p>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="label_show">Name</label>
                                    <p>{{ $surveyor->name }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="label_show">Mobile Number</label>
                                    <p>{{ $surveyor->mobile }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="label_show">Email ID</label>
                                    <p>{{ $surveyor->email }}</p>
                                </div>
                               

                            </div>
                            
                            <div class="row pt-3 border-top">
                                
                                 <div class="col-md-3 mb-3 ">
                                    <label class="label_show">Username</label>
                                    <p>{{ $surveyor->username }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="label_show">Status</label>
                                    <p>{{ $surveyor->status == 0 ? 'Deactive' : 'Active' }}</p>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="label_show">Last Activity Date </label>
                                    <p>{{ $surveyor->updated_at->format('d-m-Y H:i:s') }}</p>
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="card-footer">
                            <div class="row ">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.surveyor.edit', encrypt($surveyor->id)) }}">
                                        <button class="btn btn-outline-primary btn-md"><i class="fa fa-edit me-1"></i>
                                            Edit</button>
                                    </a>
                                    <a href="{{ route('admin.surveyor.change-password', encrypt($surveyor->id)) }}">
                                        <button class="btn btn-outline-success ms-2"> <i class="fa-solid fa-key me-1"></i>
                                            Change Password</button>
                                    </a>
                                    {{-- <button class="btn btn-outline-primary btn-md"><i class="fa fa-check"></i> Activate</button>
							        <button class="btn btn-outline-danger btn-md"><i class="fa fa-ban"></i> Deactivate</button> --}}
                                </div>
                                <div>

                                </div>



                            </div>


                        </div>

                    </div>

                </div>

                <!--end row-->
            </div>
            <!--end row-->

        </div> <!-- container-fluid -->
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
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
                    if (response.length == 0) {
                        $("#sub_category").append(
                            '<option selected >--Select Type of property--</option>');
                    }
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
        });

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
                            // $("#files-preview").css('visibility', 'visible');
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });

        function getCordinates() {
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

        if (performance.navigation.type == 2) {
            // location.reload();
        }
        $('#create_success').on('hidden.bs.modal', function() {
            // location.reload();
        });

        $(document).on('submit', '#create_property', function() {

        })
    </script>
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
    </script>
@endpush
