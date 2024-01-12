
<!--<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />-->
    <form method="post" action="">
        @csrf
        <div class="row">
            <div class="d-flex justify-content-end mt-2 mb-2">
                 <input type="text" id="searchInput" name="searchbyId" class="form-control" placeholder="Search...">&nbsp;&nbsp;
                 <input type="submit" class="btn btn-success" name="Submit" value="Search">
             </div>
        </div>
    </form>
    {{-- 
    @if($builders->isEmpty())
    <tr>
         <td style="text-align:center; font-size:1.2em;" colspan="6" class="align-middle">No data found.</td>
    </tr>
    @else
          
    <div class="mb-2">
        <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel"><i
                class="fa-solid fa-file-excel me-1"></i> Excel</button>
        <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf"> <i
                class="fa-regular fa-file-pdf me-1"></i>
            PDF</button>
        <button class="btn btn-warning btn-sm ms-1" id="buttons-csv"><i
                class="fa-solid fa-file-csv me-1"></i>
            CSV</button>
    </div>
   <div class="ser_re">
    <b class="mb-2">Total Fetched Data : {{count($builders)}}</b>
    </div>
    @endif
    --}}
    <table class="table table-striped dt-responsive table-hover nowrap data-table"  style="width:100%">
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
            @foreach($builders as $builder)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$builder->name}}</td>
                    <td align="center">
                        <img src="{{asset('uploads/builders/'.$builder->group_logo)}}"
                            style="width: 35px;">

                    </td>
                    <td>{{$builder->address ?? 'N/A'}}</td>
                    <td>{{$builder->website ?? 'N/A'}}</td>
                    <td>{{$builder->contact_no ?? 'N/A'}}</td>
                    <td>{{$builder->mail ?? 'N/A'}}</td>
                    <td style="width:100px;">
                        <a href="{{url('admin/builder/details/'.$builder->id)}}"
                            class="btn btn-success btn-sm"> View More</a>
                        
                        <!-- <a class="icons-f delete-builder" id="delete-builder"  data-bid="{{$builder->id}}" data-bname="{{$builder->name}}">
                            <i class="fa-solid fa-trash"></i>
                        </a> -->

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
<div id="pagination">
    {{ $builders->links('pagination::bootstrap-4', ['secure' => true]) }}
</div>