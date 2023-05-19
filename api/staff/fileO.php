<?php 
//open file and read-only 
$handle = fopen("D:\\fileoperation\\fileO.txt", "r");
echo fread($handle,filesize("D:\\fileoperation\\fileO.txt"));
fclose($handle);  
?> 

<?php
//create and write file
$myfile = fopen("D:\\fileoperation\\newfile.txt", "w") or die("Unable to open file!");
$txt = "Second file Written";
fwrite($myfile, $txt);

//to read the newfile
$newfile = fopen("D:\\fileoperation\\newfile.txt", "r");
echo fread($newfile,filesize("D:\\fileoperation\\newfile.txt"));

//overwrite the newfile
$txt1 = "Second file overwrite\n";
fwrite($myfile, $txt1);
echo fread($newfile,filesize("D:\\fileoperation\\newfile.txt"));

//close file
//fclose($myfile);
//fclose($newfile);
?> 
<?php
//create another file
$anotherfile = fopen("D:\\fileoperation\\latestfile.txt", "c+") or die("Unable to open file!");
fwrite($anotherfile, "New file ready to be written");
//append data into the file
$anotherfile = fopen("D:\\fileoperation\\latestfile.txt", "a+") or die("Unable to open file!");
fwrite($anotherfile, "already written");
?>