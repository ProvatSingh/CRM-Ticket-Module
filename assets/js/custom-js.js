
// ====== Hamburger Menu Click Js ====== //

const hamburger = document.getElementById("hamburger_menu"); 
hamburger.addEventListener('click', function() { 
    var element1 = document.getElementById("collapse_menu");
    var element2 = document.getElementById("menu_overlay");
    var element3 = document.getElementById("body");
    element1.classList.toggle("collapse-menu-open");
    element2.classList.toggle("collapse-overlay");
    element3.classList.toggle("overflow-hidden");
});

// ====== Menu Overlay Click Js ====== //

const menuoverlay = document.getElementById("menu_overlay"); 
menuoverlay.addEventListener('click', function() { 
    var element4 = document.getElementById("collapse_menu");
    var element5 = document.getElementById("menu_overlay");
    var element6 = document.getElementById("body");
    element4.classList.toggle("collapse-menu-open");
    element5.classList.toggle("collapse-overlay");
    element6.classList.toggle("overflow-hidden");
});

// ====== Menu Close Click Js ====== //

const menuclose = document.getElementById("colapse_close"); 
menuclose.addEventListener('click', function() { 
    var element7 = document.getElementById("collapse_menu");
    var element8 = document.getElementById("menu_overlay");
    var element9 = document.getElementById("body");
    element7.classList.toggle("collapse-menu-open");
    element8.classList.toggle("collapse-overlay");
    element9.classList.toggle("overflow-hidden");
});




// ====== OnScroll Header Class Add and Remove Js ====== //

let scrollpos = window.scrollY
const header = document.querySelector("header")
const header_height = header.offsetHeight

const add_class_on_scroll = () => header.classList.add("dark")
const remove_class_on_scroll = () => header.classList.remove("dark")

window.addEventListener('scroll', function() { 
    scrollpos = window.scrollY;

    if (scrollpos >= header_height) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

    // console.log(scrollpos)
    
})



/// ================= Home Page Game Library Slider

var doorsteploan = new Swiper('#doorstep-loan-slider', {

    slidesPerView: 1,
    spaceBetween: 30,
    pagination: false,
    loop: true,
    // autoHeight: true, 
    preventClicks: false,
    preventClicksPropagation: false,
    shortSwipes: false,

    // autoplay: {
    //     delay: 2000,
    //     disableOnInteraction: false,
    // },

    navigation: {
        nextEl: '.doorstep-loan-next',
        prevEl: '.doorstep-loan-prev',
    },

});


// =======================

