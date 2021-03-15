function manage_cart(pid, type) {
    console.log(type);
    // var qty = jQuery("#qty").val();
    // // jQuery("#qty").reset();
    // if (!qty) {
    //     qty = 1;
    // }
    jQuery.ajax({
        url: 'manage_cart.php',
        type: 'post',
        data: 'pid=' + pid + '&qty=' + 1 + '&type=' + type,
        // data:'pid='+pid+'&type='+type,

        success: function(result) {
            // console.log(result);
            // if (type == 'remove') {
            //     window.location.href = 'index';
            // }
            // if (type == 'add') {
            //     window.location.href = 'index';
            // }
            var mydata = JSON.parse(result);


            // console.log(mydata.count);
            // console.log(mydata.content);

            console.log(mydata.cart);

            jQuery('#cart').html(mydata.cart);
            jQuery('#items').html(mydata.content);
            jQuery('#cart_end').html(mydata.cart_end);
            // document.getElementById("cform").reset();

        }
    })
}




$(document).ready(function() {

    load_data();

    function load_data(query) {
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                query: query
            },
            success: function(data) {
                $('#result').html(data);
            }
        });
    }

    $('#search_text').keyup(function() {
        var search = $(this).val();
        if (search != '') {
            load_data(search);
        } else {
            load_data();
        }
    });


    function load_data(query) {
        $.ajax({
            url: "fetch.php",
            method: "post",
            data: {
                query: query
            },
            success: function(data) {
                $('#result').html(data);
            }
        });
    }

    $('#search_text1').keyup(function() {
        var search = $(this).val();
        if (search != '') {
            load_data(search);
        } else {
            load_data();
        }
    });



    $(".product_check1").click(function() {
        var cat_id = jQuery("#cat_val1").val();
        console.log(cat_id);
        $.ajax({
            url: 'cat_fetch.php',
            method: 'POST',
            data: {
                cat_id: cat_id
            },
            success: function(response) {
                $("#result").html(response);

            }
        });
    });

    $(".product_check").click(function() {
        var cat_id = jQuery("#cat_val").val();
        console.log(cat_id);
        $.ajax({
            url: 'cat_fetch.php',
            method: 'POST',
            data: {
                cat_id: cat_id
            },
            success: function(response) {
                $("#result").html(response);

            }
        });
    });


    // $('.img-thumbnail').click(function() {
    //     console.log('hi');
    //     $('#overlay')
    //     .css({backgroundImage: `url(${this.src})`})
    //     .addClass('open')
    //     .one('click', function() { $(this).removeClass('open'); });
    // });
});

$(document).ready(function() {
    $(".category_check").click(function() {
        var action = 'data';
        var category  = get_filter_text('category');
        $.ajax({
            url: 'category_fetch.php',
            method: 'POST',
            data: {
                action: action,
                category : category
            },
            success: function(response) {
                $("#result").html(response);
            }

        });
    });

    $(".category_check1").click(function() {
        var action = 'data';
        var category  = get_filter_text('category');
        $.ajax({
            url: 'category_fetch.php',
            method: 'POST',
            data: {
                action: action,
                category : category
            },
            success: function(response) {
                $("#result").html(response);
            }

        });
    });



    function get_filter_text(text_id) {
        console.log(text_id);
        var filterData = [];
        $('#' + text_id + ':checked').each(function() {
            filterData.push($(this).val());
        });

        return filterData;
    }
});