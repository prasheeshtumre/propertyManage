

@foreach ($suggestions as $key=>$suggestion)
<div class="form-check">
  <label class="form-check-label" for="citySuggestion{{$key}}">
    {{ $suggestion->name }}
  </label>
</div>
   
@endforeach

@if($suggestions->hasMorePages())
    <div id="load-more-container">
        <button id="load-more" class="load-more-btn" type="button" data-next-page="{{ $suggestions->currentPage() + 1 }}">Load More</button>
    </div>
@endif