$(function () {
    $('#mobile > #options').click(function () {
        $('header > div > #mobile > ul').slideToggle();
    })
    $('#mobile > #search').click(function () {
        $('header > #form_mobile > input').slideToggle();
        $('#mobile > #search').css('display', 'none');
        $('#close').slideToggle();
    })
    $('#user').click(function () {
        $('#userUl').slideToggle();
    })
    //
    $('#close').click(function () {
        $('header > #form_mobile > input').slideToggle();
        $('#close').slideToggle();
        $('#mobile > #search').fadeIn();
    })
    $(window).resize(function () {
        if ($(window).width() >= 610) {
            $('#mobile_search_bar').css("display", "none");
            $('#close').css("display", "none");
        } else {
            $('#mobile_search_bar').css("display", "block");
            $('#close').css("display", "block");
            $('#search').css("display", "none");
        }
    });
})

