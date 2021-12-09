jQuery( document ).ready(
	function() {

		//console.log( "start script " );

		var filterWrap = jQuery( "#my-ajax-filter-search" );
		var filterForm = filterWrap.find( "form" );

		filterForm.submit(
			function(e){
				e.preventDefault();

				if (filterForm.find( "#search" ).val().length !== 0) {
					var search = filterForm.find( "#search" ).val();
				}

				if (filterForm.find( "#rooms" ).val().length !== 0) {
					var rooms = filterForm.find( "#rooms" ).val();
				}

				if (filterForm.find( "#materials" ).val().length !== 0) {
					var materials = filterForm.find( "#materials" ).val();
				}
/*
				if (filterForm.find( "#floor" ).val().length !== '') {
					var floor = filterForm.find( "#floor" ).val();
				}

				if (filterForm.find( "#district" ).val().length !== 0) {
					var district = filterForm.find( "#district" ).val();
				}

 */
				if (filterForm.find( "#min_area" ).val().length !== 0) {
					var min_area = filterForm.find( "#min_area" ).val();
				}
				if (filterForm.find( "#min_price" ).val().length !== 0) {
					var min_price = filterForm.find( "#min_price" ).val();
				}

				var data = {
					action : 'my_ajax_filter_search',
					search : search,
					rooms : rooms,
					materials : materials,
				//	floor : floor,
					min_area : min_area,
					min_price : min_price,
					//district : district,
				}

				jQuery.ajax(
					{
						url : ajax.url,
						data : data,
						success : function(response) {
							filterWrap.find( "ul" ).empty();

							if ( response) {
								for (var i = 0;  i < response.length; i++) {
									var
										html = "<li>";
									html     = "<li id='estate-item-" + response[i].id + "'>";
									html    += "  <a href='" + response[i].permalink + "' title='" + response[i].title + "'>";
									html    += "      <img src='" + response[i].poster + "' alt='" + response[i].title + "' />";
									html    += "      <div class='property-info'>";
									html    += "          <h4>" + response[i].title + "</h4>";
									html    += "          <span><i class='fas fa-bed'></i>Rooms: " + response[i].rooms + "</span>";
						//			html    += "          <span><i class='fas fa-sort-numeric-up-alt'></i>Floor: " + response[i].floor + "</span>";
									html    += "          <span><i class='fas fa-igloo'></i>Materials: " + response[i].materials + "</span>";
									html    += "          <span><i class='fas fa-vector-square'></i>Min area: " + response[i].min_area + "</span>";
									html    += "          <p>Min price: " + response[i].min_price + "</p>";
						//			html    += "          <p>District: " + response[i].district + "</p>";
									html    += "      </div>";
									html    += "  </a>";
									html    += "</li>";
									filterWrap.find( "ul" ).append( html );
								}
							} else {
								var html = "<li class='no-result'>No matching found....</li>";
								filterWrap.find( "ul" ).append( html );
							}
						}
					}
				);

			}
		);

	}
);
