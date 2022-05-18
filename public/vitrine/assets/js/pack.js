$().ready(function() {

    $(document).on("click","#btnName",function(e){
        $("#blog1").hide();
        $("#blog2").show();
    });


    $("#name").on('keyup', function() {
        $("#printed-name").html($("#name").val());
        $("#custom-pack-form").append('<input type="hidden" name="name"value="' + $("#name").val() + '">');

    });
    $("input[name=category]").on('change', function() {
        var radioValue = $("input[name=category]:checked").val();
        console.log(radioValue);
        if (radioValue == "")
            return false;
        $.ajax({
            type: 'get',
            url: '/pack-products/' + radioValue,
            success: function(resp) {
                $("#Gridproduct").empty();
                $("#products-div").show();
                $.each(resp, function(_key, value) {
                    if ($('#printed-products img[id="' + value.id + '"]').length == 0) {
                        ph='<div class="col-4 mt-30 image-checkbox"><img src="' + window.location.origin + '/img/produit/m/' + value.image + '"id="' + value.id + '" style="height:80%;width:65%;border-radius:10px;" class="zoom img-responsive img-border"><br><p style="height:50px;width:150px;">'+ value.nom +'</p>';

                        ph+='<input type="checkbox" id="' + value.image + '" name="image[]" value="' + value.id + '"/></div>';
        
                        $("#Gridproduct").append(ph);
                    } else
                        $("#Gridproduct").append('<div class="col-4 mt-30 image-checkbox image-checkbox-checked"><img src="' + window.location.origin + '/img/produit/s/' + value.image + '"id="' + value.id + '" style="height:70%;width:60%;border-radius:10px;" class="zoom img-responsive img-border img-border-checked"><br><p style="height:80px;width:150px;">'+ value.nom +'</p><br><input type="checkbox"id="' + value.image + '" checked="true" name="image[]" value="' + value.id + '" /></div>');
                });
                //test2();
                test();
            },
            error: function() {
                alert("Error");
            }
        });
    });
});



function test() {
    $(document).ready(function() {
        $(".image-checkbox").each(function() {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
                $(this).find('img').first().addClass('img-border-checked');
            } else {
                $(this).removeClass('image-checkbox-checked');
                $(this).find('img').first().removeClass('img-border-checked');
            }
        });
        // sync the state to the input product in pack
        $(".image-checkbox").on("click", function(e) {
            $(this).toggleClass('image-checkbox-checked');
            $(this).find('img').first().toggleClass('img-border-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            if ($checkbox.prop('checked') == false) {
                $("#zoom-image").empty();
                $("#zoom-image").append('<img style="height:250;width:250px;border-radius:20px;display:none;"class="img-responsive" src="' + window.location.origin + '/img/produit/s/' + $checkbox.attr('id') + '"id="' + $checkbox.val() + '-zoom">');
                $("#" + $checkbox.val() + "-zoom").animate({ width: "0px", height: "0px" }, 400);
                // $("#" + $checkbox.val() + "-zoom").fadeOut(400, function() { $(this).remove(); });
                $checkbox.prop('checked', true);
                $("#printed-products").append('<img style="height:50px;width:50px;border-radius:10px;"img-responsive" src="' + window.location.origin + '/img/produit/s/' + $checkbox.attr('id') + '"id="' + $checkbox.val() + '">');
                $("#custom-pack-form").append('<input type="hidden" name="products[]" value="' + $checkbox.val() + '" id="products">');
                if ($('#printed-products img').length > 2)
                    $('#order').attr("onclick", "document.getElementById('custom-pack-form').submit();").show();
            } else {
                $checkbox.prop('checked', false);
                $('#printed-products img[id="' + $checkbox.val() + '"]').first().remove();
                $('input[type="hidden"][value="' + $checkbox.val() + '"]').remove();
                if ($('#printed-products img').length < 3)
                    $('#order').hide().removeAttr("onclick");
            }
            e.preventDefault();

        });
    });
}
