 <div class="mainDiiv">
     <div class="  ">
         <div class="viewbedrooms">
             <div>
                 <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-fluid">
             </div>
             <div>
                 <div>
                     <p><strong>GIS No</strong></p>
                 </div>
                 <div class="extra-content">
                     <p>{{ $property->gis_id }}</p>
                 </div>
             </div>
         </div>
     </div>
     <div class="  ">
         <div class="viewbedrooms">
             <div>
                 <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-fluid">
             </div>
             <div>
                 <div>
                     <p><strong>Locality Name</strong></p>
                 </div>
                 <div class="extra-content">
                     <p>{{ $property->locality_name }}</p>
                 </div>
             </div>
         </div>
     </div>
     <div class="  ">
         <div class="viewbedrooms">
             <div>
                 <img src="{{ url('public/assets/images/Layer_1GIS Id.svg') }}" class="img-fluid">
             </div>
             <div>
                 <div>
                     <p><strong>Address</strong></p>
                 </div>
                 <div class="extra-content">
                     <p>{{ $property->street_details }}</p>
                 </div>
             </div>
         </div>
     </div>
 </div>
