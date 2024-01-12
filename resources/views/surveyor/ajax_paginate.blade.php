<style>
    table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before, table.dataTable.dtr-inline.collapsed>tbody>tr>th.dtr-control:before {
    top: 50%;
    left: 5px;
    height: 1em;
    width: 1em;
    margin-top: -9px;
    display: block;
    position: absolute;
    color: white;
    border: 0.15em solid white;
    border-radius: 1em;
    box-shadow: 0 0 0.2em #444;
    box-sizing: content-box;
    text-align: center;
    text-indent: 0 !important;
    font-family: "Courier New",Courier,monospace;
    line-height: 1em;
    content: "+";
    background-color: #0d6efd;
}
</style>
<div class="table-responsive">
    

<table class="table table-striped dt-responsive nowrap data-table" style="width:100%">
    <thead>
        <tr  style="background-color:#cfe2ff;">
            <th style="width:5px;">S.No</th> 
            <th>Role</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Email ID</th>
            <th>Username</th>
            <th>Status </th>
            <th>Last Activity Date </th>
            <th>Action</th>
        </tr>
    </thead>
    <!--12. Type-->
    <tbody>
        @foreach ($surveyors as $key=>$surveyor)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @forelse ($surveyor->roles as $role)
                         {{$role->name ?? 'N/A'}}
                    @empty
                        {{__('N/A')}}
                    @endforelse
                </td>
                <td>{{ $surveyor->name }}</td>
                <td>{{ $surveyor->mobile }}</td>
                <td>{{ $surveyor->email }}</td>
                <td>{{ $surveyor->username }}</td>
                <td>{{ $surveyor->status ? 'Active' : 'Deactive' }}</td>
                <td>{{ $surveyor->created_at->format('d-m-Y H:i:s') }}</td>
                <td><a href="{{ route('admin.surveyor.show', encrypt($surveyor->id)) }}" class="btn btn-success btn-sm"><i
                            class="fa fa-eye"></i> View More</a></td>
            </tr>
        @endforeach
    </tbody>

</table>
</div>
<div id="pagination">
    {{ $surveyors->links('pagination::bootstrap-4', ['secure' => true]) }}
</div>
