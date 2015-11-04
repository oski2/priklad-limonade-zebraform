<?php
foreach ($errors as $e) {
    printf("<p style=\"color:red\">%s</p>\n", htmlspecialchars($e));
}
?>
<form method="post" action="<?php echo url_for('/add'); ?>">
<dl>
<dt>URL</dt>
<dd><input type="text" name="url" value="<?php echo htmlspecialchars($f_url); ?>" /></dd>
<dt>Nadpis</dt>
<dd><input type="text" name="title" value="<?php echo htmlspecialchars($f_title); ?>" /></dd>
<dt><input type="submit" value="Uložit" /></dt>
</dl>
</form>
