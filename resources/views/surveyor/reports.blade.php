<table class="table table-striped dt-responsive nowrap data-table" style="width:100%">
     <thead>
        <tr class="table-info">
            <th width="5%">S.No</th>
            <th> Name</th>
            <th>Mobile Number</th>
            <th>Today Surveyed</th>
            <th>This week Surveyed</th>
            <th>This month Surveyed</th>
            <th>Total Surveyed</th>
        </tr>
    <thead>
 <tbody>
	     @forelse($surveyors as $survey)
	     @php
	        $gettotalsurvey = App\Models\Property::where('created_by', $survey->id)->count(); 
	        
	        $getTodaySurvey = App\Models\Property::where('created_by', $survey->id)->whereDate('created_at',\Illuminate\Support\Carbon::today())->count(); 
	        
	        $startOfWeek = \Illuminate\Support\Carbon::now()->startOfWeek();
            $endOfWeek = \Illuminate\Support\Carbon::now()->endOfWeek();
            $getWeekSurvey = App\Models\Property::where('created_by', $survey->id)->whereBetween('created_at',[$startOfWeek,$endOfWeek])->count();
            
            $startOfMonth = \Illuminate\Support\Carbon::now()->startOfMonth();
            $endOfMonth = \Illuminate\Support\Carbon::now()->endOfMonth();
            
            $getMonthSurvey = App\Models\Property::where('created_by', $survey->id)->whereBetween('created_at',[$startOfMonth,$endOfMonth])->count(); 
         @endphp
	     <tr>
	         <td>{{$loop->iteration}}</td>
	         <td><a href="{{route('admin.surveyor.filter-data',$survey->id)}}">{{$survey->name}}</a></td>
	         <td>{{$survey->mobile}}</td>
	         <td>
                <a id="property-url" href="{{ route('admin.surveyor.filter-data',[$survey->id,'today']) }}">
                    {{$getTodaySurvey}}
                </a>
             </td>
	         <td>
	             <a id="property-url" href="{{ route('admin.surveyor.filter-data',[$survey->id,'week']) }}">
                    {{$getWeekSurvey}}
                </a>
             </td>
	         <td>
                <a id="property-url" href="{{ route('admin.surveyor.filter-data',[$survey->id,'month']) }}">
                    {{$getMonthSurvey}}
                </a>
             </td>
	         
            <td>
                <a id="property-url" href="{{ route('admin.surveyor.filter-data',[$survey->id]) }}">
                    {{$gettotalsurvey}}
                </a>
            </td>
	     </tr>
	     @empty
	     <tr>
	         <td colspan="7" class="text-center">Data not found</td>
	     </tr>
	     @endforelse
	 </tbody> 
 </table>
 <div id="pagination">
    {{ $surveyors->links('pagination::bootstrap-4',['secure' => true]) }}
</div>