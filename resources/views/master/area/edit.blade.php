@extends('admin.layouts.main')
@section('content')
<style>
    #suggestions{
        max-height: 120px;
        overflow-y: auto;
        width: 100%;
        position: absolute;
        z-index: 1;
        background-color: #fff;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
    #suggestions .form-check{
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
    
    #suggestions::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 8px;
        background-color: #F5F5F5;
    }

    #suggestions::-webkit-scrollbar
    {
        width: 8px;
        background-color: #F5F5F5;
    }

    #suggestions::-webkit-scrollbar-thumb
    {
        border-radius: 8px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
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
                    <h4 class="mb-sm-0">Area</h4>
                </div>
            </div>
        </div>
        <div class="create-frm-container">
            <form action="{{ route('admin.area.update', $area->id) }}" method="post" enctype="multipart/form-data" class="" id="store-frm">
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
                                                    <option selected disabled >Choose State</option>
                                                    {!! get_edit_state_options('IN', $area->city->state->id) !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-auto">
                                            <label for="" class="">City <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="city" id="cities" class="form-select">
                                                <option selected disabled >Choose City </option>
                                                {!! get_edit_city_options( $area->city->state->id, $area->city->id) !!}
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row mt-1">
                                        <div class="form-group col-auto">
                                            <label for="" class="">Area <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" id="area" class="form-control" value="{{$area->name ?? '' }}" name="area" autocomplete="off">
                                                <div id="suggestions"></div>
                                            </div>
                                        </div>
                                        <div class="">
                                            
                                        </div>
                                       
                                    </div>
                                    <input type="hidden" name="id" value="{{$area->id}}">
                                    <div class="row">
                                        <div class="col-md-2 col-lg-2 my-2">
                                            <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Update</span> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <input type="hidden" id="city" value="{{$area->city->id}}">

            <!-- <input type="text" id="pincodeInput" name="pincode" placeholder="Type a Pincode">
            <div id="suggestions-container">
                <ul id="suggestions"></ul>
            </div> -->

        </div>
        <!-- end page title -->

        <!-- edit form starts-->
        <div class="edit-frm-container"></div>
        <!-- edit form ends-->
      
        <!--end row-->

    </div> <!-- container-fluid -->
</div>
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
     $(document).ready(function () {
        var suggestionsContainer = $('#suggestions');
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#suggestions').length && !$(e.target).is('#area')) {
                suggestionsContainer.hide();
            }
        });

        $(document).on('input', '#area', function () {
            var input = $(this).val();
            $('#suggestions').empty();
            if (input.length >= 3) {
                loadSuggestions(input, 1); // Load suggestions for the first page
            } else {
                $('#suggestions').html('');
            }   
        });

    // Handle "Load More" button click
    $(document).on('click', '#load-more', function () {
        var nextPage = $(this).data('next-page');
        console.log(nextPage)
        if (nextPage) {
            loadSuggestions($('#area').val(), nextPage);
        }
    });

    function loadSuggestions(area, page) {
        let city = $('#cities').val()
        $.ajax({
            url: "{{ route('admin.area.get-area-suggestions') }}",
            method: 'GET',
            data: {
                city : city,
                area: area,
                page: page
            },
            success: function (data) {
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

        $(document).on('click', '.delete-city', function(){
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

        $(document).on('change', '#state', function(){
            let cityId = $(this).val()
            $.ajax({
                url: "{{ url('admin/city/cities-by-state') }}"+"/"+cityId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    
                    $('#cities').empty();
                    $('#cities').append('<option selected disabled >--Select City--</option>');

                    $.each(response.cities, function(key, value) {
                            $('#cities').append($("<option/>", {
                                value: value.id,
                                text: value.name
                            })
                        );
                    });
                },
                error: function(jqXHR, status, error) {
                    // toggleLoadingAnimation();
                }

            });
        })

        
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

</script>
<script>
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @if(Session::has('message'))
        toastr.success("{{ Session::get('message') }}")
        setTimeout(function () {
            window.location.href = "{{ route('admin.area.index') }}";
        }, 3000);
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