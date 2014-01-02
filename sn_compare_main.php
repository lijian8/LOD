<?php
include_once ("./header.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_array.php");
?>
<div class="container">
    <?php
    $sn_name = 'sn_compare';
    include_once ("sn_header.php");
    ?>  
    <br>
    <?php
    if (isset($_GET['first']) && isset($_GET['second'])) {
        $first = $_GET['first'];
        $second = $_GET['second'];
        //echo "<script>window.location =\"index.php\";</script>";
        echo '<p class="lead">您已选择将"' . $db_labels[$first] . '"与"' . $db_labels[$second] . '"的语义网络进行比较';
        echo '&nbsp（<a href= "' . $_SERVER['PHP_SELF'] . '" class="btn-link">重新选择</a>）';
        echo '</p>';
        echo '<p>';
        echo '<a href="sn_compare.php?sdb_name=' . $first . '&tdb_name=' . $second . '" class="btn btn-large btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;进入浏览界面</a>';
        echo '&nbsp;&nbsp;';
        echo '<a href="sn_compare_report.php?sdb_name=' . $first . '&tdb_name=' . $second . '" class="btn btn-large btn-success"><span class="glyphicon glyphicon-list"></span>&nbsp;查看统计报表</a>';
        echo '&nbsp;&nbsp;';

        echo '</p>';
    } else {
        ?>        

        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form-horizontal"
              enctype="multipart/form-data">

            <?php
            if (isset($_GET['first'])) {
                $first = $_GET['first'];
                ?>
                <input  type="hidden" id="first" name="first" value = "<?php echo $first; ?>" >
                <p class="lead">请选择与"<?php echo $db_labels[$first]; ?>"相比较的语义网络：</p>
                <?php
            } else {
                echo "<p class=\"lead\">请选择一个语义网络来参与比较：</p>";
            }
            ?>


            <p class="lead">
                <?php
                foreach ($db_labels as $db_id => $db_label) {
                    //echo $db_id;
                    //echo $db_label;
                    if ($first != $db_id) {
                        $input_name = isset($first) ? 'second' : 'first';
                        echo '<label><input type="radio" id="' . $input_name . '" name="' . $input_name . '" value="' . $db_id . '" >&nbsp;'
                        . $db_label . '</label>&nbsp;&nbsp;';
                    }
                }
                ?>
            </p>
            <input class="btn btn-large btn-primary" type="submit" name="submit" value="提交" />    

        </form>
        <?php
    }
    ?>
    <hr>
</div>
<?php
include_once ("./foot.php");
?>