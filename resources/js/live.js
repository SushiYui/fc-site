import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';

// SwiperでNavigationモジュールを使うため登録
Swiper.use([Navigation]);


document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper(".mySwiper", {
        loop: true, // 無限ループ
        centeredSlides: true, // 中央揃え
        slidesPerView: "auto", // 自動幅（カードが見切れる）
        spaceBetween: 20, // スライド間の余白
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});

