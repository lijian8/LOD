<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
include_once ("./hypo_helper.php");

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







function get_total($dbc, $subject, $predicate, $object) {
    $query = build_query($dbc, $subject, $predicate, $object, true);
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['count'];
    return $total;
}

function build_query($dbc, $subject, $predicate, $object, $count_only = false) {

    if ($count_only) {
        $query = "SELECT count(*) as count FROM hypo";
    } else {
        $query = "SELECT description, evidence FROM hypo";
    }


    $where_clauses = array();

    if (isset($subject) && ($subject != '')) {
        $where_clauses[] = "subject='$subject'";
    }

    if (isset($predicate) && ($predicate != '')) {
        $where_clauses[] = "property='$predicate'";
    }

    if (isset($object) && ($object != '')) {
        $where_clauses[] = "value='$object'";
    }

    if (count($where_clauses) != 0) {
        $where = implode(' and ', $where_clauses);
        $query .= " where " . $where;
    }

    //$query .= " order by count desc ";

    return $query;
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
$url = 'hypo.php?db_name=' . $db_name . '&subject=' . $subject . '&predicate=' . $predicate . '&object=' . $object;
$subject_link = render_value($dbc, $db_name, $subject, $with_def = false);
$object_link = render_value($dbc, $db_name, $object, $with_def = false);

?>

<div class="container">
    <h1><?php echo $subject_link . "&nbsp;" . $predicate . "&nbsp;" . $object_link; ?></h1>
     
    <p></p>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#">推理依据</a></li>           
        <li><a href="sn_relation_search.php?db_name=<?php echo $db_name; ?>">Baidu</a></li>       
    </ul>
    <p></p>
    <table class="table">
       
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
                echo '<td width = "12%">' . $row['0'] . '：&nbsp;</td>';
                echo '<td>';
                $triples = explode('|', $row['1']);
                foreach ($triples as $triple){
                    if (triple != ''){
                        render_triple($dbc, $db_name, $triple);
                    }
                }
                
                
                echo '</td>';
              
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

    

    <?php
    include_once ("./foot.php");
    ?>
