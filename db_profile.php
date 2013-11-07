<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");


if (isset($_GET['active_class'])) {
    $active_class = $_GET['active_class'];
}


$num_of_entities = get_num_of_entities($dbc);
$num_of_facts = get_num_of_facts($dbc);
$num_of_relations = get_num_of_relations($dbc);
$num_of_literals = get_num_of_literals($dbc);
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
    <h1><?php echo $db_labels[$db_name]; ?></h1>
    <p>
        中医脾系证候知识库包括<?php echo $num_of_entities; ?>个实体，<?php echo $num_of_facts; ?>条陈述：</p>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#">实体&nbsp;<?php echo '<span class="badge">' . $num_of_entities . '</span>' ?></a></li>
        <li><a href="db_property_profile.php?db_name=<?php echo $db_name; ?>">语义关系&nbsp;<?php echo '<span class="badge">' . $num_of_relations . '</span>' ?></a></li>       
        <li><a href="db_literal_profile.php?db_name=<?php echo $db_name; ?>">文字属性&nbsp;<?php echo '<span class="badge">' . $num_of_literals . '</span>' ?></a></li>       
    </ul>
    <p></p>



</div>



<div class="container ">
    <div class="row">
        <div class="col-md-3">
           
                <ul class="well nav nav-pills nav-stacked">  
                    <?php render_class_table($dbc, $db_name, $active_class); ?>
                </ul>
            
        </div>
        <div class="col-md-9" role="main">     

            <div>  
                <?php
                if (isset($active_class)) {

                    //echo '<h2>' . $active_class . '</h2>';
                    //echo '<div class="well">';
                    echo '<ul class="nav well nav-pills">';

                    $query = "select subject from graph where property = '" . ENTITY_TYPE . "' and value = '$active_class' order by subject asc";
                    /*
                      if (isset($_GET['limit'])){
                      $query .= ' limit ' . $_GET['limit'];
                      } */
                    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
                    $n = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<li>' . render_value($dbc, $db_name, $row[subject], false) . "</li>";
                        $n = $n + 1;
                    }


                    /*
                      if (isset($_GET['limit'])&&($n == $_GET['limit']))
                      echo '更多>>'; */
                    echo '</ul>';
                } else {
                    render_warning('<<请在右侧选择类型以查看其实例');
                   
                }
                ?>


            </div>

        </div>    
    </div>
</div>




<?php
include_once ("./foot.php");
?>
