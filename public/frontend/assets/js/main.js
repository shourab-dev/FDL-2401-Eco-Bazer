$(document).ready(function () {
  // Product Filtering Start
  var $productFilter = $('.productFilter').isotope({
    itemSelector: '.cart',
    layoutMode: 'fitRows'   
  });

  $('.pdNavButtons').on('click', function() {
    var selector = $(this).attr('data-filter');

    $productFilter.isotope({ filter: selector });
    $('.pdNavButtons').removeClass('active');
    $(this).addClass('active');
  });
    // Product Filtering End

  // Toggle submenu and icon
  $(".shopCollapse").click(function () {
    let submenu = $(this).find(".shopOpen");
    let iconElement = $(this).find("iconify-icon");
    submenu.toggleClass("active");
    iconElement.attr(
      "icon",
      iconElement.attr("icon") === "ep:arrow-down-bold"
        ? "ep:arrow-right-bold"
        : "ep:arrow-down-bold"
    );
  });

  // Password visibility toggle
  $(".pasToggl").click(function () {
    let inputField = $(this).siblings("input");
    let isPassword = inputField.attr("type") === "password";
    inputField.attr("type", isPassword ? "text" : "password");
    $(this)
      .find("iconify-icon")
      .attr("icon", isPassword ? "ion:eye-outline" : "ion:eye-off-outline");
  });

  // Switch between Register and Sign-In
  $(".RegisterBtn").click(function () {
    $(".Register").removeClass("d-none");
    $(".signIn").addClass("d-none");
  });
  $(".signInBtn").click(function () {
    $(".Register").addClass("d-none");
    $(".signIn").removeClass("d-none");
  });

  // Mobile search box toggle
  $(".searchMob").click(function () {
    $(".searchBoxMobile").addClass("active");
    $(".bottomNavBar").addClass("d-none");
  });
  $(".closeBtnSearch").click(function () {
    $(".searchBoxMobile").removeClass("active");
    $(".bottomNavBar").removeClass("d-none");
  });

  // *Swipper
  var bannerSwiper = new Swiper("#banner .mySwiper", {
    pagination: {
      el: "#banner .swiper-pagination",
      dynamicBullets: true,
    },
    loop: true,
    autoplay: {
      delay: 3000,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
   },
  });
  var swiper = new Swiper("#featureProduct .mySwiper", {
    slidesPerView: 5,
    spaceBetween: 10,
    freeMode: true,
    speed: 11000,
    pagination: {
       el: ".swiper-pagination",
       clickable: true,
    },
    autoplay: {
      delay: 5000,
    },
    navigation: {
       nextEl: '.swiper-button-next',
       prevEl: '.swiper-button-prev',
    },
    breakpoints:{
      991: {
        slidesPerView: 5,
      },
      450:{
        slidesPerView: 2,
      },
      414:{
        slidesPerView: 2,
      },
      300:{
        slidesPerView: 1,
      },
    }
 });


  // *  popup close
  $(".close-btn").click(function () {
    $(".popup").addClass("d-none");
  });

  $(window).on("load", function () {
    setTimeout(function () {
      $(".popup").removeClass("d-none");
      $(".popup").addClass("d-block");
    }, 2000);
  });

  // countdown Start Here
  $('.countTime').countdown('2024/12/26', function(event) {
    $('#days').html(event.strftime('%D'));  
    $('#hours').html(event.strftime('%H'));   
    $('#mins').html(event.strftime('%M'));    
    $('#secs').html(event.strftime('%S'));    
  });
  

  // video start here
  new VenoBox({
    selector: '.videoHome',
});
});
