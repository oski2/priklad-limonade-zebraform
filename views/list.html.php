<hr />

<dl>
<?php
foreach ($bookmarks as $b) {
?>
    <dt><a href="<?php echo htmlspecialchars($b['url']); ?>"><?php echo htmlspecialchars($b['title']); ?></a></dt>
    <dd><a href="<?php echo url_for('/remove/', $b['id']); ?>" onclick="return confirm('Opravdu smazat?');">Odstranit</a></dd>
<?php } ?>
</dl>

<hr />

<p><a href="<?php echo url_for('/add'); ?>">Přidat</a></p>

