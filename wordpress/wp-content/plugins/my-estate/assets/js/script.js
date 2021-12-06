$ = jQuery;

let formId     = $( "#my-estate-ajax-filter" );
let formEstate = formId.find( "form" );

formEstate.submit(
	function(e){
		e.preventDefault();

		$.ajax(
			{
				url : ajax_url,
				data : data,
				success : function(response) {
					formId.find( "form" ).empty();
					if (response) {
						for (var i = 0;  i < response.length; i++) {
							let html = "<li id='estate-" + response[i].id + "'>";
							html    += "<a href='" + response[i].permalink + "' title='" + response[i].title + "'>";
							html    += "<img src='" + response[i].poster + "' alt='" + response[i].title + "' />";
							html    += "      >";
							html    += "          <h4>" + response[i].title + "</h4>";
							html    += "          <p>Floor: " + response[i].floor + "</p>";
							html    += "          <p>Min Price: " + response[i].min_price + "</p>";
							html    += "          <p>Max Price: " + response[i].max_price + "</p>";
							html    += "          <p>Min Area: " + response[i].min_area + "</p>";
							html    += "          <p>Max Area: " + response[i].max_area + "</p>";
							html    += "          <p>Materials: " + response[i].materials_used + "</p>";
							html    += "          <p>Location: " + response[i].estate_district + "</p>";
							html    += "      </div>";
							html    += "  </a>";
							html    += "</li>";
							formId.find( "ul" ).append( html );
						}
					} else {
						var html = "<li class='no-result'>No results...</li>";
						formId.find( "ul" ).append( html );
					}
				}
			}
		);

	}
);
