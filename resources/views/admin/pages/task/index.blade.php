@extends('admin.layouts.main')
@section('content')
[5:48 PM] Rakesh Gadhasu

<div class="page-content">

    <div class="container-fluid">

        <!-- start page title -->

        <div class="row" style="margin-top:-19px;">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                </div>
            </div>
        </div>




        <div class="text-end mb-3">

            <a href="{{ route('admin.task.create') }}" type="button" class="btn btn-secondary custom-toggle add-property">
                <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Create Task</span>
            </a>

        </div>



        <!-- end page title -->





        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row   mb-3">

                            <div class="mb-3">
                                <button class="btn btn-warning btn-sm ms-1" fdprocessedid="iaib2"><i class="fa-regular fa-file-word me-1"></i>
                                    DOC</button>
                                <button class="btn btn-secondary btn-sm ms-1" id="buttons-excel" fdprocessedid="23q13e"><i class="fa-solid fa-file-excel me-1"></i> Excel</button>
                                <button class="btn btn-primary btn-sm ms-1" id="buttons-pdf" fdprocessedid="fix3hu"> <i class="fa-regular fa-file-pdf me-1"></i>
                                    PDF</button>
                                <button class="btn btn-info btn-sm ms-1" id="buttons-csv" fdprocessedid="uo01wm"><i class="fa-solid fa-file-csv me-1"></i>
                                    CSV</button>
                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered ">
                                    <tbody>
                                        <tr class="table-info">
                                            <th width="6%">Sno</th>
                                            <th>Builder Group Name </th>
                                            <th>Builder Group Logo</th>
                                            <th>Builder Group Address</th>
                                            <th>Builder Group Website</th>
                                            <th>Builder Group Contact No </th>
                                            <th>Builder Group Mail ID</th>
                                            <th>Action</th>
                                        </tr>

                                        <tr valign="middle">
                                            <td>1</td>
                                            <td>Test</td>
                                            <td align="center">
                                                <img src="https://manage.proper-t.co/public/assets/images/users/user-dummy-img.jpg" style="width: 35px;">

                                            </td>
                                            <td>#125478</td>
                                            <td>Surveryer</td>
                                            <td>Success</td>
                                            <td>30-06-2023</td>

                                            <td style="width:100px;">
                                                <a href="{{ route('admin.task.show') }}" class="btn btn-success btn-sm"> View More</a>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>

</div>
@endsection