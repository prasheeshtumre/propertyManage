@extends('admin.layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    @if ($category_code_name == 'brand')
                    <h4 class="mb-sm-0">Manage Brands</h4>
                    @elseif($category_code_name == 'sub category')
                    <h4 class="mb-sm-0">Manage Sub-Categories</h4>
                    @elseif($category_code_name == 'category')
                    <h4 class="mb-sm-0">Manage Categoires</h4>
                    @endif

                </div>
            </div>
        </div>
        {{-- <div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
						    <div class="card-body">
                                <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-4">
                                           <button id="create-btn" class="btn btn-success">Add {{ ucwords($category_code_name) ?? ''}}</button>
    </div>
</div>
</div>
</div>
</div>

</div> --}}
<!-- end page title -->
<form action="{{ route('admin.floor-unit.store') }}" method="post" enctype="multipart/form-data" class="" id="store-frm">
    @csrf
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="row">
                            @if ($category_code_name == 'sub category')
                            <!--<div class="col-auto"><label for="inputPassword6" class="form-label"></label></div>-->
                            <div class="col-xxl-3 col-md-3 mt-2">
                                <div>
                                    <label for="" class="form-label">Choose Category Name <span class="errorcl">*</span></label>
                                    <select class="form-select" name="parent_id" id="category">
                                        <option selected disabled>- Choose Category Name -</option>
                                        @forelse($parent_categories as $key=>$category)
                                        @if (old('category') == $category->id)
                                        <option value="{{ $category->id }}" selected>
                                            {{ $category->name }}
                                        </option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                        @endif
                                        @empty
                                        {{-- <option>-no options are available-</option> --}}
                                        @endforelse
                                    </select>
                                    @error('parent_id')
                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            @if ($category_code_name == 'brand')
                            <!--<input type = "text" name="text_id">-->
                            <!--@error('text_id')
        -->
                            <!--            <span class="input-error" style="color: red">{{ $message }}</span>-->
                            <!--
    @enderror-->
                            <div class="col-xxl-3 col-md-3 mt-2">
                                <div>
                                    <label for="" class="form-label">Choose Category Name <span class="errorcl">*</span></label>
                                    <select class="form-select" name="category" id="category">
                                        <option value='' selected>- Choose Category Name -</option>
                                        @forelse($parent_categories as $key=>$category)
                                        @if (old('category') == $category->id)
                                        <option value="{{ $category->id }}" selected>
                                            {{ $category->name }}
                                        </option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                        @endif
                                        @empty
                                        {{-- <option>-no options are available-</option> --}}
                                        @endforelse
                                    </select>
                                    @error('category')
                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-3   mt-2">
                                <label>Choose Sub Category Name</label>
                                <div>
                                    <select class="form-select" name="parent_id" id="subcategory">
                                        <option value=''>- Choose Sub Category Name -</option>
                                    </select>
                                    @error('parent_id')
                                    <span class="input-error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif


                            <div class="col-md-4 col-lg-4 mt-2">
                                <label>Enter {{ ucfirst($category_code_name) }} Name</label>
                                <input type="text" id="floor-unit_name" data-pid="2" name="name" class="form-control" placeholder="Enter {{ ucfirst($category_code_name) }} Name">
                                <input type="hidden" id="floor-unit_id" value="0" name="category_id">
                                @if ($category_code_name == 'category')
                                <input type="hidden" value="2" name="parent_id">
                                @endif

                                <input type="hidden" id="" value="{{ $category_code ?? 0 }}" name="category_code">
                                <input type="hidden" id="" value="{{ $category_code_name ?? 0 }}" name="category_code_name">
                                @error('name')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            @if($category_code_name == 'category')
                            <div class="col-md-4 col-lg-4 mt-2">
                                <label>Enter {{ ucfirst($category_code_name) }} Title</label>
                                <input type="text" id="floor-unit_title" name="title" class="form-control" placeholder="Enter {{ ucfirst($category_code_name) }} title" value="{{ old('title') }}">

                                @error('title')
                                <span class="input-error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            <div class="col-md-2 col-lg-2 mt-4 mt-2">
                                <button type="submit" class="btn btn-primary mt-3 waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Create</span> </button>
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
                <h4 class="mt-0 header-title">{{ ucwords($category_code_title ?? '') }}</h4>
                <div class="d-flex justify-content-between align-items-center mb-1 ">

                </div>

                <div class="table-responsive" id="pagination_data">

                    @include('floor_unit_category.category_paginate', [
                    'categories' => $categories,
                    ])

                </div>
            </div>


        </div>

    </div>

</div>

{{-- <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">{{ ucwords($category_code_title ?? '')}}</h4>
<div id="pagination_data">
    @include('floor_unit_category.category_paginate', [
    'categories' => $categories,
    ])
</div>
</div>
</div>
</div>

</div> --}}
<!--end row-->

</div> <!-- container-fluid -->
</div>
<input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
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
    $(document).on('click', '.edit-floor-unit', function() {
        $('#category option').each(function() {
            $(this).attr('selected', '')
        });
        // alert($(this).data('pid'));
        $("#floor-unit_id").val($(this).data('bid'));
        $("#floor-unit_name").val($(this).data('bname'));
        $("#floor-unit_title").val($(this).data('title'));
        $("#category option[value=" + $(this).data('gpid') + "]").attr('selected', 'selected');
        // alert(getSubCategories($(this).data('gpid')));
        getSubCategories($(this).data('gpid'));
        $("#subcategory option[value=" + $(this).data('pid') + "]").attr('selected', 'selected');
        // $("#category").val($(this).data('pid')).change();
        $("#btn-txt").html('Update');
    })
    $(document).on('click', '#create-btn', function() {
        $("#floor-unit_id").val(0);
        $("#floor-unit_name").val('');
        $("#floor-unit_title").val('');
        $("#btn-txt").html('Create');
    })
</script>
<script>
    @foreach($errors->all() as $error)
    toastr.error("{{ $error }}")
    @endforeach
    @if(Session::has('message'))
    toastr.success("{{ Session::get('message') }}")
    @endif
</script>

<script></script>
<!--<script-->
<!--    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"-->
<!--    async defer></script>-->
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
//
<script>
    // $(document).ready(function(){
    //     $('#category').select2({
    //         theme: "classic"
    //     });
    // });
    // 
</script>
//
<script>
    // $(document).ready(function(){
    //     $('#subcategory').select2({
    //         theme: "classic"
    //     });
    // });
    // 
</script>
<script>
    $('#category').on('change', function() {
        var CategoryId = this.value;
        $("#subcategory").html('');
        getSubCategories(CategoryId);
    });

    function getSubCategories(CategoryId) {
        $.ajax({
            url: "{{ url('admin/brand/fetch/subcategory') }}",
            type: "POST",
            data: {
                category_id: CategoryId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(res) {
                $('#subcategory').html('<option name="subcategory" value="" >Select Sub Category</option>');
                $.each(res, function(key, value) {
                    $("#subcategory").append('<option name="subcategory" value="' + value
                        .id + '" selected>' + value.name + '</option>');
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.delete-category').click(function() {
            var categoryId = $(this).data('bid');
            var categoryName = $(this).data('bname');
            var deleteUrl = "{{ url('admin/floor-unit/destroy/') }}" + '/' + categoryId;

            $('#deleteCategoryName').text(categoryName);
            $('#deleteCategoryLink').attr('href', deleteUrl);

            $('#deleteModal').modal('show');
        });
    });
</script>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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