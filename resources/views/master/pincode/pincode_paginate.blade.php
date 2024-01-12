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

<form method="post" action="" id="searchform">
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
    <!-- <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i class="fa-solid fa-file-excel me-1"></i>
        Excel</button>
    <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i class="fa-regular fa-file-pdf me-1"></i>
        PDF</button>
    <button class="btn btn-info btn-sm ms-1" id="buttons-csv"><i class="fa-solid fa-file-csv me-1"></i>
        CSV</button> -->
</div>
<div class="ser_re">
    <b class="mb-2">Total Fetched Data : {{ $pincodes->total() ?? 0 }}</b>
</div>
<table class="table table-bordered data-table">
    <thead>
        <tr class="table-info">
            <th width="5%" align="center">S.No</th>
            <th>Pincode</th>
            <th>Created Date</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pincodes as $pincode)
            <tr>

                <td align="center">{{ ($pincodes->currentPage() - 1) * $pincodes->perPage() + $loop->iteration }}</td>
                <td> {{ $pincode->pincode }}</td>
                <td>{{ date('d-m-Y', strtotime($pincode->created_at)) }}</td>
                <td align="center" class="icons-fmain">
                    <a class="icons-f edit-pincode btn" data-pid="{{ $pincode->id ?? 0 }}"
                        data-pincode="{{ $pincode->pincode ?? '' }}"
                        data-url="{{ route('admin.pincode.update', $pincode->id) }}">
                        <i class="fa-regular fa-pen-to-square  "></i>
                    </a>
                    {{-- <a class="icons-f delete-pincode" data-pid="{{ $pincode->id }}"
                        data-url="{{ route('admin.pincode.destroy', $pincode->id) }}">
                        <i class="fa-solid fa-trash"></i>
                    </a> --}}
                </td>
            </tr>
        @empty
            <tr>
                <td align="center"> No data available</td>
            </tr>
        @endforelse
    </tbody>
</table>



<div id="pagination">
    {{ $pincodes->links('pagination::bootstrap-4') }}
</div>
