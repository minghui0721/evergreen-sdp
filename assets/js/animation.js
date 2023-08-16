const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            if (entry.target.classList.contains('animation_fade')) {
                entry.target.classList.add('show-fade');
            } else if (entry.target.classList.contains('animation_bottom')) {
                entry.target.classList.add('show1');
                entry.target.classList.add('show2');
            }
        } 
    });
});


const animationButtonElements = document.querySelectorAll('.animation_bottom');
animationButtonElements.forEach((el) => observer.observe(el));

const animationFadeElements = document.querySelectorAll('.animation_fade');
animationFadeElements.forEach((el) => observer.observe(el));
