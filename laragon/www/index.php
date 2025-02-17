<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<style>
</style>
<script src=""></script>
<body>

<img src="img_la.jpg" alt="LA" style="width:100%">

<div class="">
 <h1>This is a the home page</h1>
 <h3>Best sellers list</h3>
 
<?php 
 $products = array("Prod1","Prod2","Prod3","Prod4","Prod5");
 foreach ($products as $x){
    echo "$x <br>";
}
?>

</div>

</body>
</html>