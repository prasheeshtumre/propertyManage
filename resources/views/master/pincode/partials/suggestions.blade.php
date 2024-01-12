

@foreach ($suggestions as $key=>$suggestion)
<div class="form-check">
  <input class="form-check-input" 
    type="checkbox" 
    name="pincodes[]"
    value="{{ $suggestion->id }}" 
    id="pinSuggestion{{$key}}"
    
   >
  <label class="form-check-label" for="pinSuggestion{{$key}}">
    {{ $suggestion->pincode }}
  </label>
</div>
   
@endforeach

@if($suggestions->hasMorePages())
    <div id="load-more-container" class="lmc-{{ $suggestions->currentPage() + 1 }}">
        <button id="load-more" class="load-more-btn " type="button" data-next-page="{{ $suggestions->currentPage() + 1 }}">Load More</button>
    </div>
@endif