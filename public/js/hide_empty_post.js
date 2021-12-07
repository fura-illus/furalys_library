// fonctionne mais que pour le 1er post
const image = document.getElementById('img-post-image');
const image_src = document.getElementById('img-post-image').src;
const result = 'img/uploads/artists-posts';

if (image_src.match(result)) {
    image.hidden = true;
};