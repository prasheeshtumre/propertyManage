<style>
    .icons-f i {
        font-size: 22px;
        margin: 0px 5px;
    }

    .icons-fmain {
        display: flex;
        align-content: center;
        flex-wrap: nowrap;
        justify-content: center;
    }

    /* Add a container to position the search box */
    .search-container {
        text-align: right;
        /* Aligns the input box to the right */
        margin-bottom: 10px;
        /* Optional: Add some spacing between the input and the table */
    }

    .ser_re {
        background-color: #f3e4ff;
        padding: 5px 10px;

    }

    /* Style the search box */
    #searchInput {
        padding: 5px;
        /* Adjust padding to your preference */
        border: 1px solid #ccc;
        /* Add a border around the input box */
        border-radius: 4px;
        /* Optional: Add some border-radius to make it look nicer */
        width: 250px;
        /* Optional: Set a fixed width for the input box */
    }

    #searchCategory {
        padding: 5px;
        /* Adjust padding to your preference */
        border: 1px solid #ccc;
        /* Add a border around the input box */
        border-radius: 4px;
        /* Optional: Add some border-radius to make it look nicer */
        width: 250px;
        /* Optional: Set a fixed width for the input box */
    }

    #searchBySubCategory {
        padding: 5px;
        /* Adjust padding to your preference */
        border: 1px solid #ccc;
        /* Add a border around the input box */
        border-radius: 4px;
        /* Optional: Add some border-radius to make it look nicer */
        width: 250px;
        /* Optional: Set a fixed width for the input box */
    }
