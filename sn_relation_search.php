<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");


function render_class_table($dbc, $db_name, $active_class) {
    $query = "select value,count(*) c from graph where property='类型' group by value order by c desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');

    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $count = $row[1];
        echo '<li ';
        if (isset($active_class) && ($active_class == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "db_profile.php?';

        echo 'db_name=' . $db_name . '&active_class=' . $value . '">' . $value . '</span>' . '</a></li>';
    }
}

function render_relation_table($dbc, $db_name, $active_relation) {
    $query = "select property, count(*) c from graph where value like '" . PREFIX . "%' group by property order by c desc";

    $result = mysqli_query($dbc, $query) or die('Error querying database1.');

    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        $count = $row[1];
        echo '<li ';
        if (isset($active_relation) && ($active_relation == $value)) {
            echo 'class = "active"';
        }
        echo '><a href = "db_property_profile.php?';

        echo 'db_name=' . $db_name . '&active_relation=' . $value . '">' . $value . '&nbsp;<span class="badge">' . $count . '</span>' . '</a></li>';
    }
}

if (isset($_GET['active_relation'])) {
    $active_relation = $_GET['active_relation'];
}

if (isset($_GET['subject'])) {
    $subject = $_GET['subject'];
}


if (isset($_GET['object'])) {
    $object = $_GET['object'];
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
        <li ><a href="db_profile.php?db_name=<?php echo $db_name; ?>">实体&nbsp;<?php echo '<span class="badge">' . $num_of_entities . '</span>' ?></a></li>
        <li class="active"><a href="#">语义关系&nbsp;<?php echo '<span class="badge">' . $num_of_relations . '</span>' ?></a></li>       
        <li><a href="db_literal_profile.php?db_name=<?php echo $db_name; ?>">文字属性&nbsp;<?php echo '<span class="badge">' . $num_of_literals . '</span>' ?></a></li>       
    </ul>

    <!--
    <div class="panel panel-info">
        <div class="panel-heading">
             
        </div>


    </div>
    -->

    <p></p>

    <div class="row">

        <div class="col-md-4">

            <div class="panel-group" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <?php
                            if (isset($subject)) {
                                echo '主体：' . $subject;
                            } else {
                                echo '主体：任意';
                            }
                            ?>
                            <a class="pull-right"  data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#subject">
                                <span class="glyphicon glyphicon-chevron-down"></span>&nbsp;选择
                            </a>
                        </h4>
                    </div>
                    <div id="subject" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul  class="nav nav-pills">                                
                                <?php render_class_table($dbc, $db_name, $subject); ?>
                            </ul>    
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">

        </div>

        <div class="col-md-4">

            <div class="panel-group" id="accordion">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <?php
                            if (isset($subject)) {
                                echo '主体：' . $subject;
                            } else {
                                echo '主体：任意';
                            }
                            ?>
                            <a class ="pull-right" data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#object">
                                <span class="glyphicon glyphicon-chevron-down"></span>&nbsp;选择
                            </a>
                        </h4>
                    </div>
                    <div id="object" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul  class="nav nav-pills">                                
                                <?php render_class_table($dbc, $db_name, $object); ?>
                            </ul>    
                        </div>
                    </div>
                </div>

            </div>

        </div>





    </div>




    <?php
    include_once ("./foot.php");
    ?>
