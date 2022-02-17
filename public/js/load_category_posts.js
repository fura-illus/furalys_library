$(function() {

    let page = 1;

    $(".load-category-posts").click(function(e)
    {
        e.preventDefault();
        page++;

        const categoryId = $('.category-posts-section').data('category');


        $.ajax({
            url : `/category_posts/${categoryId}/${page}`,
            method: 'GET',
            dataType: 'html',
            success : function(code_html, statut)
            {
                if(code_html == "") {
                    $('.load-category-posts').hide();
                } else {
                    $(code_html).appendTo(".category-posts-section");
                }
            },
            error: function(resultat, statut, erreur)
            {

            },
            complete : function(resultat, statut)
            {

            }
        });
    });
});