</style>
@if ($category_code_name == 'category')
    <form method="post" action="">
        @csrf
        <div class="row">
            <div class="d-flex justify-content-end mt-2 mb-2">
                <input type="text" id="searchInput" name="searchbyId" class="form-control"
                    placeholder="Search...">&nbsp;&nbsp;
                <input type="submit" class="btn btn-success" name="Submit" value="Search">
            </div>
        </div>
    </form>
    <div class="mb-2">
        <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i class="fa-solid fa-file-excel me-1"></i>
            Excel</button>
        <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i class="fa-regular fa-file-pdf me-1"></i>
            PDF</button>
        <button class="btn btn-info btn-sm ms-1" id="buttons-csv"><i class="fa-solid fa-file-csv me-1"></i>
            CSV</button>
    </div>
    <div class="ser_re">
        <b class="mb-2">Total Fetched Data : {{ count($categories) }}</b>
    </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr class="table-info">
                <th width="5%" align="center">S.No</th>
                <th>Category Name</th>
                <th>Category Title</th>
                <th>Created Date</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($categories->isEmpty())
                <!--<tr>-->
                <!--     <td style="text-align:center; font-size:1.2em;" colspan="6" class="align-middle">No data found.-->
                <!--     </td>-->
                <!--</tr>-->
            @else
                </div>


                @foreach ($categories as $category)
                    <tr>

                        <td align="center">{{ $loop->iteration }}</td>
                        <td> {{ $category->name }}</td>
                        <td> {{ $category->title ?? 'N/A' }}</td>
                        <td>{{ $category->created_at->format('d-m-Y') }}</td>
                        <td align="center" class="icons-fmain">
                            <a class="icons-f edit-floor-unit" data-bid="{{ $category->id ?? 0 }}"
                                data-pid="{{ $category->parent_id ?? 0 }}" data-bname="{{ $category->name ?? '' }}"
                                data-title="{{ $category->title ?? $category->name }}">
                                <i class="fa-regular fa-pen-to-square  "></i>
                            </a>
                            <!-- <a class="icons-f delete-category" data-bid="{{ $category->id }}" data-bname="{{ $category->name }}">
                    <i class="fa-solid fa-trash"></i>
                </a> -->
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@elseif($category_code_name == 'sub category')
    <form method="post" action="">
        @csrf
        <div class="row justify-content-end">
            <div class="col-xl-12 col-md-12">
                <div class="row justify-content-end">
                    <div class="col-xxl-3 col-md-3">
                        <label for="" class="form-label">Select By Category</label>
                        <select name="searchBYCategory" class="form-control form-select" id="searchCategory">
                            <option value="">Select By Category</option>
                            @foreach ($subcategory as $subcat)
                                <option value="{{ $subcat->id ?? '' }}"
                                    @if ($request->searchCategory == $subcat->id) selected @endif>{{ $subcat->name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xxl-3 col-md-3">
                        <label for="" class="form-label">Search Sub Category Name</label>
                        <input type="text" id="searchInput" name="searchbyId" class="form-control"
                            placeholder="Search by Subcategory">
                    </div>

                    <div class="col-auto mt-4">
                        <input type="submit" class="btn btn-success" name="Submit" value="Search">
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if ($categories->isEmpty())
        <!--<tr>-->
        <!--     <td style="text-align:center; font-size:1.2em;" colspan="6" class="align-middle">No data found.-->
        <!--     </td>-->
        <!--</tr>-->
    @else
        <div class="mb-2">
            <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i class="fa-solid fa-file-excel me-1"></i>
                Excel</button>
            <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i class="fa-regular fa-file-pdf me-1"></i>
                PDF</button>
            <button class="btn btn-info btn-sm ms-1" id="buttons-csv"><i class="fa-solid fa-file-csv me-1"></i>
                CSV</button>
        </div>
    @endif
    <div class="ser_re">
        <b class="mb-2">Total Fetched Data : {{ $categories->total() }}</b>
    </div>
    <table class="table table-bordered data-table" id="dataTable">
        <thead>
            <tr class="table-info">
                <th width="5%" align="center">S.No</th>
                <th>Category Name</th>
                <th>Sub Category Name</th>
                <th>Created Date</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $category->parent->name ?? '' }}</td>
                    <td> {{ $category->name }}</td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td align="center" class="icons-fmain">
                        <a class="icons-f edit-floor-unit"
                            href="{{ url('admin/floor-unit-sub-category/edit/' . $category->id) }}/sub-category"
                            data-bid="{{ $category->id ?? 0 }}" data-gpid="{{ $category->parent_id ?? 0 }}"
                            data-pid="{{ $category->parent->id ?? 0 }}" data-bname="{{ $category->name ?? '' }}">
                            <i class="fa-regular fa-pen-to-square  "></i>
                        </a>
                        <!--<a class="icons-f" href="{{ url('admin/floor-unit/destroy/' . $category->id) }}">-->
                        <!--<i class="fa-solid fa-trash  "></i>-->
                        <!--</a>-->
                        <!-- <a class="icons-f delete-category" data-bid="{{ $category->id }}" data-bname="{{ $category->name }}">
                    <i class="fa-solid fa-trash"></i>
                </a> -->
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@elseif($category_code_name == 'brand')
    <form method="post" action="">
        @csrf
        <div class="row justify-content-end">
            <div class="col-xl-12 col-md-12 mb-2">
                <div class="row justify-content-end">
                    <div class="col-xxl-3 col-md-3">
                        <label for="" class="form-label">Select By Category</label>
                        <select name="searchCategory" class="form-control form-select" id="searchCategory"
                            onchange="getSubcategory(this.value,2)">
                            <option value="">Select By Category</option>
                            @foreach ($subcategory as $subcat)
                                <option value="{{ $subcat->id ?? '' }}"
                                    @if ($request->searchCategory == $subcat->id) selected @endif>{{ $subcat->name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xxl-3 col-md-3">
                        <label for="" class="form-label">Select By Sub Category</label>
                        <select name="searchBySubCategory" class="form-control form-select" id="searchBySubCategory">
                            <option value="">Search By Sub Category</option>
                            <option value=""></option>
                        </select>
                    </div>

                    <div class="col-xxl-3 col-md-3 ">
                        <label for="" class="form-label">Search By Brand Name</label>
                        <input type="text" id="searchInput" name="searchbyId" class="form-control"
                            placeholder="Search...">
                    </div>

                    <div class="col-auto mt-4">
                        <input type="submit" class="btn btn-success" name="Submit" value="Search">
                    </div>
                </div>
            </div>
        </div>



        <!--<div class="row">-->
        <!--    <div class="d-flex justify-content-end mt-2 mb-2">-->
        <!--        <select name="searchCategory" class="form-control form-select" id="searchCategory" onchange="getSubcategory(this.value,2)" required>-->
        <!--            <option value="">Select By Category</option>-->
        <!--            @foreach ($subcategory as $subcat)
-->
        <!--            <option value="{{ $subcat->id ?? '' }}" @if ($request->searchCategory == $subcat->id) selected @endif>{{ $subcat->name ?? '' }}</option>-->
        <!--
@endforeach-->
        <!--        </select>&nbsp;&nbsp;-->
        <!--        <select name="searchBySubCategory" class="form-control form-select" id="searchBySubCategory" required>-->
        <!--            <option value="">Select By Sub Category</option>-->
        <!--            <option value=""></option>-->

        <!--        </select>&nbsp;&nbsp;-->
        <!--        <input type="text" id="searchInput" name="searchbyId" class="form-control" placeholder="Search...">&nbsp;&nbsp;-->
        <!--        <input type="submit" class="btn btn-success" name="Submit" value="Search">-->
        <!--    </div>-->
        <!--</div>-->
    </form>
    @if ($categories->isEmpty())
        <!--   <tr>-->
        <!--     <td style="text-align:center; font-size:1.2em;" colspan="6" class="align-middle">No data found.-->
        <!--     </td>-->
        <!--</tr>-->
    @else
        <div class="mb-2">
            <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i
                    class="fa-solid fa-file-excel me-1"></i> Excel</button>
            <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i class="fa-regular fa-file-pdf me-1"></i>
                PDF</button>
            <button class="btn btn-info btn-sm ms-1" id="buttons-csv"><i class="fa-solid fa-file-csv me-1"></i>
                CSV</button>
        </div>
    @endif
    <div class="ser_re">
        <b class="mb-2">Total Fetched Data : {{ count($categories) }}</b>
    </div>
    <table class="table table-bordered data-table" id="dataTable">
        <thead>
            <tr class="table-info">
                <th width="5%" align="center">S.No</th>
                <th>Category Name</th>
                <th>Sub Category Name</th>
                <th>Brand Name</th>
                <th>Created Date</th>
                <th style="text-align: center;">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $category)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $category->parent->parent->name ?? '' }}</td>
                    <td>{{ $category->parent->name ?? '' }}</td>
                    <td>{{ $category->name ?? '' }}</td>
                    <td>{{ $category->created_at->format('d-m-Y') }}</td>
                    <td align="center" class="icons-fmain">
                        <a class="icons-f edit-floor-unit"
                            href="{{ url('admin/floor-unit-sub-category/edit/' . $category->id) }}/brand"
                            data-bid="{{ $category->id ?? 0 }}" data-gpid="{{ $category->parent->parent->id ?? 0 }}"
                            data-pid="{{ $category->parent_id ?? 0 }}" data-bname="{{ $category->name ?? '' }}">
                            <i class="fa-regular fa-pen-to-square  "></i>
                        </a>
                        <!-- <a class="icons-f delete-category" data-bid="{{ $category->id }}" data-bname="{{ $category->name }}">
                    <i class="fa-solid fa-trash"></i>
                </a> -->
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function getSubcategory(id, type) {
        var idCountry = id;
        $("#searchBySubCategory").html('');
        $.ajax({
            url: "{{ url('admin/brand/api/fetch-brands') }}",
            type: "POST",
            data: {
                category_id: idCountry,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#searchBySubCategory').html('<option value="">Select Sub Category</option>');
                $.each(result.brands, function(key, value) {
                    $("#searchBySubCategory").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                    console.log(value.name);
                });

                if (type == 1) {
                    $("#searchBySubCategory").val({{ $request->searchBySubCategory }});
                }

            }
        });
    }
    @if (isset($request->searchCategory))
        $(document).ready(function() {
            getSubcategory({{ $request->searchCategory }}, 1);
        });
    @endif
</script>

<script type="text/javascript">
    $(function() {
        $('#pagination_data').removeClass('d-none');
        $('.loader-container').addClass('d-none');

        var table = $('.data-table').DataTable({
            dom: 'Brt',
            paging: false,
            ordering: false
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
                    dom: 'Brt',
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
                dom: 'Brt',
            });
            $('.dt-button').addClass('d-none');
        });
        return false;
    });
</script>
<div id="pagination">
    {{ $categories->links('pagination::bootstrap-4') }}
</div>
