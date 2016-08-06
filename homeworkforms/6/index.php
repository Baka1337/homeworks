<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Загрузить фотографии</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" action="upload.php">
    <br><br>
    Выберите фотографии для загрузки: <input multiple="multiple" type="file" name="photo[]" />
    <br><br>
    <input type="submit" value="Загрузить" />
</form>
<br/>
<?php
$dir = "gallery/";
  $cols = 3;
  $files = scandir($dir);
  echo "<table>";
  $k = 0;
  for ($i = 0; $i < count($files); $i++) {
      if (($files[$i] != ".") && ($files[$i] != "..")) {
          if ($k % $cols == 0) echo "<tr>";
          echo "<td>";
          $path = $dir.$files[$i];
          echo "<a href='$path'>";
          echo "<img src='$path' alt='' width='300' />";
          echo "</a>";
          echo "</td>";
          if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
          $k++;
      }
  }
  echo "</table>";
?>
</body>
</html>