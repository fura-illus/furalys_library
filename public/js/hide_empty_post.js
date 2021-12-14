// hide empty images

const result = 'img/uploads/artists-posts';

const imagesArray = [];
const images = document.querySelectorAll('.img-post');
images.forEach(function(images) {
    imagesArray.push(images)
});
console.log(imagesArray);


imagesArray.forEach(function(imagesArray) {
    if (imagesArray.currentSrc.match(result)) {
        imagesArray.className = "img-post"
    } else {
        imagesArray.className = "hidden"
    }
});
console.log(imagesArray);

// hide empty videos