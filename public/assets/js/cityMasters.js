$(document).on('click', '.choose-pincode-label', function(){
    $(this).toggleClass('active');
    $('#pincode').focus();
});

$(document).on('click', '#pincode', function(){
    togglePincodeLabel()
});

function togglePincodeLabel(){
    let pincodeLabel = $('.choose-pincode-label');
    let activeStatus = pincodeLabel.hasClass('active');
    (activeStatus) ? (pincodeLabel.removeClass('active')) : (pincodeLabel.addClass('active'));
}