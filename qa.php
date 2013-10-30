<?php
include_once ("./header.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

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

if (isset($_GET['submit'])) {
    $keywords = $_GET['keywords'];
    $question_type = $_GET['question_type'];
}
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
                            <input type="radio" name="question_type" id="question_type" value="symptom" <?php if (isset($question_type) && ($question_type == 'symptom')) echo 'checked'; ?>>&nbsp;症状
                        </label>
                        &nbsp;&nbsp;


                        <label>
                            <input type="radio" name="question_type" id="question_type" value="syndrome"  <?php if (isset($question_type) && ($question_type == 'syndrome')) echo 'checked'; ?>>&nbsp;证候
                        </label>
                        &nbsp;&nbsp;

                        <label>
                            <input type="radio" name="question_type" id="question_type" value="disease" <?php if (isset($question_type) && ($question_type == 'disease')) echo 'checked'; ?>>&nbsp;疾病
                        </label>
                        &nbsp;&nbsp;

                        <label>
                            <input type="radio" name="question_type" id="question_type" value="syndrome_plus" <?php if (isset($question_type) && ($question_type == 'syndrome_plus')) echo 'checked'; ?>>&nbsp;证候加减
                        </label>

                    </div>
                </div>
                <p>
                    <?php
                    $query = "select id, def from def where name ='$keywords'";
                    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
                    if ($row = mysqli_fetch_array($result)) {
                        $id = $row[id];
                    } else {
                        render_warning('无相关实体信息！');
                    }

                    //print_r (get_values($dbc, PREFIX . $id, "由...组成"));
                    $values = array_merge(get_subjects($dbc, PREFIX . $id, "组成"), get_values($dbc, PREFIX . $id, "由...组成"), get_subjects($dbc, PREFIX . $id, "由...组成"),get_values($dbc, PREFIX . $id, "组成"));
                    
                    print_r ($values);
                    //print_r( get_subjects($dbc, PREFIX . $id, "组成"));


                    render_panel($dbc, $db_name, "组成", $values);


//echo  $keywords . ":&nbsp;" . $question_type; 
                    ?>
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>答案</strong>
                    </div>
                    <div class="panel-body">
                        <p><strong>辨证:</strong></p>
                        患者有证候<a>肝气郁结证</a>、<a>肝气不运证</a>、<a>肝郁脾虚证</a>、<a>血瘀证</a>。
                        <hr>
                        <p><strong>立法:</strong></p>
                        患者的治法为<a>疏肝补脾法</a>。
                        <hr>
                        <p><strong>处方:</strong></p>
                        患者的处方为<a>柴胡疏肝汤</a>。
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
            </div>
        </form>   
    </div>
</div>

<?php
include_once ("./foot.php");
?>

