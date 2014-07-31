	$(document).ready( function() {

		var VIOLATIONS_TOTAL = 0;

		$("input#search").click( function() {

			var num = $("input#street_num").val().trim();
			var name = $("input#street_name").val().trim();

			if (num === '' ||
				name === '') {
				alert("Please fill all Boxes");

			$('div.header').children().each( function() {
				$(this).val('');
			});
		}
		else {
			$.ajax({
				url: "my.php", 
				type: "POST",
				data: {streetnum : num, streetname : name},
				dataType: "json"
			})
			.done( function( returnedData ) {

				$('#results').css("padding-left", '15px');
				$('#results').css("padding-top", '15px');
				$('#results').css("padding-bottom", '15px');

				$('#results').empty();

				console.log(returnedData);
				console.log(returnedData.list);
				console.log(returnedData.address);
				style(returnedData.list, returnedData.address);

				//generate a score 
				score();
			})
			.fail( function() {
				console.log("Error retrieving server query");
			});

		}
	});

		function style(list, address) {
			var count = list.length;

			if (count === 0) {
				$('#results').append("No violations found at this adress");
			}
			else {
			$('#results').append("Found <strong>" + total(list) + '</strong> violations at: ' + address);	

			$.each(list, function() {
				$('#results').append('<h2 id="year">' + $(this).attr('name') + '</h2><p>' + pick($(this).attr('loInc')) + '</p>');
			});
			}
		}

		function total(list) {
			var total = 0;

			$.each(list, function() {
				$.each($(this).attr('loInc'), function() {
					total = total + $(this).attr('freq');
				});
			});

			return total;
		}

		function pick(list) {
			var result = '';

			$.each(list, function() {
				result = result + '<p>' + setIcon($(this).attr('cat')) + $(this).attr('desc') + ' (' + $(this).attr('freq') + ')' + '</p>' + '</br>';
				VIOLATIONS_TOTAL = VIOLATIONS_TOTAL + parseInt($(this).attr('rat'));
			});

			return result;
		}

		function setIcon(cat) {
			var src = '';

			if (cat === 'Trash') { src = 'trash.png'}
			else if (cat === 'Overgrown Weeds') { src = 'weeds.png' }
			else if (cat === 'Graffiti') { src = 'graffiti.png' }
			else if (cat === 'Permit/Registration') { src = 'permit.png' }
			else if (cat === 'Repair/Maintenance') { src = 'repair.png' }
			else if (cat === 'Safety/Fire Protection') { src = 'fire.png' }
			else { src = 'other.png' }

			return '<img id="icon" src="images/' + src + '"/>';
		}

		function score() {
			var VIOLATIONS_10 = [100,200,350,450,550,740,975,1410,2225,23475];
			var VIOLA_SCORE = 10;
		
			if(VIOLATIONS_TOTAL <= VIOLATIONS_10[0]) { VIOLA_SCORE = 10; }
            else if(VIOLATIONS_TOTAL < VIOLATIONS_10[9]) {
                for(i = 1; i <= 9; i++) {
                    if(VIOLATIONS_TOTAL < VIOLATIONS_10[i]) {
                        VIOLA_SCORE = (10-i) + ((VIOLATIONS_TOTAL-VIOLATIONS_10[i-1])/((VIOLATIONS_10[i]-VIOLATIONS_10[i-1])));
                        break;
                    }
                    
                }
                
            } else {
                VIOLA_SCORE = 0.0;
            }

            //console.log(VIOLA_SCORE);
			//console.log(VIOLATIONS_TOTAL);
		}
	});
