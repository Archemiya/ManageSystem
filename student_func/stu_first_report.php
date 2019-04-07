<?php
    include "../link.php";
?>
<form action="../file-upload.php" method="post" enctype="multipart/form-data">
  Send these files:<br />
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <input name="userfile" type="file" /><br />
  <input type="submit" value="Send files" />
</form>