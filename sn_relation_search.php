<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
include_once ("./sn_helper.php");

function get_instance_summary($dbc, $db_name, $row) {
    $ids = explode('|', $row['instances']);
    $i = 0;
    $arr = array();
    while ($i < min(array(10, count($ids)))) {
        $q1 = "select * from graph where id = '$ids[$i]'";
        $r1 = mysqli_query($dbc, $q1) or die('Error querying database2.');
        if ($row1 = mysqli_fetch_array($r1)) {
            $s = '(' . render_value($dbc, $db_name, $row1['subject'], false) . '&nbsp';
            $s .= $row1['property'] . '&nbsp;';
            $s .= render_value($dbc, $db_name, $row1['value'], false) . ')';
            $arr[] = $s;
        }
        $i = $i + 1;
    }

    return implode(',&nbsp;', $arr) . '<br><a class="btn btn-link" target="blank" href="sn_triple_type.php?db_name=' . $db_name . '&type=' . $row['id'] . '">更多>></a>';
}

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

    echo 'db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $predicate . '">任意事物</a></li>';


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

function get_total($dbc, $subject, $predicate, $object) {
    $query = build_query($dbc, $subject, $predicate, $object, true);
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['count'];
    return $total;
}

function build_query($dbc, $subject, $predicate, $object, $count_only = false) {

    if ($count_only) {
        $query = "SELECT count(*) as count FROM semantic_network";
    } else {
        $query = "SELECT * FROM semantic_network";
    }


    $where_clauses = array();

    $where_clauses[] = "property != '上位词'";
    $where_clauses[] = "property != '下位词'";

    if (isset($subject) && ($subject != '')) {
        $where_clauses[] = "subject='$subject'";
    }

    if (isset($predicate) && ($predicate != '')) {
        $where_clauses[] = "property='$predicate'";
    }

    if (isset($object) && ($object != '')) {
        $where_clauses[] = "object='$object'";
    }

    if (count($where_clauses) != 0) {
        $where = implode(' and ', $where_clauses);
        $query .= " where " . $where;
    }

    $query .= " order by count desc ";

    return $query;
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

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
$results_per_page = 10;  // number of results per page
$skip = (($cur_page - 1) * $results_per_page);
$total = get_total($dbc, $subject, $predicate, $object);
$num_pages = ceil($total / $results_per_page);

//$num_of_entities = get_num_of_entities($dbc);
//$num_of_facts = get_num_of_facts($dbc);
//$num_of_relations = get_num_of_relations($dbc);
//$num_of_literals = get_num_of_literals($dbc);
$num_of_cls = sn_get_num_cls($dbc);
$num_of_props = sn_get_num_of_props($dbc);
$url = 'sn_relation_search.php?db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $predicate . '&object=' . $object;
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
    
    <p>该语义网络包括<?php echo $num_of_cls; ?>个语义类型，<?php echo $num_of_props; ?>种语义关系：</p>
     
    <ul class="nav nav-tabs">
        <li ><a href="sn_profile.php?db_name=<?php echo $db_name; ?>">按语义类型浏览</a></li>            
        <li  class="active"><a href="#">语义关系搜索</a></li>       
            
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
        <th width="3%" >#</th>
        <th width="18%" >
            <?php
            if (isset($subject)) {
                echo '主体：' . $subject;
            } else {
                echo '主体：任意事物';
            }
            ?>  
            <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#subjectModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>

        </th>
        <th width="18%" >
            <?php
            if (isset($predicate)) {
                echo '谓词：' . $predicate;
            } else {
                echo '谓词：任意关系';
            }
            ?>  
            <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#predicateModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </th>

        <th width="18%" >
            <?php
            if (isset($object)) {
                echo '客体：' . $object;
            } else {
                echo '客体：任意事物';
            }
            ?>  
            <button type="button" class="btn btn-link btn-xs" data-toggle="modal" data-target="#objectModal">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </th>

        <th width="43%" >
            实例
        </th>

        </thead>
        <tbody>

            <?php
            $query = build_query($dbc, $subject, $predicate, $object) . " LIMIT $skip, $results_per_page";

            $result = mysqli_query($dbc, $query) or die('Error querying database1.');

            $row_num = 1;
            $color = true;
            while ($row = mysqli_fetch_array($result)) {
                if ($color) {
                    echo '<tr>';
                } else {
                    echo '<tr class="info">';
                }
                $color = !$color;

                $no = $skip + ($row_num++);

                echo '<td width = "3%">' . $no . '</td>';



                echo '<td>' . $row['subject'] . '</td>';
                echo '<td>' . $row['property'] . '</td>';
                echo '<td>' . $row['object'] . '</td>';
                echo '<td>' . get_instance_summary($dbc, $db_name, $row) . '</td>';
                echo '</tr>';
            }
            ?>    

        </tbody>
    </table>

    <?php
    if ($num_pages > 1) {

        $page_links = '';

        echo '<ul class="pagination">';

        echo '<li><a href="' . $url . '&page=' . (1) . '">首页</a></li>';

        // If this page is not the first page, generate the "previous" link
        if ($cur_page > 1) {
            $page_links .= '<li><a href="' . $url . '&page=' . ($cur_page - 1) . '">上一页</a></li>';
        } else {
            $page_links .= '<li class="disabled"><a>上一页</a></li> ';
        }

        $start = 1;
        $end = $num_pages;

        if ($num_pages > 10) {

            if ($cur_page <= 5) {
                $start = 1;
                $end = 10;
            } elseif ($num_pages - $cur_page < 4) {
                $start = $num_pages - 9;
                $end = $num_pages;
            } else {
                $start = $cur_page - 5;
                $end = $cur_page + 4;
            }
        }


        // Loop through the pages generating the page number links
        for ($i = $start; $i <= $end; $i++) {
            if ($cur_page == $i) {
                $page_links .= ' <li class="active"><a>' . $i . '</a></li>';
            } else {
                $page_links .= ' <li><a href="' . $url . '&page=' . $i . '"> ' . $i . '</a></li>';
            }
        }

        // If this page is not the last page, generate the "next" link
        if ($cur_page < $num_pages) {
            $page_links .= ' <li><a href="' . $url . '&page=' . ($cur_page + 1) . '">下一页</a></li>';
        } else {
            $page_links .= ' <li class="disabled"><a>下一页</a></li>';
        }

        echo $page_links;
        echo '<li><a href="' . $url . '&page=' . ($num_pages) . '">尾页</a></li>';

        echo '</ul>';
    }
    ?>

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
