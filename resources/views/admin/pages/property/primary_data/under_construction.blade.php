<div class="under-construction">

	<div class="row under-construction-pfrm under-construction-fields-child">
		<div class="col-xxl-3 col-md-3 mt-3 ">
			<div>
				<label for="" class="form-label">under construction Types<span class="errorcl">*</span></label>
				<select class="form-select ctfd-required" name="under_construction_type" id="">
					<option selected="" disabled="">-Select under construction Types-</option>
					@forelse($prop_categories->take(3) as $prop_category)
					<option value="{{$prop_category->id}}">{{$prop_category->cat_name}}</option>
					@empty
					@endforelse
				</select>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">city </label>
				<input type="text" name="city" class="form-control" id="" disabled>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Project Name</label>
				<input type="text" name="project_name" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label"> Builder </label>
			<div class="">
				<input type="text" class="form-control select-suggestions builder-dd" autocomplete="off" placeholder="Search Builder">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label"> Builder Sub Groups </label>
			<div class="">
				<input type="text" class="form-control builder-sub-group-select-suggestions builder-sub-group-dd" autocomplete="off" placeholder="Search Builder Sub Group">
				<div class="builder-sub-group-autocomplete-dropdown" style="display: none;"></div>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label ">Construction Partner</label>
			<div class="choose-suggestion-label-body">
				<input type="text" class="form-control construction-partner-select-suggestions" id="" placeholder="Search Construction partner">
				<label for="" class="choose-suggestion-label">Choose Option</label>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Contact No</label>
				<input type="text" name="contact_no" class="form-control is-contact-no" data-valid-length="10" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">House No</label>
				<input type="text" name="house_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Plot No</label>
				<input type="text" name="plot_no" class="form-control" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<label for="" class="form-label ">Area</label>
			<div class="choose-suggestion-label-body">
				<input type="text" class="form-control area-select-suggestions" id="" placeholder="Search Area">
				<label for="" class="choose-suggestion-label">Choose Option</label>
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Street Name/No/Road No <span class="errorcl">*</span></label>
				<input type="text" name="street_name" class="form-control ctfd-required" id="">
			</div>
		</div>
		<div class="col-xxl-3 col-md-3 mt-3">
			<div>
				<label for="" class="form-label">Colony/Locality Name <span class="errorcl">*</span></label>
				<input type="text" name="locality_name" class="form-control ctfd-required" id="">
			</div>
		</div>

	</div>

</div>