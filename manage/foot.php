<div class="ch-box-lite">
		

			
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/chico-min-0.13.1.js"></script>
	<script>
	// Menu
		//var menu = $(".YOUR_SELECTOR_Menu").menu({
		//	'selected': 5
		//});
		var foo = $(".YOUR_SELECTOR_Menu").menu();
		// Calendar
		var	calendar = $(".YOUR_SELECTOR_calendar").calendar({"from": "today"});

		// Carousel
		//var carousel = $(".myCarousel").carousel({"pagination": true});
		var carousel = $.carousel($(".myCarousel"), {"pagination": true});

		// Countdown
		var	countdown = $("#text_cd").countdown(140);

		// Date Picker
		var	datePicker = $("#val_date").datePicker({
			"selected": "2013/03/15",
			"to": "today"
		});

		var	datePicker2 = $("#val_date2").datePicker({
			"selected": "2013/3/15",
			"to": "today"
		});
		// Messages
		var message = (function (message, value) {

			var messages = {
				'option': 'Choose an option.',
				'requiredCheck': '±ØĞëÌîĞ´.',
				'link': 'ĞÕÃû±ØĞëÌîĞ´.'
			};

			return function (message, value) {
				var message = messages[message] || message;
				if(value){
					return message.replace('{#num#}',value)
				}
				return message;
			}

		}());
		var	validation1 = $('#input_name').required(message('ĞÕÃû±ØĞëÌîĞ´'));
		var	validation1 = $('#input_xl').required(message('±ØĞëÌîĞ´'));
		var	validation1 = $('#input_phone').required(message('±ØĞëÌîĞ´'));
		var	validation1 = $('#input_mail').required(message('±ØĞëÌîĞ´'));
	</script>