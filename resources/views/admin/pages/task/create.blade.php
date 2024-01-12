@extends('admin.layouts.main')
@section('content')
<div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Task Create </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom mb-3">
                                
                                <div class="col-xxl-3 col-md-3 mb-3">
                        				<label for="" class="form-label">Task Type <span class="errorcl">*</span></label>
                                			<select ="" class="form-select append-dd select2-dd floor_unit_type_dd floor_ddopt" data-fid="1" name="" id="">
                                                <option selected="" ="">-Select -</option>
                                                <option data-field="text" value="1">GIS-based tasks</option>
                                                <option data-field="select" value="2">Normal tasks</option>
                                          </select>
                                    	</div>
                                    	<div class="col-xxl-3 col-md-3 mb-3">
                        				<label for="" class="form-label"> GIS ID Field <span class="errorcl">*</span></label> 
                                			<input type="text" class="form-control" placeholder="">
                                    	</div>
                                    	
                                    	<div class="col-xxl-3 col-md-3 mb-3">
                        				<label for="" class="form-label"> Task Name<span class="errorcl">*</span></label> 
                                			<input type="text" class="form-control" placeholder="">
                                    	</div>
                                    	
                                
                                            	<div class="col-xxl-3 col-md-3 mb-3">
                                				<label for="" class="form-label"> Due Date <span class="errorcl">*</span></label> 
                                        			<input type="date" class="form-control" placeholder="">
                                            	</div>
                                            	<div class="col-xxl-3 col-md-3 mb-3">
                                				<label for="" class="form-label"> Priority <span class="errorcl">*</span></label> 
                                            		<select ="" class="form-select append-dd select2-dd floor_unit_type_dd floor_ddopt" data-fid="1" name="" id="">
                                                            <option selected="" ="">-Select -</option>
                                                            <option data-field="text" value="1">High</option>
                                                            <option data-field="select" value="2">Medium</option>
                                                            <option data-field="select" value="2">Low</option>
                                                  </select>
                                            	</div>
                                            	
                                            	<div class="col-xxl-3 col-md-3 mb-3">
                                    				<label for="" class="form-label"> User Type <span class="errorcl">*</span></label> 
                                                		<select ="" class="form-select append-dd select2-dd floor_unit_type_dd floor_ddopt" data-fid="1" name="" id="">
                                                                <option selected="" ="">-Select -</option>
                                                                <option data-field="text" value="1">surveyor </option>
                                                                <option data-field="select" value="2">Admin</option>
                                                      </select>
                                            	</div>
                                            	
                                                    <div class="col-xxl-3 col-md-3 mb-3 filters-hide" id="" style="">
                                                        <label for="" class="form-label">Assigned User <span class="errorcl">*</span></label>
                                                         <select class="form-select filter_dropdown select2-dd select2-hidden-accessible" id="fltr_builder_name" name="builder_name" tabindex="-1" aria-hidden="true">
                                                            <option value="">-Select Builder-</option>
                                                                <option value="2">surveyor</option>
                                                                <option value="3">Admin</option>
                                                            </select>
                                                     </div>
                                                   
                                        		<div class="col-xxl-12 col-md-12 mb-3 ">
                                    				<label for="" class="form-label"> Task Description<span class="errorcl">*</span></label> 
                                            			<textarea rows="4" cols="4" type="text" class="form-control" placeholder=""></textarea>
                                                	</div>
                                                	<div class="col-xxl-12 col-md-12 mb-3 ">
                                                	    <div class="text-end">
                                                	        <button class="btn btn-warning ms-2">Reset</button>
                                                	        <button class="btn btn-info ms-2">Clear</button>
                                                	        <button class="btn btn-primary ms-2">Submit</button>
                                                	    </div>
                                    			      </div>
                                    </div>
                        		
                        		
                        		
                        		</div>
                        	</div>
                        </div>
                     </div>
                   </div>
                </div>
            </div>
          

@endsection