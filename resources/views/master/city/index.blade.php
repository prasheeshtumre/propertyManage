@extends('admin.layouts.main')
@section('content')
<style>
    #suggestions {
        max-height: 120px;
        overflow-y: auto;
        width: 100%;
        position: absolute;
        z-index: 1;
        background-color: #fff;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    #suggestions .form-check {
        padding: 10px 30px;
        box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
    }

    button#load-more {
        width: 100%;
        background-color: #efebeb;
        border: none;
        color: #74bbbb;
        font-weight: bold;
    }

    #suggestions::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        background-color: #F5F5F5;
    }

    #suggestions::-webkit-scrollbar {
        width: 8px;
        background-color: #F5F5F5;
    }

    #suggestions::-webkit-scrollbar-thumb {
        border-radius: 8px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #aa8585;
    }
</style>
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">cities</h4>
                </div>
            </div>
        </div>
        <div class="create-frm-container">
            <form action="{{ route('admin.city.store') }}" method="post" enctype="multipart/form-data" class="" id="store-frm">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="form-group col-auto">
                                            <label for="" class="">Country <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="country" id="" class="form-select">
                                                    {!! get_country_options('IN') !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="" class="">State <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="state" id="state" class="form-select">
                                                    <option selected disabled>--Choose State--</option>
                                                    {!! get_state_options('IN') !!}
                                                </select>
                                                @error('state')
                                                <span class="input-error text-danger" style="">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-4 ">
                                            <label>Enter City Name <span class="text-danger">*</span></label>
                                            <input type="text" id="city" name="city" class="form-control" placeholder="Enter city Name" maxlength="100" value="{{ old('city') }}">
                                            <div id="suggestions"></div>
                                            @error('city')
                                            <span class="input-error text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-lg-2 my-2">
                                            <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Create</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- end page title -->
        <!-- <div class="row">
                <div class="col-md-4">
                    <input type="text" id="pincode" name="pincode" class="form-control" autocomplete="off">
                    <div id="suggestions"></div>
                </div>
            </div> -->
        <!-- edit form starts-->
        <div class="edit-frm-container"></div>
        <!-- edit form ends-->
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="card">

                    <div class="card-body">
                        <h4 class="mt-0 header-title">Cities</h4>
                        <div class="d-flex justify-content-between align-items-center mb-1 ">

                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end mt-2 mb-2">
                                <input type="text" id="search_key" name="search_key" class="form-control" placeholder="Search...">&nbsp;&nbsp;
                                <!-- <input type="button" id="search_btn" class="btn btn-success" name="Search" value="Search"> -->
                            </div>
                        </div>
                        <div class="table-responsive" id="pagination_data">

                            @include('master.city.city_paginate', [])

                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!--end row-->

    </div> <!-- container-fluid -->
</div>
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        // $('#pagination_data').removeClass('d-none');
        // $('.loader-container').addClass('d-none');

        var table = $('.data-table').DataTable({
            dom: 'Brt',
            paging: false,
            ordering: false
        });
        $('.dt-button').addClass('d-none');

        $(document).on('click', '.delete-city', function() {
            let DestroyUrl = $(this).attr('data-url');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: DestroyUrl,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            table.destroy();

                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        },
                        error: function(jqXHR, status, error) {
                            // toggleLoadingAnimation();
                        }

                    });


                }
            });
        });


    });

    // $('#buttons-excel').on('click', function() {
    $(document).on('click', '#buttons-excel', function() {
        $('.buttons-excel').trigger('click');
    });
    $('#buttons-pdf').on('click', function() {
        $('.buttons-pdf').trigger('click');
    });
    $('#buttons-csv').on('click', function() {
        $('.buttons-csv').trigger('click');
    });

    $(document).ready(function() {
        var suggestionsContainer = $('#suggestions');
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#suggestions').length && !$(e.target).is('#city')) {
                suggestionsContainer.hide();
            }
        });
        $(document).on('input', '#city', function() {
            var input = $(this).val();

            if (input.length >= 2) {
                loadSuggestions(input, 1); // Load suggestions for the first page
            } else {
                $('#suggestions').html('');
            }
        });

        // Handle "Load More" button click
        $(document).on('click', '#load-more', function() {
            var nextPage = $(this).data('next-page');
            console.log(nextPage)
            if (nextPage) {
                loadSuggestions($('#city').val(), nextPage);
            }
        });

        function loadSuggestions(city, page) {
            let stateId = $('#state').val()
            $.ajax({
                url: "{{ route('admin.city.get-city-suggestions') }}",
                method: 'GET',
                data: {
                    page: page,
                    city: city,
                    state: stateId,
                },
                success: function(data) {
                    $('#suggestions').empty();
                    // Append new suggestions
                    $('#suggestions').append(data);

                    // Update "Load More" button with the next page URL
                    var nextPage = $(data).filter('#load-more-container').find('#load-more').data('next-page');
                    $('#load-more').data('next-page', nextPage);

                    // Hide "Load More" button if there are no more pages
                    if (!nextPage) {
                        $('#load-more-container').hide();
                    }

                    suggestionsContainer.show();
                }
            });
        }
    });
</script>
<script>
    $(function() {
        $(document).on("click", ".pagination a", function(e) {
            e.preventDefault();
            //get url and make final url for ajax 
            let url = $(this).attr("href");
            let append = url.indexOf("?") == -1 ? "?" : "&";
            let finalURL = url + append;
            $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    $("#pagination_data").html(response);
                }
            });
            return false;
        });
        $(document).on("keyup", '#search_key', function() {
            var url = "{{ url('admin/city') }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + "&search=" + $('#search_key').val();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
            });
        });

    });
</script>
<script>
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}")
    @endif
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {



    });
</script>

@endpush