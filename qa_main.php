<?php
include_once ("./header.php");
?>

<form class="form-search" action="qa.php" method="get" class="form-horizontal"
      enctype="multipart/form-data">
    <input type="hidden" id ="db_name" name ="db_name" value="spleen">

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" align="center" >
            <img width="60%" class="media-object" src="img/qa_wide.jpg" >
            <p></p> 
            <div class="input-group">
                <input type="text" id ="keywords" name ="keywords" class="form-control input-lg" placeholder="关于......">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-lg" name ="submit" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span> 
            </div> 
            <br>

            <label>
                <input type="radio" name="question_type" id="question_type" value="symptom" checked>&nbsp;症状
            </label>
            &nbsp;&nbsp;


            <label>
                <input type="radio" name="question_type" id="question_type" value="syndrome">&nbsp;证候
            </label>
            &nbsp;&nbsp;

            <label>
                <input type="radio" name="question_type" id="question_type" value="disease">&nbsp;疾病
            </label>
            &nbsp;&nbsp;

            <label>
                <input type="radio" name="question_type" id="question_type" value="syndrome_plus">&nbsp;证候加减
            </label>

            <br><br>
            <p><a  href="search.php">语义查询</a>&nbsp;<span class="label label-danger">新功能!</span>&nbsp;-&nbsp;<a href="search.php">举例</a>&nbsp;-&nbsp;<a href="search.php">帮助</a></p>
        </div>
    </div>
</form>
<br>
<br>
<br>
<?php
include_once ("./foot.php");
?>
