(function($) {
    $.fn.searchSuggestions = function() {
      // Your custom function implementation here
      // This function will be applied to each element in the jQuery selector
      return this.each(function() {
        // Perform your custom logic on each selected element
        // Example: console.log($(this).val());
        console.log($(this).val());
      });
      
    };
  })(jQuery);
  