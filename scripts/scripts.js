$(function(){

    $('#mobile > #menu').click(function(){
        $('header > div > #mobile > ul').slideToggle();
    })

    $('#mobile > #search').click(function(){
        $('header > form#mobile > input').slideToggle();
        $('#mobile > #search').css('display','none');
    })

    $('#user').click(function(){
        $('#userUl').slideToggle();
    })
    $('#mobile > #search').click(function(){
        $('#close').slideToggle();
    })
    $('#close').click(function(){
        $('header > form#mobile > input').slideToggle();
        $('#close').slideToggle();
        $('#mobile > #search').fadeIn();
    })
})