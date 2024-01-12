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
    <b class="mb-2">Total Fetched Data : {{ $construction_partners->total() ?? 0 }}</b>
</div>
<table class="table table-bordered data-table">
    <thead>
        <tr class="table-info">
            <th width="5%" align="center">S.No</th>
            <th>Construction Partner</th>
            <th>Created Date</th>
            <th style="text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($construction_partners as $construction_partner)
            <tr>

                <td align="center">{{ ($construction_partners->currentPage() - 1) * $construction_partners->perPage() + $loop->iteration }}</td>
                <td> {{ $construction_partner->name }}</td>
                <td>{{ date('d-m-Y', strtotime($construction_partner->created_at)) }}</td>
                <td align="center" class="icons-fmain">
                    <a class="icons-f edit-construction_partner btn" data-id="{{ $construction_partner->id ?? 0 }}"
                        data-construction_partner="{{ $construction_partner->name ?? '' }}"
                        data-url="{{ route('admin.construction_partner.update', $construction_partner->id) }}">
                        <i class="fa-regular fa-pen-to-square  "></i>
                    </a>
                    <!-- <a class="icons-f delete-construction_partner" data-id="{{ $construction_partner->id }}"
                        data-url="{{ route('admin.construction_partner.destroy', $construction_partner->id) }}">
                        <i class="fa-solid fa-trash"></i>
                    </a> -->
                </td>
            </tr>
        @empty
            <tr>
                <td align="center" colspan="4"> No data available</td>
            </tr>
        @endforelse
    </tbody>
</table>



<div id="pagination">
    {{ $construction_partners->links('pagination::bootstrap-4') }}
</div>
