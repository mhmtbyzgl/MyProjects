function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("all_page").style.marginLeft = "250px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("all_page").style.marginLeft = "0";
  document.body.style.backgroundColor = "white";
}

// When the user scrolls down 20px from the top of the document, slide down the navbar
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar_scroll").style.top = "0";
  } else {
    document.getElementById("navbar_scroll").style.top = "-50px";
  }
}
