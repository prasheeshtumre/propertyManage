@extends('admin.layouts.main')
@section('content')
<div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Dashboard</h4>
    
                        </div>
                    </div>
                </div>
                
                
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="mb-3 mt-3">
                                        <label for=" " class="form-label">Task Name</label>
                                        <input type="text" class="form-control" id=" " placeholder="TaskOne" name=" " readonly>
                                        <!-- <select class="form-select">-->
                                        <!--    <option>-Select-</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--</select>-->
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="mb-3 mt-3">
                                        <label for=" " class="form-label">Task Description</label>
                                        <input type="text" class="form-control" id=" " placeholder="   " name=" " readonly>
                                      </div>
                                </div>
                                
                                
                                <div class="col-md-3">
                                    <div class="mb-3 mt-3">
                                        <label for=" " class="form-label">Task Type</label>
                                        <input type="text" class="form-control" id=" " placeholder="TaskOne" name=" " readonly>
                                        <!--<select class="form-select">-->
                                        <!--    <option>-Select-</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--    <option>Test</option>-->
                                        <!--</select>-->
                                      </div>
                                </div>
                                
                                 <div class="col-md-3">
                                    <div class="mb-3 mt-3">
                                        <label for=" " class="form-label">GIS ID</label>
                                        <input type="text" class="form-control" id=" " placeholder="   " name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Due Date</label>
                                        <input type="text" class="form-control" id=" " placeholder="15/07/2023" name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Priority</label>
                                        <input type="text" class="form-control" id=" " placeholder="Test" name=" " readonly>
                                      </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">User Type</label>
                                        <input type="text" class="form-control" id=" " placeholder="Surveyor" name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Assigned User(s)</label>
                                        <input type="text" class="form-control" id=" " placeholder="Bhanuteja" name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Status</label>
                                        <input type="text" class="form-control" id=" " placeholder="Open" name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Date of Completion</label>
                                        <input type="text" class="form-control" id=" " placeholder="14/08/2023" name=" " readonly>
                                      </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 ">
                                        <label for=" " class="form-label">Remarks</label>
                                        <textarea class="form-control" rows="3" readonly></textarea>
                                      </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                        </div>
                                <!--<div class="text-end mt-4">-->
                                <!--    <button type="button" class="btn btn-primary  waves-light w_100" id="filter"><i class="fa fa-search"></i> Search</button>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-12 table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Si. no</th>
                                    <th>Status</th>
                                    <th>Completed Date</th>
                                    <th>Updated Date</th>
                                    <th>Time</th>
                                    <th>Updated by</th>
                                    <th>Remarks </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Completed</td>
                                    <td>25-08-2023</td>
                                    <td>07-07-2023</td>
                                    <td>14:34:02</td>
                                    <td>Bhanu</td>
                                    <td>Contact to the builder</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
        </div>
</div>

@endsection