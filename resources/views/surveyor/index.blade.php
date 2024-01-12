@extends('admin.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Basic Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('admin.surveyor.userview') }}" method="post" id="searchform" name="searchform"
                enctype="multipart/form-data">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">From Date</label>
                                            <input type="date" name="start_date" class="form-control" id="startDate"
                                                placeholder="From date">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">To Date</label>
                                            <input type="date" name="end_date" class="form-control" id="endDate"
                                                placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Mobile Number</label>
                                            <input type="text" name="mobile_no" class="form-control" id=""
                                                placeholder="Mobile Number" onkeypress="return isNumber(event)">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" id=""
                                                placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-md-12 mt-3 text-end">
                                        <div class="">
                                            <button type="button" id="filter"
                                                class="btn btn-primary waves-light w_100"><i class="fa fa-search"></i>
                                                Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </form>
            <!--end row-->
            <div class="row">
                <div class="col-xl-12 col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-left mb-1">
                                <!--<h5>Department Wise </h5>-->
                                <div>
                                    <button class="btn btn-warning btn-sm ms-1"><i class="fa-regular fa-file-word me-1"></i>
                                        DOC</button>
                                    <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i
                                            class="fa-solid fa-file-excel me-1"></i> Excel</button>
                                    <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i
                                            class="fa-regular fa-file-pdf me-1"></i>
                                        PDF</button>
                                    <button class="btn btn-info btn-sm ms-1" id="buttons-csv"><i
                                            class="fa-solid fa-file-csv me-1"></i>
                                        CSV</button>
                                </div>
                                <div class="d-none">
                                    <div class="form-group search-icon-main">
                                        <input type="search" placeholder="Search... " class="form-control">
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass fa-beat"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="table-responsive d-none" id="pagination_data">
                                @include('surveyor.reports', ['surveyors' => $surveyors])
                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->
    </div>

    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
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

    <script>
        $(function() {
            $('#pagination_data').removeClass('d-none');
            $('.loader-container').addClass('d-none');

            var table = $('.data-table').DataTable({
                dom: 'Brt'
            });
            $('.dt-button').addClass('d-none');
        })

        $('#buttons-excel').on('click', function() {
            $('.buttons-excel').trigger('click');
        });
        $('#buttons-pdf').on('click', function() {
            $('.buttons-pdf').trigger('click');
        });
        $('#buttons-csv').on('click', function() {
            $('.buttons-csv').trigger('click');
        });

        $(document).on('change', "#startDate", function() {
            let startDate = $('#startDate').val();
            $('#endDate').attr('min', startDate);
        })

        $(document).on("click", ".pagination a,#search_btn", function(e) {
            e.preventDefault();

            //get url and make final url for ajax 
            let url = $(this).attr("href");
            let append = url.indexOf("?") == -1 ? "?" : "&";
            let finalURL = url + append + $("#searchform").serialize();
            $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    $("#pagination_data").html(response);
                    $('.data-table').DataTable({
                        dom: 'Brt'
                    });
                    $('.dt-button').addClass('d-none');
                }
            });
            return false;
        });

        $(document).on('click', '#filter', function() {
            var url = "{{ route('admin.surveyor.userview') }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#searchform").serialize();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt'
                });
                $('.dt-button').addClass('d-none');
            });
            return false;
        });
    </script>
@endpush
