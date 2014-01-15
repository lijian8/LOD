<?php
include_once ("./header.php");
include_once ("./db_helper.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./sn_helper.php");

$query = "select value, count from cls order by count desc";
$result = mysqli_query($dbc, $query) or die('Error querying database: ' . $query);
$values = array();
while ($row = mysqli_fetch_array($result)) {
    $value = $row[0];
    $values[$value] = $row[1];
}
?>

<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-146052-10']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script');
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

<div class="container">
    <?php
    $sn_name = 'sn_class_list';
    include_once ("sn_header.php");
    ?>      
    <br>
    <?php
    $sn_subname = 'sn_report_class_list';
    include_once ("sn_sub_header.php");
    ?>  
    <p class="lead"><?php echo $db_labels[$db_name]; ?>的语义类型（<?php echo count($values); ?>种）列表</p>
    <table class="table-bordered" width="50%">
        <thead>
            <tr>
                <th width="50%">
                    语义类型
                </th>
                <th width="50%">
                    实例数
                </th>            
            </tr>
        </thead>
        <tbody>
<?php
foreach ($values as $active_class => $count) {


    echo '<tr>';
    echo '<td>' . $active_class . '</td>';
    echo '<td>' . $count . '</td>';

    echo '</tr>';
}
?>  
        </tbody>
    </table>
    <p></p>


</div>


<?php
include_once ("./foot.php");
?>
