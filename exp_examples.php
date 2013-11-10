<?php
$examples = array(
    '中药' => array(
        "车前子",
        "雷竹笋",
        "赤阳子",
        "柴胡",
        "蚕茧",
        "瓦夏嘎",
        "姜黄",
        "苦瓜",
        "熊胆",
        "桑叶",
        "赤芍",
        "大黄",
        "川芎",
        "翻白草",
        "人参",
        "仙人掌",
        "鸡血藤",
        "焮麻",
        "三七",
        "哇夏嘎",
        "红松籽油",
        "地骨皮",
        "冬虫夏草",
        "杜仲",
        "黄耆",
        "牛蒡子",
        "青头菌",
        "冰片",
        "丹参",
        "马齿苋",
        "阔叶缬草",
        "玉米苞叶",
        "滇高良姜",
        "香蕈",
        "茶树根",
        "荷叶",
        "苦叶茶",
        "毛头鬼伞",
        "核桃仁",
        "珍珠母",
        "千金藤",
        "辛夷",
        "岩景天",
        "红豆蔻",
        "苦丁茶",
        "螺旋藻",
        "田七人参",
        "郁金",
        "水母雪莲花"
    )
);
?>

<div class="container">

    <?php
    foreach ($examples as $cls => $instances) {
        ?>
        <div class = "panel panel-info">
            <div class = "panel-heading">
                <h3 class = "panel-title"><?php echo $cls; ?></h3>
            </div>

            <ul class="nav nav-pills">

                <?php
                foreach ($instances as $instance) {
                    echo '<li><a href = "d2rm.php?type=' . $cls . '&name=' . $instance . '">' . $instance . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>

</div>