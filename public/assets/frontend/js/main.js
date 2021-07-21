
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
   const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }



  /**
   * Easy on scroll event listener 
   */
   const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
   let navbarlinks = select('#navbar .scrollto', true)
   const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
        let section = select(navbarlink.hash)
      if (!section) return
        if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
          navbarlink.classList.add('active')
        } else {
          navbarlink.classList.remove('active')
        }
      })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)







  /**
   * Scrolls to an element with header offset
   */
   const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 16
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Header fixed top on scroll
   */
   let selectHeader = select('#header')
   if (selectHeader) {
    let headerOffset = selectHeader.offsetTop
    let nextElement = selectHeader.nextElementSibling
    const headerFixed = () => {
      if ((headerOffset - window.scrollY) <= 0) {
        selectHeader.classList.add('fixed-top')
        nextElement.classList.add('scrolled-offset')
      } else {
        selectHeader.classList.remove('fixed-top')
        nextElement.classList.remove('scrolled-offset')
      }
    }
    window.addEventListener('load', headerFixed)
    onscroll(document, headerFixed)
  }




// Our Strengths ===========
$(document).ready(function() {

  $('.donors').owlCarousel({
    loop:false,
    margin:20,
    nav:false,
    autoplay:true,
    autoplayTimeout:2000,
    responsive:{
      0:{
        items:2,
        nav:false,
        loop:true
      },
      600:{
        items:3,
        nav:false
      },
      1000:{
        items:5,
        nav:false,
        loop:true,
        dots:false
      }
    }
  })
});






// gallery =============
$(document).ready(function() {

  $('.gallery').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    autoplay:true,
    dots:false,
    slideSpeed: 200,
    paginationSpeed: 500,
    singleItem: true,
    navigation: true,
    scrollPerPage: true,
    autoplayTimeout:3000,
    responsive:{
      0:{
        items:2
      },
      600:{
        items:3
      },
      1000:{
        items:5
      }
    }
  })
});




// gallery =============
$(document).ready(function() {

  $('.gallery2').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    autoplay:true,
    dots:true,
    navigation: true,
    scrollPerPage: true,
    autoplayTimeout:6000,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:3
      },
      1000:{
        items:3
      }
    }
  })
});

// gallery =============
$(document).ready(function() {

  $('.gallery3').owlCarousel({
    loop:false,
    margin:0,
    nav:true,
    autoplay:false,
    dots:false,
    navigation: true,
    scrollPerPage: true,
    autoplayTimeout:6000,
    responsive:{
      0:{
        items:1
      },
      600:{
        items:1
      },
      1000:{
        items:1
      }
    }
  })
});




//accordion side bar
window.addEventListener('load', (event) => {
  var acc = document.getElementsByClassName("accordions");
var i;

for (i = 0; i < acc.length; i++) {
  
    acc[i].classList.toggle("active");
    var panel = acc[i].nextElementSibling;
    panel.style.display = "block";

}
});
var acc = document.getElementsByClassName("accordions");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}



// sub header
// var prevScrollpos = window.pageYOffset;
// window.onscroll = function() {
// var currentScrollPos = window.pageYOffset;
//   if (prevScrollpos > currentScrollPos) {
//     document.getElementById("subheader").style.top = "52px";
//   } else {
//     document.getElementById("subheader").style.top = "-50px";
//   }
//   prevScrollpos = currentScrollPos;
// }





 })()





 //side menu
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}

//mobile menu


function openNavs() {
  document.getElementById("m-sidenav").style.width = "250px";
}

function closeNavs() {
  document.getElementById("m-sidenav").style.width = "0";
}







//read more....
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("mores");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
