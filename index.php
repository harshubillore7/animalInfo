<?php
require 'connection.php';

$no1 = rand(0,15);
$no2 = rand(0,15);
$name = '';
$category = '';
$image = '';
$description = '';
$lifeExp = '';
// print_r($_REQUEST);exit();
if(isset($_POST["submit"])){
	$no11 = $_REQUEST["no1"];
	$no12 = $_REQUEST["no2"];
	$addition = $_REQUEST["addition"];
	$add = $no12 +$no11;
	$name = $_POST["name"];
	  if(isset($_POST["category"])){
	 	$category =$_POST["category"];
	 }else{
	 	$category= '';
	 };
	$image = $_POST["image"];
	$description = $_POST["description"];
	$lifeExp = $_POST["lifeExp"];

	if($name=='')
	{
		$nameErr="Name is Required";
	}
	else if ($category=='') 
	{
		$categoriesErr="Category is Required";
	}
	else if ($image=='') 
	{
		$imageErr="Image is Required";
	}
	else if ($description=='') 
	{
		$descriErr="Description is Required";
	}
	else if ($lifeExp=='') 
	{
		$lifeErr="life Expectancy is Required";
	}
	
	else if($add!=$addition){
		$captchErr="Please Enter Captcha";
	}else{

		$query = "INSERT INTO `data`(`name`, `category`, `image`, `description`, `lifeExp`) VALUES ('$name','$category','$image','$description','$lifeExp')";
		$insert = mysqli_query($conn,$query);
		if(!$insert){
			echo "There is some problem of inserting data";
		}
		else{
			header("Location: animal.php");
			// echo"<script>alert('Data inserted successfully')</script>";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/style.css">
<head>
	<title>Animal Information</title>
</head>
<body id="info">
	<h3>Animal Information</h3>
	<div class="container">
		<form action="index.php" method="post"autocomplete="off">
			<div>
				<label><b>Name of the animal :</b> <span><?php if(isset($nameErr) && $nameErr!=''){
					echo $nameErr;
				} ?></span>
			</label>
				<input type="text" name="name" placeholder="Enter"  value="<?= $name ?>" >
			</div>
			<div class="categories">
				<label><b>Category :</b><span><?php if(isset($categoriesErr) && $categoriesErr!=''){
					echo $categoriesErr;
				} ?></span></label>
				<input type="radio" name="category" <?php if($category=='herbivores'){ echo "checked";} ?> value="herbivores" >Herbivores
				<input type="radio" name="category" <?php if($category=='omniovers'){ echo "checked";} ?>  value="omniovers">Omniovers
				<input type="radio" name="category" <?php if($category=='carnivores'){ echo "checked";} ?>  value="carnivores">Carnivores
			</div>
			<div>
				<label><b>Image :</b><span><?php if(isset($imageErr) && $imageErr!=''){
					echo $imageErr;
				} ?></span></label>
				<input type="file" name="image" value="" >
			</div>
			<div>
				<label><b>Description :</b><span><?php if(isset($descriErr) && $descriErr!=''){
					echo $descriErr;
				} ?></span></label>
				<textarea type="textarea" name="description" ><?= $description ?></textarea>
			</div>
			<div>
				<label><b>Life Expectancy :</b><span><?php if(isset($lifeErr) && $lifeErr!='unselected'){
					echo $lifeErr;
				} ?></span></label>
				<select name="lifeExp" >
					<option value="" selected hidden>Select option</option>
					<option <?php if($lifeExp=='0-1 year'){ echo "selected";} ?> value="0-1 year">0-1 year</option>
					<option <?php if($lifeExp=='1-5 year'){ echo "selected";} ?> value="1-5 year">1-5 year</option>
					<option <?php if($lifeExp=='5-10 year'){ echo "selected";} ?> value="5-10 year">5-10 year</option>
					<option <?php if($lifeExp=='10+ year'){ echo "selected";} ?> value="10+ year">10+ year</option>
				</select>
			</div>
			<div>
				<label><b>Captcha :</b><?php echo $no1."+".$no2; ?></label>
				<span><span><?php if(isset($captchErr) && $captchErr!=''){
					echo $captchErr;
				} ?></span></span>
				<input type="hidden" name="no1" value="<?php echo $no1?>">
				<input type="hidden" name="no2" value="<?php echo $no2?>">
				<input type="text" name="addition">
			</div> 
			<div>
				<input type="submit" name="submit">
			</div>
		</form>
	</div>
</body>

</html>