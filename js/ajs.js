$(document).ready(function () {
    $("#menuinhead").hide();
    $("#menuihb").click(function () {
        $("#menuinhead").toggle();
    });
    $("#hipmenus").hide();
    $("#bhipmenus").click(function () {
        $("#hipmenus").toggle();
    });
    
    $('.c').hide();
    $(".a" + 1).show();
    $("#b" + 1).css("background", "#eee");

    for (var i = 0; i < 50; i += 1) {
        (function (j) {
            $("#b" + j).click(function () {
                $('.c').hide();
                $(".a" + j).show();
                $(".cd").css("background", "#fff");
                $("#b" + j).css("background", "#eee");
            });
        }(i));
    }
    
    
    $('.cc').hide();
    $(".aa" + 1).show();
    $("#bb" + 1).css("background", "#eee");

    for (var i = 0; i < 50; i += 1) {
        (function (j) {
            $("#bb" + j).click(function () {
                $('.cc').hide();
                $(".aa" + j).show();
                $(".ccd").css("background", "#fff");
                $("#bb" + j).css("background", "#eee");
            });
        }(i));
    }
$("#allchecked").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
   /* $('#allchecked:checkbox').change(function () {
        if ($(this).attr("checked"))
            $('input:checkbox').attr('checked', 'checked');
        else
            $('input:checkbox').removeAttr('checked');
    });*/
});
