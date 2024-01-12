@extends('admin.layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-selection--single{
        height:38px !important;
    }
    .select2-selection__rendered{
        line-height:36px !important;
    }
    .select2-selection__arrow{
        top:6px !important;
    }
</style>
  <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        @if($type == 'sub-category')
                        <h4 class="mb-sm-0">Manage Sub-Categories</h4>
                          @elseif($type == 'brand')
                          <h4 class="mb-sm-0">Manage Brand</h4>
                        @endif
                    </div>
                </div>
            </div>
             {{--<div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
						    <div class="card-body">
    							
                                <div class="row">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 col-lg-4">
                                           <button id="create-btn" class="btn btn-success">Add {{ ucwords($category_code_name) ?? ''}}</button>
                                        </div>
                                    </div>
                			    </div> 
						    </div>	
						</div>	
					</div> 
					
				</div> --}}
            <!-- end page title -->
            
            @if($type == 'sub-category')
              <form action="{{url('admin/floor-unit-sub-category/update-sub-cat')}}/{{$sub_category->id}}" method="post"  enctype="multipart/form-data"  class="" id="store-frm">
                @csrf
                <div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
						    <div class="card-body">
    							<div class="col-xl-12 col-md-12">
            						<div class="row">
            						    <div class="row">
                                            <!--<div class="col-auto"><label for="inputPassword6" class="form-label"></label></div>-->
                                            <div class="col-lg-4 col-md-4 mt-2">
                                                <div>
                                                    <label for="" class="form-label">Choose Category Name <span
                                                            class="errorcl">*</span></label>
                                                           
                                                    <select class="form-select" name="parent_id" id="category">
                                                        <option selected disabled>- Choose Category Name -</option>
                                                        @forelse($parent_categories as $key=>$category)
                                                            @if ($sub_category->parent_id == $category->id)
                                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                            @else
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endif
                                                        @empty
                                                            {{-- <option>-no options are available-</option> --}}
                                                        @endforelse
                                                    </select>
                                                    @error('parent_id')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            
                                          
                                            <div class="col-lg-4 col-md-4  mt-2">
                                                <label>Edit Sub Category Name</label>
                                                <div >
                                                
                                                <input type="text"   id="floor-unit_name" data-pid="2" name="name" class="form-control" value="{{$sub_category->name}}" placeholder="Enter Subcategory Name">
                                               
                                                @error('name')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            </div>
                						
                                            <div class="col-md-4 col-lg-4 mt-4"><button type="submit" class="btn btn-primary mt-2 waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Update</span> </button></div>
                                           
            						    </div>
            						</div>
                			    </div> 
						    </div>	
						</div>	
					</div> 
					
				</div>
            </form>	
            @endif 
            
            @if($type == 'brand')
              <form action="{{url('admin/brand/update-brand')}}/{{$brand->id}}" method="post"  enctype="multipart/form-data"  class="" id="store-frm">
                @csrf
                <div class="row">
					<div class="col-xl-12 col-md-12">
						<div class="card">
						    <div class="card-body">
    							<div class="col-xl-12 col-md-12">
            						<div class="row">
            						    <div class="row">
                                            <!--<div class="col-auto"><label for="inputPassword6" class="form-label"></label></div>-->
                                            <div class="col-lg-4 col-md-4 mt-2">
                                                <div>
                                                    <label for="" class="form-label">Choose Category Name <span
                                                            class="errorcl">*</span></label>
                                                           
                                                    <select class="form-select" name="parent_id" id="category">
                                                        <option selected disabled>- Choose Category Name -</option>
                                                        @forelse($parent_categories as $key=>$category)
                                                            @if (isset($brand->parent->parent->id) && $brand->parent->parent->id == $category->id)
                                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                            @else
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endif
                                                        @empty
                                                            {{-- <option>-no options are available-</option> --}}
                                                        @endforelse
                                                    </select>
                                                    @error('parent_id')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                             <div class="col-lg-4 col-md-4 mt-2">
                                                <label>Choose Sub Category Name</label>
                                                <div>
                                                    <select class="form-select" name="sub_category" id="subcategory">
                                                        <option>- Choose Sub Category Name -</option>
                                                        <option value="{{ $brand->parent_id }}" selected>{{ $brand->parent->name ?? '' }}</option>
                                                    </select>
                                                    @error('sub_category')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            
                                          
                                            <div class="col-lg-4 col-md-4  mt-2">
                                                <label>Edit Brand Name</label>
                                                <div >
                                                
                                                <input type="text"   id="floor-unit_name" data-pid="2" name="name" class="form-control" value="{{$brand->name}}" placeholder="Enter Brand Name">
                                               
                                                @error('name')
                                                        <span class="input-error" style="color: red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            </div>
                						    <!--<div class="col-auto">-->
                						    <!--    <span id="" class="form-text">	-->
            						                
                          <!--                      </span>-->
                          <!--                  </div>-->
                                            <div class="col-md-4 col-lg-4 mt-3 ms-auto"><button type="submit" class="btn btn-primary float-end waves-light w_100"><i class="fa fa-check"></i> <span id="btn-txt">Update</span> </button></div>
                                           
            						    </div>
            						</div>
                			    </div> 
						    </div>	
						</div>	
					</div> 
					
				</div>
            </form>	
            @endif

		

        </div> <!-- container-fluid -->
    </div>
    <input type="hidden" @if (Session::has('message')) value="1" @endif id="success_status">
