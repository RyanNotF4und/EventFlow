$(function(){

    $('#mobile > #menu').click(function(){
        $('header > div > #mobile > ul').slideToggle();
    })

    $('#mobile > #search').click(function(){
        $('header > form#mobile > input').slideToggle();
    })

    $('#user').click(function(){
        $('#userUl').slideToggle();
    })


})