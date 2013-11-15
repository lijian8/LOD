<?php
include_once ("./header.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
include_once ("./hypo_helper.php");

function get_names($user_search) {

    $clean_search = str_replace(',', ' ', $user_search);
    $clean_search = str_replace('，', ' ', $clean_search);
    $search_words = explode(' ', $clean_search);
    $final_search_words = array();
    if (count($search_words) > 0) {
        foreach ($search_words as $word) {
            if (!empty($word)) {
                $final_search_words[] = $word;
            }
        }
    }
    return $final_search_words;
}

function render_content($row) {
    $name = $row[name];
    $id = $row[id];
    $def = $row[def];
    echo "<p><a href=\"entity.php?id=$id\">$name</a></p>";

    echo $def;


    echo '<a class="btn btn-link" href="#" role="button">查看详情&nbsp; &raquo;</a>';

    echo "<hr>";
}

function render_entity($dbc, $keywords) {
    $query = "SELECT * FROM def where name = '$keywords'";
    $result = mysqli_query($dbc, $query) or die('Error querying database.');
    if ($row = mysqli_fetch_array($result)) {

        render_content($row);
    }
}

$keywords = $_GET['keywords'];
$question_type = $_GET['question_type'];
?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form class="form-search" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form-horizontal"
              enctype="multipart/form-data">
            <input type="hidden" id ="db_name" name ="db_name" value="<?php echo $db_name; ?>">

            <div class="container" >
                <p></p>
                <div class="row">
                    <div class="col-md-3">
                        <img width="100%" class="media-object" src="img/qa_logo.jpg" >                    
                    </div>   
                    <div class="col-md-9">
                        <p></p>
                        <div class="input-group">

                            <input type="text" id ="keywords" name ="keywords" class="form-control  input-lg" placeholder="请输入您的问题......"  value ="<?php if (isset($keywords)) echo $keywords; ?>">
                            <span class="input-group-btn">
                                <button name ="submit" type="submit" class="btn btn-primary  btn-lg"><span class="glyphicon glyphicon-search"></span>&nbsp;提问</button>

                            </span> 

                        </div> 
                        <p></p>

                        <label>
                            <input type="radio" name="question_type" id="question_type" value="症状" <?php if (isset($question_type) && ($question_type == '症状')) echo 'checked'; ?>>&nbsp;症状
                        </label>
                        &nbsp;&nbsp;


                        <label>
                            <input type="radio" name="question_type" id="question_type" value="证候"  <?php if (isset($question_type) && ($question_type == '证候')) echo 'checked'; ?>>&nbsp;证候
                        </label>
                        &nbsp;&nbsp;

                        <label>
                            <input type="radio" name="question_type" id="question_type" value="疾病" <?php if (isset($question_type) && ($question_type == '疾病')) echo 'checked'; ?>>&nbsp;疾病
                        </label>
                        &nbsp;&nbsp;

                        <label>
                            <input type="radio" name="question_type" id="question_type" value="证候加减" <?php if (isset($question_type) && ($question_type == '证候加减')) echo 'checked'; ?>>&nbsp;证候加减
                        </label>

                    </div>
                </div>
                <p>
                <hr>


                </p>
                <!--
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>回答</strong>
                    </div>
                    <div class="panel-body">
                !-->
                <?php
                if ($question_type == '症状') {
                    include('qa_symptom.php');
                } elseif ($question_type == '证候') {
                    include('qa_syndrome.php');
                } elseif ($question_type == '疾病') {
                    include('qa_disease.php');
                } elseif ($question_type == '证候加减') {
                    include('qa_syndrome_plus.php');
                }
                ?>
                <!--
                    </div>
                </div>
               

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>问题</strong>
                    </div>
                    <div class="panel-body">
                        <p><strong>患者还有如下症状吗？</strong></p>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1"> 怒
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox2" value="option2"> 燥怒
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3"> 失眠
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3"> 惊恐
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox3" value="option3"> 腹泻
                        </label>

                        <hr>
                        <p><strong>您选择哪种治法？</strong></p>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1"> 疏肝补脾法
                        </label>
                        <hr>
                        <p><strong>您选择哪种处方？</strong></p>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" value="option1"> 柴胡疏肝汤
                        </label>
                    </div>
                </div>
                -->
            </div>
        </form>   
    </div>
</div>

<?php
include_once ("./foot.php");
?>