@endsection
@push('scripts')
    <script>
        $(function() {
            $(document).on("click", ".pagination a,#search_btn", function(e) {
                e.preventDefault();
                //get url and make final url for ajax 
                let url = $(this).attr("href");
                let append = url.indexOf("?") == -1 ? "?" : "&";
                let finalURL = url + append ;
                 $.ajax({
                type: "GET",
                url: finalURL,
                secure: true,
                success: function(response) {
                    $("#pagination_data").html(response);
                }
            });
                return false;
            });

        });
        $(document).on('click', '.edit-floor-unit', function(){
            $('#category option').each(function(){
                $(this).prop('selected', false)
            });
            // alert($(this).data('pid'));
            $("#floor-unit_id").val($(this).data('bid'));
            $("#floor-unit_name").val($(this).data('bname'));
            $("#category option[value="+$(this).data('gpid')+"]").attr('selected','selected');
            // alert(getSubCategories($(this).data('gpid')));
            getSubCategories($(this).data('gpid'));
            $("#subcategory option[value="+$(this).data('pid')+"]").attr('selected','selected');
            // $("#category").val($(this).data('pid')).change();
            $("#btn-txt").html('Update');
        })
        $(document).on('click', '#create-btn', function(){
            $("#floor-unit_id").val(0);
            $("#floor-unit_name").val('');
            $("#btn-txt").html('Create');
        })
    </script>
    <script>
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
        @if (Session::has('message'))
           toastr.success("{{ Session::get('message') }}")
        @endif
    </script>
   
    <script>
    
    </script>
    <!--<script-->
    <!--    src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw&callback=initMap"-->
    <!--    async defer></script>-->
    <script>
        function isNumber(evt) {

            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    // <script>
    // $(document).ready(function(){
    //     $('#category').select2({
    //         theme: "classic"
    //     });
    // });
    // </script>
    // <script>
    // $(document).ready(function(){
    //     $('#subcategory').select2({
    //         theme: "classic"
    //     });
    // });
    // </script>
    <script>
        $('#category').on('change', function () {
            var CategoryId = this.value;
            $("#subcategory").html('');
            getSubCategories(CategoryId);
        });
        function getSubCategories(CategoryId){
            $.ajax({
                url: "{{url('admin/brand/fetch/subcategory')}}",
                type: "POST",
                data: {
                    category_id: CategoryId,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#subcategory').html('<option name="subcategory" value="" >Select Sub Category</option>');
                    $.each(res, function (key, value) {
                        $("#subcategory").append('<option name="subcategory" value="' + value
                            .id + '" selected>' + value.name + '</option>');
                    });
                }
            });
        }
    </script>
    <select id="categorySelect"></select>

<script>
  $(document).ready(function() {
    $('#category').select2();
    $('#subcategory').select2();
    
  });
</script>

@endpush