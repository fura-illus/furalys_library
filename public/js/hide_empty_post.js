//work only for the first loaded posts of homepage
// hide empty images
const imagesArray = [];
const images = document.querySelectorAll('.img-post');
images.forEach(function(images) 
{
    imagesArray.push(images)
});

imagesArray.forEach(function(imagesArray) 
{
    if (imagesArray.currentSrc.match('img/uploads/artists-posts')) 
    {
        imagesArray.className = "img-post"
    } 
    else 
    {
        imagesArray.className = "hidden"
    }
});

// hide empty videos
const videosArray = [];
const videos = document.querySelectorAll('.vid-post');
videos.forEach(function(videos) 
{
    videosArray.push(videos)
});

videosArray.forEach(function(videosArray) 
{
    if (videosArray.outerHTML.match('<iframe width=\"325\" height=\"200\" src=\"\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen=\"\" class=\"vid-post\">')) 
    {
        videosArray.className = "hidden"
    } 
    else 
    {
        videosArray.className = "vid-post"
    }
});