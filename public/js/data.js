$(document).ready(function(){
		$(".historylist>tbody>tr").each(function (index) {

			var qishu = $(this).find("a").text();
			var dates = $(this).find("td").eq(1).text();
			var redBalls = $(this).find(".redBalls").html();
			var blueBalls = $(this).find(".blueBalls").html();
			var ball = {
				"qishu" : qishu,
				"dates" : dates,
				"redBalls" : redBalls,
				"blueBalls" : blueBalls
			};
			
			
			 $.ajax({
				url : "http://app.store.com/frontend/lottery/getdata",
				dataType : 'json',  
				type : "POST",
				data : ball,
				crossDomain:true,
				success: function(msg){
					 console.log( "Data Saved: " + msg );
					},
				error:function(){
					console.log( "have a error" );
				}


			});

		});
	
});
