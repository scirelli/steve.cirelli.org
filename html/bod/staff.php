<?PHP require('setup.php'); ?>
<?PHP 
$result = mysql_query("SELECT u.user_id, firstname, lastname, nickname, joinDate, address, padiLevel, fileName, filePath, story 
        FROM users u
        LEFT JOIN padi_levels pl on u.padiLevel_id = pl.padiLvl_id
        LEFT JOIN states s on u.state_id = s.state_id
        LEFT JOIN images img on u.image_id = img.image_id
        LEFT JOIN stories stry on u.story_id = stry.story_id
        WHERE isStaff = 1");
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
?>
<page name="staff">
    <?PHP
    while ($row = mysql_fetch_assoc($result)) {
        echo '<staff id="' . $row['user_id'] . '">';
        echo '<firstName>' . $row['firstname'] . '</firstName>';
        echo '<lastName>' . $row['lastname'] . '</lastName>';
        echo '<address>' . $row['address'] . '</address>';
        echo '<story><![CDATA[' . $row['story'] . ']]></story>';
        echo '<nickName>' . $row['nickname'] . '</nickName>';
        echo '<joindate>' . $row['joinDate'] . '</joindate>';
        echo '<padiLevel>' . $row['padiLevel'] . '</padiLevel>';
        echo '<fileName>' . $row['fileName'] . '</fileName>';
        echo '<filePath>' . $row['filePath'] . '</filePath>';
        echo '</staff>';
    }
    ?>
</page>

<?PHP
    // Free the resources associated with the result set
    // This is done automatically at the end of the script
    mysql_free_result($result);
?>
