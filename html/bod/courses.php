<?PHP require('setup.php'); ?>
<?PHP 
$result = mysql_query("SELECT course_id, plt.lvlType_id, padiLevel, lvlTypes, cost, duration, startDate 
        FROM courses c
        LEFT JOIN padi_levels pl on c.padiLvl_id = pl.padiLvl_id
        LEFT JOIN padi_level_types plt on plt.lvlType_id = pl.lvlType_id
        WHERE c.cost != -1
        ORDER BY lvlType_id, padiLevel, cost");
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
?>
<page name="courses">
    <courses>
    <?PHP
    while ($row = mysql_fetch_assoc($result)) {
        echo '<course id="' . $row['course_id'] . '">';
        echo '<padiLevel><![CDATA[' . $row['padiLevel'] . ']]></padiLevel>';
        echo '<lvlType id="' . $row['lvlType_id'] . '">'  . $row['lvlTypes'] . '</lvlType>';
        echo '<cost>' . $row['cost'] . '</cost>';
        echo '<duration>' . $row['duration'] . '</duration>';
        echo '<startDate><![CDATA[' . $row['startDate'] . ']]></startDate>';
        echo '</course>';
    }
    ?>
    </courses>
</page>

<?PHP
    // Free the resources associated with the result set
    // This is done automatically at the end of the script
    mysql_free_result($result);
?>
