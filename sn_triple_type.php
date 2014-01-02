<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

function get_header($dbc, $type) {
    $query = "SELECT * FROM semantic_network where id=" . $type;
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    return mysqli_fetch_array($result);
}

function get_total($dbc, $type) {
    $query = build_query($dbc, $type, true);
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['count'];
    return $total;
}

function build_query($dbc, $type, $count_only = false) {

    if ($count_only) {
        $query = "SELECT count(*) as count FROM triple_type WHERE type = " . $type;
    } else {
        $query = "SELECT * FROM triple_type t, graph g where t.triple = g.id and t.type = " . $type . " order by subject, value";
    }

    return $query;
}

$type = $_GET['type'];
$header = get_header($dbc, $type);

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
$results_per_page = 10;  // number of results per page
$skip = (($cur_page - 1) * $results_per_page);
$total = get_total($dbc, $type);

$num_pages = ceil($total / $results_per_page);


$url = $_SERVER['PHP_SELF'] . '?db_name=' . $db_name . '&type=' . $type;
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
    $sn_name = $db_name;
    include_once ("sn_header.php");
    ?>  
    <p></p>
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $db_labels[$db_name]; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="sn_profile.php?db_name=<?php echo $db_name; ?>">按语义类型浏览</a></li>
                <li><a href="sn_relation_search.php?db_name=<?php echo $db_name; ?>">语义关系搜索</a></li>                   
            </ul>          
        </div><!-- /.navbar-collapse -->
    </nav>
    <p>
        （<?php echo $header['subject'] . ',' . $header['property'] . ',' . $header['object']; ?>）在系统中共有<?php echo $total; ?>条实例：</p>



    <!--
    <div class="panel panel-info">
        <div class="panel-heading">
             
        </div>


    </div>
    -->

    <p></p>

    <table class="table">
        <thead>
        <th width="4%" >#</th>
        <th width="32%" ><?php echo $header['subject']; ?></th>
        <th width="32%" ><?php echo $header['property']; ?></th>
        <th width="32%" ><?php echo $header['object']; ?></th> 


        </thead>
        <tbody>

            <?php
            $query = build_query($dbc, $type) . " LIMIT $skip, $results_per_page";

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



                echo '<td>' . render_value($dbc, $db_name, $row['subject'], true) . '</td>';
                echo '<td>' . $row['property'] . '</td>';
                echo '<td>' . render_value($dbc, $db_name, $row['value'], true) . '</td>';

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