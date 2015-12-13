$(document).ready(function () {
    $("#second").hide();
    $("#third").hide();
    $("#forth").hide();
    //butttons at home

    $("#firstb").click(function () {
        $("#first").toggle();
    });
    $("#secondb").click(function () {
        $("#second").toggle();
    });
    $("#thirdb").click(function () {
        $("#third").toggle();
    });
    $("#forthb").click(function () {
        $("#forth").toggle();
    });
    $(".searchimg").mouseover(function(){
       $(this).css("opacity", "1.0"); 
    });
    $(".searchimg").mouseleave(function(){
       $(this).css("opacity", "0.8"); 
    });
});

