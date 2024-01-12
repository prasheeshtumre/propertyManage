@extends('admin.layouts.main')
@section('content')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Pincode</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{ route('admin.pincode.store') }}" method="post" enctype="multipart/form-data" class=""
                id="store-frm">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 mt-2">
                                            <label>Enter Pincode Name <span class="text-danger">*</span></label>
                                            <input type="text" id="pincode" name="pincode" class="form-control"
                                                placeholder="Enter Pincode Name" onkeypress="return isNumber(event)"
                                                maxlength="6" value="{{ old('pincode') }}">
                                            @error('pincode')
                                                <span class="input-error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 col-lg-2 mt-4 mt-2">
                                            <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i
                                                    class="fa fa-check"></i> <span id="btn-txt">Create</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <form action="" method="post" enctype="multipart/form-data" class="" id="update-frm"
                style="display: none;">
                @csrf
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-12 col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-4 mt-2">
                                            <label>Enter Pincode Name <span class="text-danger">*</span></label>
                                            <input type="text" id="pincode" name="pincode" class="form-control"
                                                placeholder="Enter Pincode Name" onkeypress="return isNumber(event)"
                                                maxlength="6" value="">

                                            <span class="input-error" style="color: red"></span>
                                        </div>
                                        <div class="col-md-2 col-lg-2 mt-4 mt-2">
                                            <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i
                                                    class="fa fa-check"></i> <span id="btn-txt">Update</span> </button>
                                        </div>
                                    </div>
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
                            <h4 class="mt-0 header-title">Pincodes</h4>
                            <div class="d-flex justify-content-between align-items-center mb-1 ">

                            </div>

                            <div class="table-responsive" id="pagination_data">

                                @include('master.pincode.pincode_paginate', [
                                    // 'categories' => $categories,
                                ])

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
    </script>
    <script>
        $(function() {
            $(document).on("click", ".pagination a,#search_btn", function(e) {
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

        });
        $(document).on('click', '.edit-pincode', function() {
            $('#update-frm').show();
            $('#store-frm').hide();
            $('#update-frm').find('input[name="pincode"]').val($(this).data('pincode'));
            var updateUrl = $(this).data('url');
            $("#update-frm").attr('action', updateUrl);
        });
        $(document).on('submit', '#update-frm', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    $('.flash-errors').remove();
                    if (response) {
                        $('#update-frm').hide();
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload(true);
                        }, 1000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $('.flash-errors').remove();
                        var errors = xhr.responseJSON.errors;
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('<span class="input-error flash-errors" style="color: red">' +
                                value[0] + '</span>').insertAfter($('#update-frm').find(
                                'input[name=' + key + ']'));
                        });
                    }
                },
            });
        });
    </script>
    @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}")
        </script>
    @endforeach

    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}")
        </script>
    @endif

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
            $('.delete-pincode').click(function() {
                var deleteUrl = $(this).data('url');
                $('#deleteCategoryLink').attr('href', deleteUrl);

                $('#deleteModal').modal('show');
            });
        });
    </script>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span id="deleteCategoryName"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="#" id="deleteCategoryLink">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endpush
