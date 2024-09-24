let currentIndex = 0;
const images = [
    'img-1.png', // Add the paths to your images here
    'img-3.png',
    'img-5.png'
];

function changeImage(direction) {
    currentIndex += direction;
    if (currentIndex < 0) {
        currentIndex = images.length - 1;
    } else if (currentIndex >= images.length) {
        currentIndex = 0;
    }
    document.getElementById('mainImg').src = images[currentIndex];
}
    