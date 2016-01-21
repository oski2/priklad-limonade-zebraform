<?php


$query = @$_POST['query'];

$db = new SQLite3('database.sql');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Hrátky s databází</title>
<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
<link href="../css/main.css" rel="stylesheet" type="text/css" media="screen,projection,handheld">
<link href="../css/mobile.css" rel="stylesheet" type="text/css" media="screen,projection,handheld">
<link href="../css/sizes.css" rel="stylesheet" type="text/css" media="screen,projection,handheld">
<link href="../css/print.css" rel="stylesheet" type="text/css" media="print">
<script type="text/javascript">
$( document ).ready(function() {
    $("#query").focus();
});
    </script>
<style type="text/css">
TABLE.results {
    padding: 0;
    margin: 1em;
    border-collapse: collapse;
    border: 0 solid black;
    border-width: 2px 0 2px 0;
}
TABLE.results TH {
    border-bottom: 1px solid;
    padding: 1ex;
    text-align: left;
}
TABLE.results TD {
    padding: 0.5ex 1ex;
}

TABLE.results TBODY TR:nth-child(odd) {
    background-color: #DDD;
}
TABLE.results TBODY TR:nth-child(even) {
    background-color: #EEE;
}
</style>
</head>
<body><div id="container">
<h1>Hrátky s databází</h1>
<form method="post">
<textarea cols="80" rows="5" style="width:100%" name="query" id="query">
<?php echo htmlspecialchars($query); ?>
</textarea>
<p>
<input type="submit" value="Odeslat dotaz" />
</p>
</form>

<?php
if (trim($query) != "") {
    printf("<h2>Výsledek</h2>\n");
    $result = @$db->query($query);
    if ($result === FALSE) {
        printf("<p>Příkaz selhal: <b>%s</b>.</p>", htmlspecialchars($db->lastErrorMsg()));
    } else if ($result === TRUE) {
        printf("<p>Příkaz úspěšně proběhl.</p>");
    } else {
        printf("<table class=\"results\">\n");
        printf("<thead><tr>");
        $columns = $result->numColumns();
        for ($i = 0; $i < $columns; $i++) {
            printf("<th>%s</th>", htmlspecialchars($result->columnName($i)));
        }
        printf("</tr></thead>\n");
        printf("<tbody>\n");
        $rows = 0;
        while (TRUE) {
            $row = $result->fetchArray();
            if ($row === FALSE) {
                break;
            }
            printf("<tr>");
            for ($i = 0; $i < $columns; $i++) {
                printf("<td>%s</td>", htmlspecialchars($row[$i]));
            }
            printf("</tr>");
            $rows++;
        }
        if ($rows == 0) {
            printf("<tr><td colspan=\"%d\"><i>Žádné výsledky</i></td></tr>\n", $columns);
        }
        printf("</tbody></table>\n");
    }
}
?>
<address><a href="?source=yes">Zobrazit zdrojový kód</a></address>
</div>
</body>
</html>
