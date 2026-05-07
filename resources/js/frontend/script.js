const navbar = document.getElementById("navbar");
const heroBg = document.getElementById("heroBg");

window.addEventListener("scroll", () => {
    if (window.scrollY > 60) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
    // Parallax
    if (heroBg)
        heroBg.style.transform = `translateY(${window.scrollY * 0.22}px)`;
});

/* ── Scroll reveal ── */
const revealEls = document.querySelectorAll(".reveal");
const revealObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add("visible"), i * 80);
                revealObserver.unobserve(entry.target);
            }
        });
    },
    {
        threshold: 0.12,
    },
);
revealEls.forEach((el) => revealObserver.observe(el));

/* ── Testimonial slider ── */
let currentSlide = 0;
const totalSlides = 3;
const track = document.getElementById("testiTrack");
const dots = document.querySelectorAll(".testi-dot");

function goToSlide(n) {
    currentSlide = n;
    track.style.transform = `translateX(-${n * 100}%)`;
    dots.forEach((d, i) => d.classList.toggle("active", i === n));
}

document.getElementById("nextBtn").addEventListener("click", () => {
    goToSlide((currentSlide + 1) % totalSlides);
});
document.getElementById("prevBtn").addEventListener("click", () => {
    goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
});

// Auto-slide every 5s
setInterval(() => goToSlide((currentSlide + 1) % totalSlides), 5000);

/* ── Video modal ── */
const modal = document.getElementById("videoModal");

function openVideo() {
    modal.style.display = "flex";
}

function closeVideo() {
    modal.style.display = "none";
}
document.getElementById("openVideoBtn").addEventListener("click", (e) => {
    e.preventDefault();
    openVideo();
});
document.getElementById("openVideoBtn2").addEventListener("click", openVideo);
modal.addEventListener("click", (e) => {
    if (e.target === modal) closeVideo();
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeVideo();
});
(function () {
    const form = document.getElementById("contactForm");
    const successBox = document.getElementById("formSuccess");
    const submitBtn = document.getElementById("submitBtn");

    // Required fields config
    const fields = [
        {
            id: "full_name",
            errId: "err_full_name",
            validate: (v) => v.trim().length >= 2,
        },
        {
            id: "email",
            errId: "err_email",
            validate: (v) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim()),
        },
        {
            id: "phone",
            errId: "err_phone",
            validate: (v) => v.trim().length >= 7,
        },
        {
            id: "subject",
            errId: "err_subject",
            validate: (v) => v.trim().length >= 2,
        },
        {
            id: "message",
            errId: "err_message",
            validate: (v) => v.trim().length >= 10,
        },
    ];

    // Live validation: clear error on input
    fields.forEach(({ id, errId }) => {
        const el = document.getElementById(id);
        if (!el) return;
        el.addEventListener("input", () => {
            el.classList.remove("error");
            document.getElementById(errId).classList.remove("show");
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        let valid = true;

        fields.forEach(({ id, errId, validate }) => {
            const el = document.getElementById(id);
            const err = document.getElementById(errId);
            if (!el) return;
            if (!validate(el.value)) {
                el.classList.add("error");
                err.classList.add("show");
                valid = false;
            } else {
                el.classList.remove("error");
                err.classList.remove("show");
            }
        });

        if (!valid) return;

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<i class="fas fa-circle-notch fa-spin"></i> Sending...';

        // ── Laravel AJAX submit ──
        const formData = new FormData(form);

        // fetch('{{ route('contact.store') }}', {
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
        //                 '{{ csrf_token() }}',
        //             'Accept': 'application/json',
        //         },
        //         body: formData
        //     })
        //     .then(res => res.json())
        //     .then(data => {
        //         if (data.success || data.status === 'success' || res.ok) {
        //             showSuccess();
        //         } else {
        //             resetBtn();
        //             alert(data.message || 'Something went wrong. Please try again.');
        //         }
        //     })
        //     .catch(() => {
        //         // If no backend yet — still show success for demo
        //         showSuccess();
        //     });
    });

    function showSuccess() {
        form.style.display = "none";
        successBox.style.display = "block";
    }

    function resetBtn() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
    }
})();
