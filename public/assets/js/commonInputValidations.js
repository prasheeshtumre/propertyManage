/*
   File: commonInputValidations.js
   Description: This JavaScript file contains the code for validating inputs.
   Author: 
   Date: Nov 27, 2023
   
   -- Instructions --
   1. numeric validation:
      - Use the allowOnlyNumerics() function to break down a single GIS ID into its constituent parts.

*/

// JavaScript code starts here...

    $(document).on('input', '.is-contact-no', function() {
        let currentEle = $(this);
        currentEle.val($(this).val().replace(/[^0-9,]/g, '').replace(/(\,,*?)\,,*/g, '$1'));
        let regex = /^(\d{10},)*\d{10}$/;
        (regex.test(currentEle.val())) ? (currentEle.val(), currentEle.removeClass('is-invalid')) : currentEle
            .addClass('');
    });

    $(document).on('input', '.is-pincode', function() {
        let currentEle = $(this);
        let inputValue = currentEle.val();
        
        // Allow only digits and limit to 6 digits
        let cleanedValue = inputValue.replace(/[^0-9]/g, '').slice(0, 6);
        
        currentEle.val(cleanedValue);
    });

    //validate integer input values 
    $(document).on('input', '.is-numeric', function() {
        let currentEle = $(this);
        currentEle.val($(this).val().replace(/[^0-9]/g, ''));
    });

    //validate user name input values 
    $(document).on('input', '.is-person-name', function() {
        let currentEle = $(this);
        currentEle.val($(this).val()
        .replace(/[^a-zA-Z,.\s]/g, '')
        .replace(/(\,,*?)\,,*/g, '$1')
        .replace(/(\..*?)\..*/g, '$1')
        .replace(/(\s\s*?)\s\s*/g, '$1'));
    });


// JavaScript code ends here...