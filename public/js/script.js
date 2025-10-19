const observer= new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        console.log(entry) // console.log(entry) : print the detail of entry
        if (entry.isIntersecting) { // entry.isIntersecting: true if this element is in the viewport or false otherwise
            entry.target.classList.add('show'); // entry.target: the element is observing 
                                                // entry.target.classList.add('show'): add class 'show' to the element (to change display style)
        } else {
            entry.target.classList.remove('show');
        }
    });
});
const hiddenElements= document.querySelectorAll('.hidden');
hiddenElements.forEach((el) => observer.observe(el)); // observe all hidden elements (to track each class '.hidden' element using IntersectionObserve)