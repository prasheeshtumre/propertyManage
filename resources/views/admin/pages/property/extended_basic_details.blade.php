@extends('admin.layouts.main')
@section('content')
<style>
 
</style>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Basic Details</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="container">
                    <div class="card">
                        <div class="card-body">
                        <div class="progress progress-step-arrow progress-info">
                                <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Property Details</a>
                                <a href="javascript:void(0);" class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"> Pricing & Other Details</a>
                                <a href="javascript:void(0);" class="progress-bar bg-light text-dark" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> Amenities Details(Optional)</a>
                            </div>
                            <!-- step -1 -->
                            <div class="mt-4 mb-4">
                                <h4 class="heading">Property Details</h4>
                                <p class="sub-heading">No of Bedrooms </p>
                                <div class="list-bedrooms"> 
                                  <span class="">1</span>
                                  <span>2</span>
                                    <span>3</span>
                                      <span>4</span>
                                </div>
                                <div class="add-other">
                                    <div>
                                        <a href="#"> + Add other</a>
                                        </div>
                                    <div>
                                        <button class="btn btn-done btn-primary">Done</button>
                                        </div>
                                </div>
                                
                                 <p class="sub-heading">No of Bathrooms </p>
                                <div class="list-bedrooms"> 
                                  <span class="">1</span>
                                  <span>2</span>
                                    <span>3</span>
                                      <span>4</span>
                                </div>
                                <div class="add-other">
                                    <div>
                                        <a href="#"> + Add other</a>
                                        </div>
                                    <div>
                                        <button class="btn btn-done btn-primary">Done</button>
                                        </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    </div>
@endsection
@push('scripts')
    <script>
       var next_click=document.querySelectorAll(".next_button");
var main_form=document.querySelectorAll(".main");
var step_list = document.querySelectorAll(".progress-bar li");
var num = document.querySelector(".step-number");
let formnumber=0;

next_click.forEach(function(next_click_form){
    next_click_form.addEventListener('click',function(){
        if(!validateform()){
            return false
        }
       formnumber++;
       updateform();
       progress_forward();
       contentchange();
    });
}); 

var back_click=document.querySelectorAll(".back_button");
back_click.forEach(function(back_click_form){
    back_click_form.addEventListener('click',function(){
       formnumber--;
       updateform();
       progress_backward();
       contentchange();
    });
});

var username=document.querySelector("#user_name");
var shownname=document.querySelector(".shown_name");
 

var submit_click=document.querySelectorAll(".submit_button");
submit_click.forEach(function(submit_click_form){
    submit_click_form.addEventListener('click',function(){
       shownname.innerHTML= username.value;
       formnumber++;
       updateform(); 
    });
});

var heart=document.querySelector(".fa-heart");
heart.addEventListener('click',function(){
   heart.classList.toggle('heart');
});


var share=document.querySelector(".fa-share-alt");
share.addEventListener('click',function(){
   share.classList.toggle('share');
});

 

function updateform(){
    main_form.forEach(function(mainform_number){
        mainform_number.classList.remove('active');
    })
    main_form[formnumber].classList.add('active');
} 
 
function progress_forward(){
    // step_list.forEach(list => {
        
    //     list.classList.remove('active');
         
    // }); 
    
     
    num.innerHTML = formnumber+1;
    step_list[formnumber].classList.add('active');
}  

function progress_backward(){
    var form_num = formnumber+1;
    step_list[form_num].classList.remove('active');
    num.innerHTML = form_num;
} 
 
var step_num_content=document.querySelectorAll(".step-number-content");

 function contentchange(){
     step_num_content.forEach(function(content){
        content.classList.remove('active'); 
        content.classList.add('d-none');
     }); 
     step_num_content[formnumber].classList.add('active');
 } 
 
 
function validateform(){
    validate=true;
    var validate_inputs=document.querySelectorAll(".main.active input");
    validate_inputs.forEach(function(vaildate_input){
        vaildate_input.classList.remove('warning');
        if(vaildate_input.hasAttribute('require')){
            if(vaildate_input.value.length==0){
                validate=false;
                vaildate_input.classList.add('warning');
            }
        }
    });
    return validate;
    
}
    </script>
@endpush
