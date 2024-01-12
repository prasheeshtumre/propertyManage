<div class="loader-container">
            <div class="loader-circle-2"></div>
        </div>
@extends('admin.layouts.main')
@section('content')
 <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"-->
    <!--    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="-->
    <!--    crossorigin="anonymous" referrerpolicy="no-referrer" />-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" /> 
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <style>
        .dt-buttons {
            display: none;
        }
        #DataTables_Table_0_wrapper table th {
             font-size: 13px;
        }
        .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 4px;
    height: 37px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 5px!important;
    right: 1px;
    width: 20px;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 5px 15px;
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
        .loader-container{
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
        	animation: loader-circle-2-animation 0.85s linear  infinite;
        }
         @keyframes loader-circle-2-animation {
        	0% {
        		transform: rotate(0deg);
        	}
        	100% {
        		transform: rotate(-360deg);
        	}
        }
        @keyframes loader-circle-2-animation-2 {
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

        @media screen and ( max-width: 640px ){

            li.page-item {
        
                display: none;
            }
        
            .page-item:first-child,
            .page-item:nth-child( 2 ),
            .page-item:nth-child( 3 ),
            .page-item:nth-last-child( 2 ),
            .page-item:nth-last-child( 3 ),
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
        
        <div class="container-fluid ">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Report Details </h4>
                    </div>
                </div>
            </div>
           
            <!-- end page title -->
            <form id="searchform" name="searchform">
                <div class="row ">
                    <div class="col-xl-12 col-md-12">

                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-xxl-3 col-md-2 mt-3">
                                        <div>
                                            <label for="" class="form-label">From Date</label>
                                            <input type="date" class="form-control filter_input" id="start_date"
                                                name="start_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-2 mt-3">
                                        <div>
                                            <label for="" class="form-label">To From</label>
                                            <input type="date" class="form-control filter_input" id="end_date"
                                                name="end_date" placeholder="From date">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">GIS ID </label>
                                            <input type="text" class="form-control filter_input" id="fltr_gis_id"
                                                name="gis_id">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Category of the Property </label>
                                            <select class="form-select filter_dropdown" id="category" name="category">
                                                <option value="">-Select Category of the property-</option>
                                                @forelse($categories as $key=>$category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">House No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_house_no"
                                                name="house_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Plot No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_plot_no"
                                                name="plot_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Street Name/No/Road No </label>
                                            <input type="text" class="form-control filter_input" id="fltr_street_name"
                                                name="street_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-4 mt-3">
                                        <div>
                                            <label for="" class="form-label">Colony/Locality Name </label>
                                            <input type="text" class="form-control filter_input" id="fltr_locality_name"
                                                name="locality_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Owner</label>
                                            <input type="text" class="form-control filter_input" id="fltr_owner_name"
                                                name="owner_name">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Builder Full Name</label>
                                             <select class="form-select filter_dropdown select2-dd" id="fltr_builder_name" name="builder_name">
                                                <option value="">-Select Builder-</option>
                                                @forelse($builders as $key=>$builder)
                                                    <option value="{{ $builder->id }}">{{ $builder->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">Contact No</label>
                                            <input type="text" class="form-control filter_input" id="fltr_contact_no"
                                                name="contact_no">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">No of Floors</label>
                                            <input type="text" name="no_of_floors" class="form-control filter_input" id="fltr_no_of_floors">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label">No of Units</label>
                                            <input type="text" class="form-control filter_input" name="no_of_units" id="fltr_no_of_units">
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Category</label>
                                            <select class="form-select filter_dropdown select2-dd" id="fltr_brand_category" name="brand_category">
                                                <option value="">-Select Brand Category-</option>
                                                @forelse($brand_parent_categories as $key=>$brand_parent_category)
                                                    <option value="{{ $brand_parent_category->id }}">{{ $brand_parent_category->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Sub-category</label>
                                            <select class="form-select filter_dropdown select2-dd" id="fltr_brand_sub_category" name="brand_sub_category">
                                                <option value="">-Select sub category-</option>
                                                @forelse($brand_sub_categories as $key=>$brand_sub_category)
                                                    <option value="{{ $brand_sub_category->id }}">{{ $brand_sub_category->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Brand</label>
                                            <select class="form-select filter_dropdown select2-dd" id="fltr_brand_id" name="brand_id">
                                                <option value="">-Select Brand-</option>
                                                @forelse($brands as $key=>$brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Residential Types</label>
                                            <select class="form-select filter_dropdown" id="fltr_residential_category" name="residential_category">
                                                <option value="">-Select Residential Type-</option>
                                                @forelse($residential as $key=>$category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3 mt-3">
                                        <div>
                                            <label for="" class="form-label ">Residential Sub Types</label>
                                            <select class="form-select filter_dropdown" id="fltr_residential_sub_category" name="residential_sub_category">
                                                <option value="">-Select Residential Sub Type-</option>
                                                @forelse($residential as $category)
                                                    @forelse($category->children as $children){
                                                    <option value="{{ $children->id }}">{{$category->cat_name}} | {{ $children->cat_name }}</option>
                                                       
                                                    @empty
                                                    
                                                    @endforelse
                                                @empty
                                                    {{-- <option>-no options are available-</option> --}}
                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-xxl-3 col-md-3 mt-3">-->
                                    <!--    <div>-->
                                    <!--        <label for="" class="form-label">Community Name</label>-->
                                    <!--        <input type="text" class="form-control filter_input" id="fltr_community" name="community">-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                                <div class="text-end mt-3">
                                    <button type="button" class="btn btn-primary " id="filter-reset">Reset</button>
                                    <button type="button" class="btn btn-primary" id="filter">Search</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </form>
        
            <div class="row ">

                <div class="col-xl-12 col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-1 row d-none">
                                <!--<h5>Department Wise </h5>-->

                                <div class="col-md-12 col-lg-8">
                                    <a class="btn btn-warning btn-sm ms-1 "><i class="fa-solid fa-print"></i>
                                        Print</a>
                                    <a class="btn btn-secondary btn-sm ms-1 "
                                        href="{{ url('surveyor/property/excel/export') }}"><i
                                            class="fa-solid fa-file-excel me-1"></i>
                                        Excel</a>
                                    <a class="btn btn-primary btn-sm ms-1 cmd"> <i class="fa-regular fa-file-pdf me-1"></i> PDF</a>
                                    <a class="btn btn-info btn-sm ms-1 " href="{{ url('surveyor/property/csv/export') }}"><i
                                            class="fa-solid fa-file-csv me-1"></i>
                                        CSV</a>
                                </div>
                                <div class="col-md-12 col-lg-4 mt-2">
                                    <div class="form-group search-icon-main">
                                        <input type="search" placeholder="Search... " class="form-control"
                                            id="fltr_search">
                                        <div class="search-icon">
                                            <i class="fa-solid fa-magnifying-glass fa-beat"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="table-responsive d-none" id="pagination_data">
                                @include('surveyor.property_pagination', [
                                    'properties' => $properties,
                                ])
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!--end row-->

        </div> <!-- container-fluid -->
    </div><!-- End Page-content -->

           




    @if (request()->get('type'))
        <input type="hidden" value="{{ request()->get('type') }}" id="type">
    @endif
    @endsection
    
    @push('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
            $('.select2-dd').select2();
    });
    
    $(function(){
        $('#pagination_data').removeClass('d-none');
        $('.loader-container').addClass('d-none');
    })
        // $(document).on('change', '#category', function(e) {
        //     let c_id = $(this).val();
        //     $.ajax({
        //         type: "GET",
        //         data: {
        //             c_id: c_id
        //         },
        //         url: "{{ url('surveyor/ajax/sub_categories') }}",
        //         success: function(response) {
        //             $('#sub_category').empty();
        //             $("#sub_category").append(
        //                 '<option selected disabled>--Select Type of Property--</option>');
        //             if (response) {
        //                 $.each(response, function(key, value) {
        //                     $('#sub_category').append($("<option/>", {
        //                         value: value.id,
        //                         text: value.title
        //                     }));
        //                 });
        //             }
        //         }
        //     });
        // });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".pagination a,#search_btn", function(e) {
                e.preventDefault();
                
                //get url and make final url for ajax 
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                // console.log(url);
                let finalURL = url + append + $("#searchform").serialize();
                //set to current url
                // alert(finalURL);
                // console.log(finalURL);
                // window.history.pushState({}, null, finalURL);
                 $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    $("#pagination_data").html(response);
                    $('.data-table').DataTable({
                        dom: 'Brt'
                    })
                }
            });
                // $.get(finalURL, function(data) {
                //     $("#pagination_data").html(data);
                //     // $('.data-table').DataTable().clear();
                //     // $('.data-table').DataTable().destroy();
                //     $('.data-table').DataTable({
                //         dom: 'Brt'
                //     })
                // });
                return false;
            });

            var table = $('.data-table').DataTable({
                dom: 'Brt'
            });
        });

        $(document).on('click', '#filter-reset', function() {
            var url = "{{ route('admin.surveyor.filter-data',$survey_id) }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append;

            $('.filter_input').each(function() {
                $(this).val('');
            });
            $('.filter_dropdown').val("").trigger("change")
            $('.filter_dropdown option:first').prop('selected', true).trigger("change");

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt'
                })
            });
             return false;
        });

        $(document).on('click', '#filter', function() {

            var url = "{{ route('admin.surveyor.filter-data',$survey_id) }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#searchform").serialize();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt'
                })
            });
             return false;
        });
         $('#fltr_search').keyup(function() {
            var url = "{{ url('surveyor/property/reports') }}";
            var append = url.indexOf("?") == -1 ? "?" : "&";
            var finalURL = url + append + $("#searchform").serialize() + "&search=" + $('#fltr_search').val();

            $.get(finalURL, function(data) {
                $("#pagination_data").html(data);
                $('.data-table').DataTable({
                    dom: 'Brt'
                })
            });
        });

        $(document).on('click', '.export-btn', function() {
            $('.' + $(this).data('export')).trigger('click');
        })

        $(document).on("change", "#start_date", function() {
            // debugger
            var date = $(this).val();
            $('#end_date').attr('min', date);
        });
        function generate() {
          var doc = new pdfjsLib.getDocument();
          doc.fromHTML(document.querySelector('#output'), 15, 15, {
            'width': 170,
            'elementHandlers': function() {
              return true;
            }
          });
          doc.save('test.pdf');
        }
        
    </script>
    <script type="text/javascript">
        $(function () {
            $(document).on('click','.cmd',function () {
                $.ajax({
                    type: "GET",
                    url: "{{ url('surveyor/property/pdf/export') }}",
                    success: function(response) {
                       var doc = new jsPDF();
                        var specialElementHandlers = {
                            '#editor': function (element, renderer) {
                                return true;
                            }
                        };
                        
                   
                            doc.fromHTML(response, 15, 15, {
                                'width': 700,
                                'elementHandlers': specialElementHandlers
                            });
                            doc.save('sample_file.pdf');
                    
                    }
                });
                
            });
        });
    <!--</script>-->
    <script>
            $(document).ready(function() {
              $('#generate-pdf-btn').click(function() {
                // generatePDF();
              });
            });
    </script>

@endpush
