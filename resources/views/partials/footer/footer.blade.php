     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://kit.fontawesome.com/yourcode.js"></script>  
     
    <!--JQUERY CDN LINK-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

     <!--JAVASCRIPT CDN LINKS FOR OWL CAROUSEL LIBRARIES-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

     <script src="{{asset('frontend/js/custom.js ')}}"></script>

     <script src="{{asset('frontend/js/checkout.js ')}}"></script>
      
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://code.jquery.com/ui/1.14.2/jquery-ui.js"></script>

      <script>

          $.ajaxSetup({
               headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });   

         var availableTags = [];
         $.ajax({
            method: "GET",
            url: "/product-list",
            success: function(response) {
               startAutoComplete(response);
            }
           })
         function startAutoComplete(availableTags){
         $( "#search_product" ).autocomplete({
            source: availableTags
         });
        }
      </script>

      @if(session('status'))
      <script>
         swal("{{session('status')}}")
      </script>
  @endif

@yield('scripts')

</body>
</html>