@extends('admin.layouts.main')
@section('content')

<style>
/*    .multiselect {*/
/*  width: 200px;*/
/*}*/

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  /*font-weight: bold;*/
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
  padding:5px;
}

#checkboxes label:hover {
  background-color: #1e90ff;
  padding:5px;
}
</style>


<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-sm-flex align-items-center justify-content-between">
<h4 class="mb-sm-0">Task Management</h4>
</div>
</div>
</div>
<!-- end page title -->

 

            <div class="row">
<div class="col-xl-12 col-md-12">
<div class="card">
<div class="card-body">
<div class="row   mb-3">
    
    
    <div class="col-md-3">
        <div class="mb-3 mt-3">
            <label for=" " class="form-label">Task Type</label>
             <select class="form-select">
                <option>-Select-</option>
                <option>Test</option>
                <option>Test</option>
                <option>Test</option>
            </select>
          </div>
    </div>
    
    <div class="col-md-3">
        <div class="mb-3 mt-3">
            <label for=" " class="form-label">GIS ID</label>
            <input type="text" class="form-control" id=" " placeholder="   " name=" ">
          </div>
    </div>
    
    
    <div class="col-md-3">
        <div class="mb-3 mt-3">
            <label for=" " class="form-label">User Type</label>
            <select class="form-select">
                <option>-Select-</option>
                <option>Test</option>
                <option>Test</option>
                <option>Test</option>
            </select>
          </div>
    </div>
    
     <div class="col-md-3">
        <div class="mb-3 mt-3">
            <label for=" " class="form-label">Task Status</label>
            <input type="text" class="form-control" id=" " placeholder="   " name=" ">
          </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3 ">
            <label for=" " class="form-label">Assigned User</label>
            <input type="text" class="form-control" id=" " placeholder="   " name=" ">
          </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3 ">
            <label for=" " class="form-label">Due Date From</label>
            <input type="date" class="form-control" id=" " placeholder="   " name=" ">
          </div>
    </div>
     <div class="col-md-3">
        <div class="mb-3 ">
            <label for=" " class="form-label">Due Date To</label>
            <input type="date" class="form-control" id=" " placeholder="   " name=" ">
          </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3 ">
            <label for=" " class="form-label">Priority</label>
            <form>
              <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes()">
                  <select class="form-select">
                    <option>Select an option</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                  <label for="one">
                    <input type="checkbox" id="one" />First checkbox</label>
                  <label for="two">
                    <input type="checkbox" id="two" />Second checkbox</label>
                  <label for="three">
                    <input type="checkbox" id="three" />Third checkbox</label>
                </div>
              </div>
            </form>
          </div>
    </div>
    
    
      </div>
      
      <div class="text-end mt-4">
                                    <button type="button" class="btn btn-primary  waves-light w_100" id="filter"><i class="fa fa-search"></i> Search</button>
                                </div>
</div>
</div>
</div>
</div>



 <div class="row">
<div class="col-xl-12 col-md-12">
<div class="card">
<div class="card-body">
<div class="row   mb-3">
    
    <div class="table-responsive">
        <table class="table table-bordered ">
            <tr class="table-info">
                <th width="6%">Sno</th>
                <th>Task Name</th>
                <th>Task Type</th>
                <th>GIS ID</th>
                <th>Assigned to</th>
                <th>Task Status</th>
                <th>Due Date</th>
                <th>Remarks</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Test</td>
                <td>test</td>
                <td>#125478</td>
                <td>Surveryer</td>
                <td>Success</td>
                <td>30-06-2023</td>
                <td>Test</td>
                <td> 
                    <a href="#" class="btn btn-primary btn-sm">View</a>
                    
                </td>
            </tr>
            
        </table>
    </div>
    
    
      </div>
</div>
</div>
</div>
</div>





</div>
</div>
    
    
    
    


<script>
    
    var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
    
</script>















@endsection