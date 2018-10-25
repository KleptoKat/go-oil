<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">

body {
  font-family: 'Roboto Condensed', sans-serif;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: 'Roboto Condensed', sans-serif;
}

h1{
  font-size: 60px;
  text-shadow: 5px 5px 10px gray;
}

h2{
  font-size: 25px;
}

h2 a:link{
  text-decoration: none;
  color: black;
}

h2 a:visited {
  text-decoration: none;
  color: gray;
}

h2 a:hover {
  color: red;
}

h2 a:active {
  text-decoration: underline;
}

.error_404{
  text-align: center;
  padding-top: 120px;
}

</style>
</head>
	<div class="error_404">
    <img id="car" src="<?php echo base_url() ?>assets/img/gooiltruck.jpg" alt="#">
    <h1>404 Page Not Found</h1>
  		<h2><a href="<?php echo base_url();?>">Go Back to Home</a></h2>
	</div>
