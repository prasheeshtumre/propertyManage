@extends('admin.layouts.main')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <style>
        .dt-buttons {
            display: none;
        }

        .dataTables_filter {
            display: none;
        }

        .search-icon {
            top: 7px !important;
        }

        .loader-circle-2 {
            position: absolute;
            width: 70px;
            height: 70px;
            top: 45%;
            left: 50%;
            display: inline-block;
        }

        .loader-circle-2:before,
        .loader-circle-2:after {
            content: "";
            display: block;
            position: absolute;
            border-width: 5px;
            border-style: solid;
            border-radius: 50%;
        }

        .loader-circle-2:before {
            width: 70px;
            height: 70px;
            border-bottom-color: #fbfbfb;
            border-right-color: #fbfbfb;
            border-top-color: transparent;
            border-left-color: transparent;
            animation: loader-circle-2-animation-2 1s linear infinite;
        }

        .loader-container {
            width: 100%;
            background-color: rgb(0 0 0 / 30%);
            height: 100%;
            position: absolute;
            z-index: 1;
        }

        .loader-circle-2:after {
            width: 40px;
            height: 40px;
            border-bottom-color: #fbfbfb;
            border-right-color: #fbfbfb;
            border-top-color: transparent;
            border-left-color: transparent;
            top: 22%;
            left: 22%;
            animation: loader-circle-2-animation 0.85s linear infinite;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
            display: none;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child {
            display: block;
        }

        span.select2-selection__choice__remove {
            display: none;
        }

        @keyframes  loader-circle-2-animation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(-360deg);
            }
        }

        @keyframes  loader-circle-2-animation-2 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        ul.pagination {
            display: flex;
            justify-content: center !important;
            ;
        }

        @media  screen and (max-width: 640px) {

            li.page-item {

                display: none;
            }

            .page-item:first-child,
            .page-item:nth-child(2),
            .page-item:nth-child(3),
            .page-item:nth-last-child(2),
            .page-item:nth-last-child(3),
            .page-item:last-child,
            .page-item.active,
            .page-item.disabled {

                display: block;
            }

            .loader-circle-2 {
                left: 42% !important;
            }
        }

        .img-max {
            max-width: 210px
        }
    </style>
    


    <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->

            <div class="row" style="">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                    </div>
                </div>
            </div>




            <div class="text-end mb-3">

                <a href="{{url('admin/builder/create')}}" type="button"
                    class="btn btn-secondary custom-toggle ">
                    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Create Builder Group</span>
                </a>

            </div>



            <!-- end page title -->





            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row   mb-3">

                                <div class="mb-3">
                                    <button class="btn btn-warning btn-sm ms-1" fdprocessedid="iaib2"><i
                                            class="fa-regular fa-file-word me-1"></i>
                                        DOC</button>
                                    <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"
                                        fdprocessedid="23q13e"><i class="fa-solid fa-file-excel me-1"></i> Excel</button>
                                    <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf" fdprocessedid="fix3hu"> <i
                                            class="fa-regular fa-file-pdf me-1"></i>
                                        PDF</button>
                                    <button class="btn btn-info btn-sm ms-1" id="buttons-csv" fdprocessedid="uo01wm"><i
                                            class="fa-solid fa-file-csv me-1"></i>
                                        CSV</button>
                                </div>
                                <table class="d-none table table-striped dt-responsive table-hover nowrap data-table" style="width:100%">
                                        <thead>
                                            <tr class="table-info">
                                                <th >Sno</th>
                                                <th>Builder Group Name </th>
                                                <th>Builder Group Logo</th>
                                                <th>Builder Group Address</th>
                                                <th>Builder Group Website</th>
                                                <th>Builder Group Contact No </th>
                                                <th>Builder Group Mail ID</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Test</td>
                                                <td align="center">
                                                    <img src="https://manage.proper-t.co/public/assets/images/users/user-dummy-img.jpg"
                                                        style="width: 35px;">

                                                </td>
                                                <td>#125478</td>
                                                <td>Surveryer</td>
                                                <td>Success</td>
                                                <td>30-06-2023</td>

                                                <td style="width:100px;">
                                                    <a href="https://manage.proper-t.co/admin/surveyor/show/eyJpdiI6Ik5ZK1FmN3htaEJwRVYxajNoYnpGOHc9PSIsInZhbHVlIjoiTzZnRzV4MUlmU29uUEozem9jZUNTUT09IiwibWFjIjoiNTRmYjZhODMzM2RlMDYxNjI4YmE5NGU1OTUyNjFjODdjYjQ5OWUxOTk0ZTVhOTIxOWE1YzZmMjNmYTdiNmUzNCIsInRhZyI6IiJ9"
                                                        class="btn btn-success btn-sm"> View More</a>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <div class="table-responsive" id="pagination_data">

                                    
                                    @include('builder.builder_paginate', [
                                            'builders' => $builders, 
                                        ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script >
        // $(document).ready(function() {
        //     var table = $('.data-table').DataTable({
        //         dom: 'Brt',
        //         "pageLength": 50
        //     });
        // });
    </script>
    <script>
        var table;
        $(function() {
            $('#pagination_data').removeClass('d-none');
            $('.loader-container').addClass('d-none');

            table = $('.data-table').DataTable({
                dom: 'Brt',
                "pageLength": 50
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
            toggleLoadingAnimation();
            table.destroy();
            //get url and make final url for ajax 
            let url = $(this).attr("href");
            let append = url.indexOf("?") == -1 ? "?" : "&";
            let finalURL = url + append + $("#searchform").serialize();
            $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    toggleLoadingAnimation();
                    $("#pagination_data").html(response);
                    
                    var table = $('.data-table').DataTable({
                        dom: 'Brt',
                        "pageLength": 50
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
