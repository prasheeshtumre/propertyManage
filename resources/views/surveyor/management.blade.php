@extends('admin.layouts.main')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">User Management</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('admin.surveyor.management') }}" method="post" id="searchform"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="text-end mb-3">
                            <a href="{{ route('admin.surveyor.create') }}"> <button class="btn btn-success " type="button">
                                    <i class="fa-solid fa-plus fa-beat me-1"></i> Create User </button> </a>
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="row">


                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <label for="" class="form-label"> Select Role </label>
                                        <select class="form-select" name="role" id="role">
                                            <option value="">-Select role-</option>
                                            @forelse($roles as $role)
                                                <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                            @empty
                                                <option value="">Not Found</option>
                                            @endforelse

                                        </select>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Name </label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                placeholder="Enter Valid Mobile Number">
                                        </div>
                                    </div>



                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Email ID </label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Enter Valid Mail Id">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Username </label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder=" ">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3">
                                        <div>
                                            <label for="" class="form-label">Status </label>
                                            <select class="form-select" name="status">
                                                <option value="">-Select-</option>
                                                <option value="1"> Active</option>
                                                <option value="0"> Deactive </option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-xxl-3 col-md-3  mt-3 ">
                                        <div>
                                            <label for="" class="form-label">Last Activity From Date</label>
                                            <input type="date" class="form-control" placeholder=" " name="start_date"
                                                id="startDate">
                                        </div>
                                    </div>

                                    <div class="col-xxl-3 col-md-3  mt-3 ">
                                        <div>
                                            <label for="" class="form-label">Last Activity To Date</label>
                                            <input type="date" class="form-control" placeholder=" " id="endDate"
                                                name="end_date">
                                        </div>
                                    </div>

                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-primary  waves-light w_100" id="filter"><i
                                            class="fa fa-search"></i> Search</button>
                                </div>

                            </div>


                        </div>

                    </div>

                </div>
            </form>
            <div class="row">
                <div class="col-xl-12 col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-center mb-1 ">
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
                            <div class="table-responsive " id="pagination_data">

                                @include('surveyor.ajax_paginate', ['surveyors' => $surveyors])
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
    <script type="text/javascript">
        $(function() {
            $('#pagination_data').removeClass('d-none');
            $('.loader-container').addClass('d-none');

            var table = $('.data-table').DataTable({
                dom: 'Brt'
            });
            $('.dt-button').addClass('d-none');
        });

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
            var url = "{{ route('admin.surveyor.management') }}";
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
