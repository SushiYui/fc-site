resources/js/live.js
// import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';

// import Swiper from 'swiper/bundle';
// import 'swiper/css/bundle';

document.addEventListener('DOMContentLoaded', () => {
  const swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 20,
    loop: false,
    modules: [Swiper.Navigation],
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
});



