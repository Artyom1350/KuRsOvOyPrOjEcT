$('.calendar').hover(function(){
    $('.calendar').addClass('active');
},function(){
    $('.calendar').removeClass('active');
});
$('.myApplic').hover(function(){
    $('.myApplic').addClass('active');
},function(){
    $('.myApplic').removeClass('active');
});
$('.applicInProc').hover(function(){
    $('.applicInProc').addClass('active');
},function(){
    $('.applicInProc').removeClass('active');
});
$('.personArea').hover(function(){
    $('.personArea').addClass('active');
},function(){
    $('.personArea').removeClass('active');
});

function slideAppl(idElem){
    $(".application"+idElem+"-slide").slideToggle("slow");
}