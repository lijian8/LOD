<?php

function generate_where_clause($final_search_words, $column) {
    $where_list = array();

    foreach ($final_search_words as $word) {
        $where_list[] = "$column LIKE '%$word%'";
    }

    return implode(' OR ', $where_list);
}

function build_query($dbc, $user_search, $active_relation, $count_only = false) {

    if ($count_only) {
        $search_query = "SELECT count(*) as count FROM graph";
    } else {
        $search_query = "SELECT * FROM graph";
    }

    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
        foreach ($search_words as $word) {
            if (!empty($word)) {
                //$final_search_words[] = $word;
                foreach(get_ids($dbc, $word) as $id){
                    $final_search_words[] = PREFIX . $id;
                } 
                $final_search_words[] = $word;                
            }
        }
    }
    //print_r($final_search_words);

    if (isset($active_relation)) {
        $where_clause_1 = "property='" . $active_relation . "'";
    }

    if (count($final_search_words) > 0) {
        $subject = generate_where_clause($final_search_words, 'subject');
        $object = generate_where_clause($final_search_words, 'value');
        //$predicate = generate_where_clause($final_search_words, 'property');
        $where_clause_2 = $subject . ' OR ' .  $object;
    }

    if (isset($where_clause_1) && isset($where_clause_2)) {
        $search_query .= " WHERE $where_clause_1 and ($where_clause_2)";
    } elseif (isset($where_clause_2)) {
        $search_query .= " WHERE $where_clause_2";
    } elseif (isset($where_clause_1)) {
        $search_query .= " WHERE $where_clause_1";
    }

    $search_query .= " ORDER BY subject desc";
    return $search_query;
}



function get_total($dbc, $keywords,  $active_relation, $dbc) {
    $query = build_query($dbc, $keywords, $active_relation, true);
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $total = $row['count'];
    return $total;
}

$keywords = $_GET['keywords'];
$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
$results_per_page = 10;  // number of results per page
$skip = (($cur_page - 1) * $results_per_page);
$total = get_total($dbc, $keywords, $active_relation, $dbc);
$num_pages = ceil($total / $results_per_page);

$url = $_SERVER['PHP_SELF'] . '?db_name=spleen&' . 'active_relation=' . $active_relation . '&keywords=' . $keywords;
?>
<p></p>
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">关系管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">

                <li><a href="upload.php"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;导出RDF</a></li>               

            </ul>
            <form class="navbar-form navbar-left" method="get" role="search" action="<?php echo $url; ?>"  enctype="multipart/form-data">
                <input type="hidden" id="db_name" name ="db_name" value="<?php echo $db_name; ?>"></input>
                <input type="hidden" id="active_relation" name ="active_relation" value="<?php echo $active_relation; ?>"></input>

                <div class="form-group">
                    <input type="text" class="form-control" id="keywords" name ="keywords" <?php if (isset($keywords)) echo 'value="'.$keywords.'"';?> placeholder="输入关键词...">
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;搜索</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" ><font color="gray">获得约 <?php echo $total; ?> 条结果。</font></a></li>
                <li><a href="#" >返回首页</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>

    <table class="table table-hover">
        <tbody>
            <tr class="info">
                <td>#</td>
                <td ><strong>主体</strong></td>
                <td><strong>谓词</strong></td>
                <td><strong>客体</strong></td>

                <!--<td><strong>操作</strong></td>-->

            </tr>

            <?php
            //$query = "SELECT * FROM relation ORDER BY value DESC LIMIT 0,100";
            $query = build_query($dbc, $keywords, $active_relation) . " LIMIT $skip, $results_per_page";

            //$query = build_query($keywords) . ' LIMIT 0,100';
            
            $data = mysqli_query($dbc, $query);

            $row_num = 1;
            $color = true;
            while ($row = mysqli_fetch_array($data)) {
                if ($color) {
                    echo '<tr>';
                } else {
                    echo '<tr class="info">';
                }
                $color = !$color;

                echo '<td width = "3%">' . $row_num++ . '</td>';
                
                
                
                echo '<td width = "40%">' . render_value($dbc, $db_name, $row['subject'], true) . '</td>';
                echo '<td width = "15%">' . $row['property'] . '</td>';
                echo '<td width = "40%">' . render_value($dbc, $db_name, $row['value'], true) . '</td>';
                //echo '<td width = "12%">';
                //echo '<a class="btn btn-primary btn-xs" href="relation.php?id=' . $row['id'] . '"><span class="glyphicon glyphicon-search"></span>&nbsp;查看</a>';
                //echo '&nbsp
                //echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($num_pages > 1) {
        
        $page_links = '';

        echo '<ul class="pagination">';

        echo '<li><a href="' . $_SERVER['PHP_SELF'] . '?db_name=spleen&' . 'active_relation=' . $active_relation . '&keywords=' . $keywords . '&page=' . (1) . '">首页</a></li>';

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
                $page_links .= ' <li><a href="' . $url .  '&page=' . $i . '"> ' . $i . '</a></li>';
            }
        }

        // If this page is not the last page, generate the "next" link
        if ($cur_page < $num_pages) {
            $page_links .= ' <li><a href="' . $url .  '&page=' . ($cur_page + 1) . '">下一页</a></li>';
        } else {
            $page_links .= ' <li class="disabled"><a>下一页</a></li>';
        }

        echo $page_links;
        echo '<li><a href="' . $url .  '&page=' . ($num_pages) . '">尾页</a></li>';

        echo '</ul>';
    }
    ?>


</div> 
<?php
include_once ("./foot.php");
?>