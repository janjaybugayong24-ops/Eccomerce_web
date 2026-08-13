$(document).ready(function () {
    loadcart();
    loadwishlist();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function loadcart() {
        $.ajax({
            method: 'GET',
            url: '/load-cart-data',
            success: function (response) {
                $('.cart-count').html(response.count);
            }
        });
    }

    function loadwishlist() {
        $.ajax({
            method: 'GET',
            url: '/load-wishlist-data',
            success: function (response) {
                $('.wishlist-count').html(response.count);
            }
        });
    }

    $('.addToCartBtn').click(function (e) {
        e.preventDefault();

        var $product_id = $(this).closest('.product_data').find('.product_id').val();
        
        var $product_quantity = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: 'POST',
            url: '/add-to-cart',
            data: {
                'product_id': $product_id,
                'product_quantity': $product_quantity
            },
            success: function (response) {
                loadcart();
                swal(response.status);
            }
        });

    });



    $('.addToWishlistBtn').click(function (e) {
        e.preventDefault();

        var $product_id = $(this).closest('.product_data').find('.product_id').val();

        $.ajax({
            method: 'POST',
            url: '/add-to-wishlist',
            data: {
                'product_id': $product_id
            },
            success: function (response) {
                loadwishlist();
                swal(response.status);
            }
        });

    });


    //  $('.delete-wishlist-item').click(function (e) {
    $(document).on("click", ".delete-wishlist-item", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();

        $.ajax({
            method: 'POST',
            url: '/delete-wishlist-item',
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                // window.location.reload();
                loadwishlist();
                $(".WishlistItems").load(location.href + " .WishlistItems");
                swal("", response.status, "success");
            }
        });

    });

    //$('.delete-cart-item').click(function (e) {

    $(document).on("click", ".delete-cart-item", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();

        $.ajax({
            method: 'POST',
            url: '/delete-cart-item',
            data: {
                'product_id': product_id,
            },
            success: function (response) {
                // window.location.reload();
                loadcart();
                $(".CartItems").load(location.href + " .CartItems");
                swal("", response.status, "success");
            }
        });

    });


    // $('.increment-btn').click(function (e) {
    $(document).on("click", ".increment-btn", function (e) {
        e.preventDefault();
        var increment_value = $(this).closest('.product_data').find('.qty-input').val();
        var check_value = parseInt(increment_value, 10);

        check_value = isNaN(check_value) ? 0 : check_value;

        if (check_value < 10) {
            check_value++;
            $(this).closest('.product_data').find('.qty-input').val(check_value);
        }
    });


    // $('.decrement-btn').click(function (e) {
    $(document).on("click", ".decrement-btn", function (e) {
        e.preventDefault();

        var decrement_value = $(this).closest('.product_data').find('.qty-input').val();
        var check_value = parseInt(decrement_value, 10);

        check_value = isNaN(check_value) ? 0 : check_value;

        if (check_value > 1) {
            check_value--;
            $(this).closest('.product_data').find('.qty-input').val(check_value);
        }
    });





    // $('.change_quantity').click(function (e) {

    $(document).on("click", ".change_quantity", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: 'POST',
            url: '/update-cart-item',
            data: {
                'product_id': product_id,
                'product_quantity': quantity
            },
            success: function (response) {
                $(".CartItems").load(location.href + " .CartItems");
                // window.location.reload();
            }
        });
    });
});
