
$(document).ready(function (){
 $('.razorpay_btn').click(function (e) {
 e.preventDefault();
 
 var fullname = $('.fullname').val();
 var email = $('.email').val();
 var phone = $('.phone').val();
 var city = $('.city').val();
 var province = $('.province').val();
 var address = $('.main_address').val();
 var postal_code = $('.postal_code').val();
 var message = $('.message').val();

 if (!fullname) {
    var fname_error = 'Full name is required';
    $('#fname_error').html('');
    $('#fname_error').html(fname_error);
 }else{
      fname_error = '';
      $('#fname_error').html('');
 }

 if (!email) {
    var email_error = 'Email is required';
    $('#email_error').html('');
    $('#email_error').html(email_error);
 }else{
      email_error = '';
      $('#email_error').html('');
 }

 if (!phone) {
    var phone_error = 'Phone # is required';
    $('#phone_error').html('');
    $('#phone_error').html(phone_error);
 }else{
     phone_error = '';
      $('#phone_error').html('');
 }

 if (!city) {
   var city_error = 'City is required';
    $('#city_error').html('');
    $('#city_error').html(city_error);
 }else{
     city_error = '';
      $('#city_error').html('');
 }

 if (!province) {
   var  province_error = 'Province is required';
    $('#province_error').html('');
    $('#province_error').html(province_error);
 }else{
     province_error = '';
      $('#province_error').html('');
 }

 if (!address) {
   var  address_error = 'Address is required';
    $('#address_error').html('');
    $('#address_error').html(address_error);
 }else{
     address_error = '';
      $('#address_error').html('');
 }

 if (!postal_code) {
    var postal_error = 'Postal code is required';
    $('#postal_error').html('');
    $('#postal_error').html(postal_error);
 }else{
     postal_error = '';
      $('#postal_error').html('');
 }

 if(fname_error != '' || email_error != '' || phone_error!= '' || city_error != '' || province_error != '' || address_error!= '' ||postal_error != '') {
    return false;

 }else{
    var data = {
     'fullname': fullname,
     'email': email,
     'phone' : phone,
     'city': city, 
     'province': province,
     'main_address' : address,
     'postal_code' : postal_code,
     'message' : message
    }

    $.ajax({
      method: "POST",
      url: "/proceed-to-pay",
      data: data,
      success: function(response) {
        alert(response.total_price);
      }
    });
    
 }

 });

});