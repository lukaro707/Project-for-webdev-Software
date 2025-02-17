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

<div class="">
 <h1>Tournament Discovery Page</h1>
 <h3>List of Tournmanets</h3>
 
<?php 
 $products = array("Generic EU Tournament","Generic NA Tournament","Generic Oceania Tournament","Big Regional","Small Local");
 foreach ($products as $x){
    echo "$x <br>";
}
?>

</div>

</body>
</html>