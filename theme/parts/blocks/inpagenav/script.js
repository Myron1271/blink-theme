jQuery(function($){

    // Onpage navigation scroll to
    $("#onpage-nav .nav-link").not('.custom-action').click(function (e) {

        e.preventDefault();
        let section = $(this).attr('href').replace('#', '');

        $("html, body").animate({
            scrollTop: $('.menu-section[title="'+section+'"]').offset().top - ($('#onpage-nav').height() + 50)
        }, 10);
    });

    let navBar = $('#onpage-nav .navbar-nav'), dropdown = $('#onpage-nav .dropdown-menu'), itemsToHide = [];

    // Alleen uitvoeren als er een menubar aanwezig is op de pagina
    if($('#onpage-nav').length >= 1) {
        updateMenuBar();
        window.onresize = function () {
            updateMenuBar();
        };
    }

    //Bootstrap bug zorgt ervoor dat scrollspy de active class niet weghaalt van dropdowntoggle als je weer naar boven scrollt, dit fixt dat
    // window.onscroll = function () {
    //     if($('.menubar .dropdown-menu > .dropdown-item.active').length >= 1) {
    //         $('.menubar .dropdown-toggle').addClass('active');
    //     } else {
    //         $('.menubar .dropdown-toggle').removeClass('active');
    //     }
    // };

    // Voeg overflowende items toe aan overflow-menu
    function updateMenuBar() {

        itemsToHide = [];

        // Alle items zichtbaar maken, ivm eventuele eerdere .hide() calls
        $('#onpage-nav .navbar-nav .nav-item').show();

        var offsetTop = navBar.offset().top;
        $(dropdown).empty();

        // Check elk nav-item in de balk
        $(navBar).find('.nav-item').each(function (index) {

            if($(this).offset().top > offsetTop) {

                const text = $(this).find('.nav-link').text();
                const href = $(this).find('.nav-link').attr('href');
                dropdown.append('<a class="dropdown-item" href="'+href+'">'+text+'</a>');

                // Voeg items die weg moeten toe aan array, zodat we deze later in een keer kunnen hiden
                itemsToHide.push($(this));
            }
        });

        // Verstop de items in de itemsToHide array en andersom
        itemsToHide.forEach(function (item, index) {
            $(item).hide();
        });

        // Dropdown niet leeg? Laten zien.
        if (!$(dropdown).is(':empty')){
            $('#onpage-nav .dropdown').css('visibility', 'visible');
        } else {
            $('#onpage-nav .dropdown').css('visibility', 'hidden');
        }
    }


});
