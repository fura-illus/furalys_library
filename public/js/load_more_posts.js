$(function() {

    let page = 1;

    window.addEventListener('scroll', () => 
    {
        /*
            scrollTop = amount scroll from the top
            scrollHeight = total amount of scrollable content
            clientHeight = views height (of screen)
         */
        const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

        if(clientHeight + scrollTop >= scrollHeight - 5) {
            // load more content
            page++;

            $.ajax({
                url : '/load_more/' + page,
                method: 'GET',
                dataType: 'html',
                success : function(code_html, statut)
                {
                    $(code_html).appendTo(".post-list");
                },
                error: function(resultat, statut, erreur)
                {

                },
                complete : function(resultat, statut)
                {

                }
            });

            // copy of hide_empty_post.js so the new loaded empty posts are hidden too
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
            console.log(videosArray);

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
            console.log(videosArray);
        }
    });
});