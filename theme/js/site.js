jQuery(function ($) {
    // jQuery here
});

// In-view observer
const objectsToObserveOnce = document.querySelectorAll('.observe-once');
const observerOnce = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
            entry.target.classList.add('in-view');
            observerOnce.unobserve(entry.target);
        }
    });
}, {
    threshold: 0.25 // Change this if needed (percentage of element in view before triggering)
});
objectsToObserveOnce.forEach(object => {
    observerOnce.observe(object);
});

// In-out-view observer
const objectsToObserve = document.querySelectorAll('.observe');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.intersectionRatio > 0) {
            entry.target.classList.add('in-view');
        } else {
            entry.target.classList.remove('in-view');
        }
    });
}, {
    threshold: 0.25 // Change this if needed (percentage of element in view before triggering)
});
objectsToObserve.forEach(object => {
    observer.observe(object);
});