<!DOCTYPE html>
<html lang="en">
<head>
	<!-- 
		Skill Building 4 - API with PHP
		Chris McGuire
		CTEC 290 - API
		Winter 18
	-->

	<meta charset="utf-8" />
	<title>NYT API with PHP</title>

	<!-- CSS -->
	<link href="css/reset.css" rel="stylesheet" />
	<link href="css/main.css" rel="stylesheet" />

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<!-- moment.js -->
	<script src="js/moment.js"></script>

	<script type="text/javascript">
		$(document).ready( function() {
			var date = $('.date')
			date.each( function(index) {
				var oldDate = this.innertext;
				var newDate = moment(oldDate).format('YYYY MM DD');
				$(this).text(newDate);
			});
		})
	</script>

</head>
<body>
	<div id="wrapper">
		<header>
			<h1>New York Times API With PHP</h1>
		</header>
		<main>
			<div id="articleDiv">
				<?php
					$key = "c64d0a52048b48ec8c6f20d3f4930160";
					$url = "http://api.nytimes.com/svc/topstories/v1/home.json?api-key=" . $key;

					// reads JSON file from remote server
				  	// $data = file_get_contents($url);
				  	// converts data returned into a PHP object
					// $data = json_decode($data);

					function CallAPI($url){
						$curl = curl_init();
						// set the URL for curl to get
						curl_setopt($curl, CURLOPT_URL, $url);
						// have curl return a string
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
						// dont verify certificate
						curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
						// make the request
						$result = curl_exec($curl);
						// close
						curl_close($curl);

			 			return $result;
					}

					$data = CallAPI($url);
					$data = json_decode($data); 
					
					for($i = 0; $i< count($data->results); $i++){
						echo "<article>";
						echo "<img src=".$data->results[$i]->multimedia[0]->url." alt=\"Top Story thumbnail\" >";
						echo "<h2><a href=". $data->results[$i]->url .">" .$data->results[$i]->title."</a></h2>";
						echo "<h3 class=\"storySection\">".$data->results[$i]->section."</h3>";
						echo "<p class=\"abstract\">".$data->results[$i]->abstract."</p>";
						echo "<h3 class=\"date\">".$data->results[$i]->created_date."</h3>";
						echo "<h3 class=\"byLine\">".$data->results[$i]->byline."</h3>";
						echo "</article>";
					}
				?>
			</div> <!-- end articleDiv -->
		</main>
		<footer>
			<p>Chirs McGuire - Winter 18</p>
		</footer>
	</div><!-- end wrapper -->
</body>
</html>
