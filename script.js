var swiper = new Swiper(".mySwiper", {
  autoplay:{
    delay:4000,
    disableOnInteraction:false,
  },
  effect:"fade",
  loop:true,
  
  pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
});