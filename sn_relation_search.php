<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

function get_cls($dbc) {
    $query = "select value from cls order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    $classes = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($classes, $row[value]);
    }
    return $classes;
}

function render_props($dbc, $db_name, $subject, $predicate, $object) {
    $query = "select property from properties where property != '上位词' and property != '下位词' order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');

    echo '<li><a href = "sn_relation_search.php?';

    echo 'db_name=' . $db_name . '&subject=' . $subject . '&object=' . $object . '">任意关系</a></li>';


    while ($row = mysqli_fetch_array($result)) {
        echo '<li ';
        if (isset($predicate) && ($predicate == $row[0])) {
            echo 'class = "disabled"';
        }
        echo '><a href = "sn_relation_search.php?';

        echo 'db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $row[0] . '&object=' . $object . '">' . $row[0] . '</a></li>';
    }
}

function render_subjects($dbc, $db_name, $subject, $predicate, $object) {
    $classes = get_cls($dbc);

    echo '<li><a href = "sn_relation_search.php?';

    echo 'db_name=' . $db_name . '&predicate=' . $predicate . '&object=' . $object . '">任意事物</a></li>';


    foreach ($classes as $cl) {

        echo '<li ';
        if (isset($subject) && ($subject == $cl)) {
            echo 'class = "disabled"';
        }
        echo '><a href = "sn_relation_search.php?';

        echo 'db_name=' . $db_name . '&subject=' . $cl . '&predicate=' . $predicate . '&object=' . $object . '">' . $cl . '</a></li>';
    }
}

function render_objects($dbc, $db_name, $subject, $predicate, $object) {
    $query = "select value from cls order by count desc";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');

    echo '<li><a href = "sn_relation_search.php?';

    echo 'db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $predicate  . '">任意事物</a></li>';


    while ($row = mysqli_fetch_array($result)) {
        $value = $row[0];
        echo '<li ';
        if (isset($subject) && ($subject == $value)) {
            echo 'class = "disabled"';
        }
        echo '><a href = "sn_relation_search.php?';

        echo 'db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $predicate . '&object=' . $value . '">' . $value . '</a></li>';
    }
}

function get_triple_ids($dbc, $subject, $predicate, $object) {

    $where_clauses = array();
    if (isset($subject) && ($subject != '')) {
        $where_clauses[] = "subject='$subject'";
    }

    if (isset($predicate) && ($predicate != '')) {
        $where_clauses[] = "property='$predicate'";
    }

    if (isset($object) && ($object != '')) {
        $where_clauses[] = "object='$object'";
    }

    if (count($where_clauses) == 0) {
        render_warning('请选择主体、客体或关系的类型');
    } else {
        $where = implode(' and ', $where_clauses);
        $query = "SELECT instances FROM semantic_network where " . $where;
        echo $query;
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');

        $ids = array();
        while ($row = mysqli_fetch_array($result)) {
            $ids = array_merge($ids, explode('|', $row[0]));
        }
        print_r($ids);
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

if (isset($_GET['subject']) && ($_GET['subject'] != '')) {
    $subject = $_GET['subject'];
}

if (isset($_GET['predicate']) && ($_GET['predicate'] != '')) {
    $predicate = $_GET['predicate'];
}


if (isset($_GET['object']) && ($_GET['object'] != '')) {
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

    <table class="table">
        <thead>
        <th width="35%" class="lead">
            <?php
            if (isset($subject)) {
                echo '主体：' . $subject;
            } else {
                echo '主体：任意事物';
            }
            ?>  
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#subjectModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>

        </th>
        <th width="30%" class="lead">
            <?php
            if (isset($predicate)) {
                echo '谓词：' . $predicate;
            } else {
                echo '谓词：任意关系';
            }
            ?>  
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#predicateModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </th>

        <th width="35%" class="lead">
            <?php
            if (isset($object)) {
                echo '客体：' . $object;
            } else {
                echo '客体：任意事物';
            }
            ?>  
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#objectModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </th>

        </thead>
        <tbody>


        </tbody>
    </table>

    <?php get_triple_ids($dbc, $subject, $predicate, $object); ?>

    <!-- Modal -->
    <div class="modal fade" id="subjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">选择类型：</h4>
                </div>
                <div class="modal-body">
                    <ul  class="nav nav-pills">                                
                        <?php render_subjects($dbc, $db_name, $subject, $predicate, $object); ?>
                    </ul>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="predicateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">选择属性：</h4>
                </div>
                <div class="modal-body">
                    <ul  class="nav nav-pills">                                
                        <?php render_props($dbc, $db_name, $subject, $predicate, $object); ?>
                    </ul>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Modal -->
    <div class="modal fade" id="objectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">选择类型：</h4>
                </div>
                <div class="modal-body">
                    <ul  class="nav nav-pills">                                
                        <?php render_objects($dbc, $db_name, $subject, $predicate, $object); ?>
                    </ul>    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>                    
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php
    include_once ("./foot.php");
    ?>
