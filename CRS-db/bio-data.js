import "https://flackr.github.io/scroll-timeline/dist/scroll-timeline.js";

const projectBtns = Array.from(document.querySelectorAll(".project-btn"));
const imageCards = Array.from(document.querySelectorAll(".image-card"));
const Hero_Section = document.querySelector(".hero-section");
const Contact_Section = document.querySelector(".contact-section");
//   ========================================
//  Project-Image Functionality
//  =========================================

projectBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (btn.classList.contains("project-active-btn")) {
      btn.classList.remove("project-active-btn");
      imageCards.forEach((card) => card.classList.remove("hide"));
    } else {
      projectBtns.forEach((P_btn) =>
        P_btn.classList.remove("project-active-btn")
      );
      btn.classList.add("project-active-btn");
      imageCards.forEach((imgCard) => imgCard.classList.add("hide"));
      const selectNo = btn.dataset.btnNo;
      // console.log(selectNo);
      const selectedCards = Array.from(
        document.querySelectorAll(`.image-${selectNo}`)
      );
      selectedCards.forEach((card) => card.classList.remove("hide"));
    }
  });
});

//   ========================================
//  Sroll Top Button          No need of this shit code
//  =========================================
// function scrollToTop() {
//   Hero_Section.scrollIntoView({ behavior: "smooth" });
// }
// scrollTopBtn.addEventListener("click", scrollToTop);

// =============================================
// Swiper code
// =============================================

new Swiper(".mySwiper", {
  slidesPerView: 2,
  spaceBetween: 0,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
});

const swiperMQFunction = (event) => {
  if (event.matches) {
    new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
    });
  }
  // else {
  // continue;
  // }
};

const swiperMediaQuery = window.matchMedia("(max-width:1000px)");

swiperMQFunction(swiperMediaQuery);

swiperMediaQuery.addEventListener("change", swiperMQFunction);

// =============================================
// Stats Animation
// =============================================

const statsVar = document.querySelectorAll(".stats-no");
const equalIntervals = 20;
function statsFunctionMain() {
  statsVar.forEach((currentStat) => {
    let statsUpdateFunction = function () {
      let statsData = parseInt(currentStat.dataset.statsNo);
      let currentStatData = Math.trunc(parseInt(currentStat.innerText));
      if (currentStatData < statsData) {
        currentStat.innerText =
          currentStatData + statsData / equalIntervals + "+";
        setTimeout(statsUpdateFunction, 60);
      } else {
        return;
      }
    };
    statsUpdateFunction();
  });
}

let statsSection = document.querySelector(".stats-section");

const statsOptions = {
  threshold: 0.5,
  rootMargin: "0px 0px 10px 0px",
};
let statsObserver = new IntersectionObserver(function (entries, statsObserver) {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      return;
    } else {
      statsFunctionMain();
      statsObserver.unobserve(entry.target);
    }
  });
}, statsOptions);

statsObserver.observe(statsSection);

// ================ Responsive Navbar ==============

const hamburger_btn = document.querySelector(".hamburger-btn");
const sideNavbar = document.querySelector(".side-navbar");

hamburger_btn.addEventListener("click", () => {
  sideNavbar.classList.toggle("show-side-navbar");

  hamburger_btn.classList.toggle("opened");
  hamburger_btn.setAttribute(
    "aria-expanded",
    hamburger_btn.classList.contains("opened")
  );
});

// ==============================================
// IntersectionObserver (Bio-Section)
// ==============================================

const bioHeading = document.getElementById("bio-heading-div-id");
const allChild = bioHeading.children;
const newAllChild = Array.from(allChild);
const noOfChild = newAllChild.length;

const scrollOptions = {
  threshold: 0.25,
};
let onScrollObserver = new IntersectionObserver(function (
  entries,
  onScrollObserver
) {
  entries.forEach((entry) => {
    if (!entry.isIntersecting) {
      return;
    } else {
      // console.log("here it intersect");
      triggerOnScroll(newAllChild);
      onScrollObserver.unobserve(entry.target);
    }
  });
},
scrollOptions);

onScrollObserver.observe(bioHeading);

function triggerOnScroll(list) {
  list.forEach((child, index) => {
    setTimeout(() => {
      child.classList.add("appear");
    }, 800 * index);
  });
}

// ==============================================
// IntersectionObserver (Hero-Section)
// ==============================================

let HeroOnScrollObserver = new IntersectionObserver(
  function (entries, HeroOnScrollObserver) {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      } else {
        setTimeout(() => {
          Hero_Section.classList.add("appear");
        }, 800);
        // console.log("Hero onSroll");
        HeroOnScrollObserver.unobserve(entry.target);
      }
    });
  },
  {
    threshold: 0.5,
  }
);

HeroOnScrollObserver.observe(Hero_Section);

// ==============================================
// IntersectionObserver (Contact-Section)
// ==============================================

let ContactOnScrollObserver = new IntersectionObserver(
  function (entries, ContactOnScrollObserver) {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        return;
      } else {
        Contact_Section.classList.add("appear");
        // console.log("Contact onSroll");
        ContactOnScrollObserver.unobserve(entry.target);
      }
    });
  },
  {
    threshold: 0.4,
  }
);

ContactOnScrollObserver.observe(Contact_Section);

// ================================
// Scroll scrollTracker
// ================================

const scrollTracker = document.querySelector(".scroll-tracker");

const scrollTrackingTimeline = new ScrollTimeline({
  source: document.scrollingElement,
  // orientation: block,
  scrollOffsets: [CSS.percent(0), CSS.percent(100)],
});

scrollTracker.animate(
  {
    transform: ["scaleX(0)", "scaleX(1)"],
  },
  {
    duration: 1,
    timeline: scrollTrackingTimeline,
  }
);

// ================================
// Popup Modal
// ================================

const backsideModal = document.querySelector(".modal-backside");
console.log(backsideModal);
const modal = document.querySelector("#modal");
const cross_btn = document.querySelector(".modal-cross");
const modal_btn = Array.from(document.getElementsByClassName("modal-btn"));

modal_btn.forEach((btn) => {
  btn.addEventListener("click", closeModal);
});
cross_btn.addEventListener("click", closeModal);
function openModal() {
  backsideModal.style.display = "flex";
}
function closeModal() {
  backsideModal.style.display = "none";
}
// sessionStorage.clickcount = 0;
if (sessionStorage.clickcount != 1) {
  sessionStorage.clickcount = 1;
  setTimeout(openModal, 2500);
} else {
  console.log("Modal once appeared !");
}
// setTimeout(openModal, 2500);

// ================================
// Typing Animations
// ================================

new Typed("#typing-animation", {
  strings: ["Games", "Gaming Accessories", "Gaming Machines", "Graphic Cards"],
  // typing speed
  typeSpeed: 60,
  // time before typing starts
  startDelay: 1200,
  // backspacing speed
  backSpeed: 40,
  // time before backspacing
  backDelay: 1100,
  delaySpeed: 300,
  loop: true,
});
