/**
 * Theme Name: holmesportfolio
 * Theme URI: https://holmesportfolio.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://holmesportfolio.co.uk/
 * Requires PHP: 7
 * Tested up to: 6.5
 * Version: 4.3
 * License: holmesportfolio Commercial License
 * License URI: https://holmesportfolio.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

document.addEventListener("DOMContentLoaded", function () {
  var scrollTopButton = document.getElementById("scrollTop");

  function handleScroll() {
    if (
      document.body.scrollTop > 40 ||
      document.documentElement.scrollTop > 40
    ) {
      scrollTopButton.style.display = "block";
    } else {
      scrollTopButton.style.display = "none";
    }
  }

  window.addEventListener("scroll", handleScroll);

  scrollTopButton.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  window.scrollTo(0, 0);
});

// has pop-up menu items
jQuery(document).ready(function ($) {
  var menuItems = $("#navbar .menu-item");

  menuItems.each(function () {
    var menuItem = $(this);
    var subMenu = menuItem.find(".sub-menu");

    if (subMenu.length) {
      menuItem.find("> a").attr("aria-haspopup", "true");

      menuItem.on("click", function () {
        subMenu.toggleClass("visible");

        if (subMenu.hasClass("visible")) {
          menuItem.find("> a").attr("aria-expanded", "true");
        } else {
          menuItem.find("> a").attr("aria-expanded", "false");
        }
      });
    }
  });
});

// woocomerce
jQuery(document).ready(function ($) {
  // Check if body has 'woocommerce' class
  if ($("body").hasClass("woocommerce")) {
    // refresh the mini cart
    function refreshMiniCart() {
      $(".woocommerce-mini-cart-container").load(
        location.href + " .woocommerce-mini-cart-container"
      );
    }

    // added to cart event
    $(document.body).on("added_to_cart", function () {
      refreshMiniCart();
    });

    // removed from cart event
    $(document.body).on("removed_from_cart", function () {
      refreshMiniCart();
    });
  }
});
//END OF holmes-artwork - woocommerce shop

document.addEventListener("DOMContentLoaded", function () {
  // Hide the java-error-message div
  var javaErrorMessage = document.querySelector(".java-error-message");
  if (javaErrorMessage) {
    javaErrorMessage.style.display = "none";
    javaErrorMessage.setAttribute("aria-hidden", "true");
  }
});

//slide images into page - effect

document.addEventListener("DOMContentLoaded", function () {
  const imagesRight = document.querySelectorAll(".hw-slide-hidden-right");
  const imagesLeft = document.querySelectorAll(".hw-slide-hidden-left");
  const imagesdown = document.querySelectorAll(".hw-slide-hidden-down");

  function animateImages(images, animationClass) {
    images.forEach((image) => {
      image.classList.add(animationClass);
    });
  }

  // animation classes
  animateImages(imagesRight, "hw-slide-right");
  animateImages(imagesLeft, "hw-slide-left");
  animateImages(imagesdown, "hw-slide-down");
});

// slideshows

function initSlideshows() {
  let slideshows = document.querySelectorAll(".slideshow-container");
  slideshows.forEach((slideshow, index) => {
    let slideIndex = 0;
    let slides = slideshow.getElementsByClassName("hwSlides");
    let dotContainer = slideshow.querySelector(".dot-container");
    let autoSlideTimeout;

    for (let i = 0; i < slides.length; i++) {
      let dot = document.createElement("span");
      dot.classList.add("dot");
      dot.addEventListener("click", () =>
        showSlidesManual((slideIndex = i + 1))
      );
      dotContainer.appendChild(dot);
    }

    if (slides.length > 0) {
      showSlides();
    }

    function showSlides() {
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      let dots = dotContainer.getElementsByClassName("dot");
      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1;
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].classList.add("active");
      autoSlideTimeout = setTimeout(showSlides, 3000);
    }

    function plusSlides(n) {
      showSlidesManual((slideIndex += n));
    }

    function showSlidesManual(n) {
      clearTimeout(autoSlideTimeout);
      if (n > slides.length) {
        slideIndex = 1;
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      let dots = dotContainer.getElementsByClassName("dot");
      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].classList.add("active");
    }

    let prevButton = slideshow.querySelector(".prevhw");
    let nextButton = slideshow.querySelector(".nexthw");
    if (prevButton && nextButton) {
      prevButton.addEventListener("click", () => plusSlides(-1));
      nextButton.addEventListener("click", () => plusSlides(1));
    }

    slideshow.addEventListener("keydown", function (event) {
      if (event.key === "ArrowLeft") {
        plusSlides(-1);
      } else if (event.key === "ArrowRight") {
        plusSlides(1);
      }
    });
  });
}

initSlideshows();
