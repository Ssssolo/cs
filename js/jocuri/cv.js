        // fancy example
        $('.fancy .slot').jSlots({
			number : 3,
            winnerNumber : 1,
            spinner : '#invarte',
            easing : 'easeOutSine',
            time : 7000,
            loops : 5,
            onStart : function() {
                $('.slot').removeClass('winner');
            },
            onWin : function(winCount, winners) {
				$('#invarte').prop('disabled', true);
                $.each(winners, function() {
                    this.addClass('winner');
                });
				
				//dezactivare esc
				$(document).keyup(function(e) {
					if (e.keyCode == 27) 
						location.reload();
				});
				
                // react to the # of winning slots                 
                if ( winCount === 1 ) {
					setTimeout(function() {
						swal({ 
							title: "Felicitări!", 
							text: 'Ai avut noroc și ai primit un 7! 2 puncte ți-au fost adăugate în cont!', 
							type: "success",
							showConfirmButton: false
						});
					}, 2500);
                } else if ( winCount > 1 ) {
					swal({ 
						title: "Felicitări!", 
						text: 'Ai avut noroc și ai primit ' + winCount + ' șeptari!! '+ 2*winCount +' puncte ți-au fost adăugațe în cont!', 
						type: "success",
						showConfirmButton: false
					});
                }
				
				setTimeout(function() {
					location.reload();
				}, 7000);
            }
        }); 