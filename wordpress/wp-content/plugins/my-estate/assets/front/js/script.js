// Ajax Filter
jQuery(function($){

    let filter = $('#ajax-filter-form');

    filter.submit(function(){
        let formdata =

        $.ajax({
            url : ajax_object.url,
            data : filter.serialize(),
            dataType : 'json',
            type : 'POST',
            beforeSend : function ( xhr ) {
                filter.find('button').text('Searching...');
            },
            success:function(data){
                ajax_object.current_page = 1;
                ajax_object.posts = data.posts;
                ajax_object.max_page = data.max_page;
                filter.find('button').text('Search');
                $('#ajax_filter_search_results').html(data.content);
            }
        });
        return false;
    });

});

//Load More Posts
jQuery(function($){
    let loadmore =  $('#my_estate_loadmore');

    $(document).on('click', '#my_estate_loadmore', function(){
        $.ajax({
            url : ajax_object.url,
            data : {
                action: 'loadmorebutton',
                query: ajax_object.posts,
                page : ajax_object.current_page,
                max_page : ajax_object.max_page,
            },
            type : 'POST',
            beforeSend : function ( xhr ) {
                loadmore.text('Loading...');
            },
            success : function( posts ){
                if( posts ) {

                    loadmore.text( 'More posts' );
                    $('#ajax_filter_search_results').append( posts );
                    ajax_object.current_page++;

                    if ( ajax_object.current_page == ajax_object.max_page ) {
                        loadmore.hide();
                    }
                } else {
                    loadmore.hide();
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.debug(xhr.status);
                console.debug(ajaxOptions);
                console.debug(thrownError);
              },
        });
        return false;
    });
});

