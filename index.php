<?php

require_once('inc/connect.php');
 if(isset($_GET['page']) && file_exists('inc/pages/'.$_GET['page'].'.php')){
     $page=$_GET['page'];
 }else{
     $page='home';
 }
if($page != 'item'){
 $sql = mysqli_query($con,"SELECT * FROM `pages` WHERE `name`='$page'");
 $row = mysqli_fetch_assoc($sql);
$title=$row['title'];
$meta_d=$row['meta_d'];
$descr=nl2br($row['descr']);
}else{
    $id= $_GET['id'];
    $sql = mysqli_query($con,"SELECT * FROM `news` WHERE `id`='$id'");
    if(mysqli_num_rows($sql)>0){
    $row = mysqli_fetch_assoc($sql);
    
    $title=$row['title'];
    $meta_d=mb_substr($row['descr'],0,140);
    $descr=nl2br($row['descr']);
    if($row['img']==''){
        $img = '';
    }else{
        $img='<img src="photos/news/larg/'.$row['img'].'" class="photo">';
    }
    $full_date=$row['date'];
        list($date, $time)=explode(' ',$full_date);
        list($year,$month,$day)=explode('-',$date);
        list($hour,$minute,$seconds)=explode(':',$time);
        $date_time=$hour.":".$minute." ".$day."."."$month".".".$year;
 }else{
    header('location:index.php');
        exit;
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?=$meta_d?>">
        <title><?=$title?></title>
        <link rel="stylesheet" href="css/main.css">
        <?php if($page=='feedback'){ ?>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
        <?php } ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header"></div>
            <div id="container">
                <div id="aside" class="white">
                    <div class="nav">
                        <h3>Մենյու</h3>
                        <ul>
                            <li><a href="index.php">Գլխավոր</a></li>
                            <li><a href="?page=news" <?php if($page=='news'){ ?> class='active'<?php } ?>>Նորություններ</a></li>
                            <li><a href="?page=about" <?php if($page=='about'){ ?> class='active'<?php } ?>>Մեր մասին</a></li>
                            <li><a href="?page=feedback" <?php if($page=='feedback'){ ?> class='active'<?php } ?>>Հետադարձ կապ</a></li>
			    <li><a href='http://35.193.181.94/my_projects/news_site/admin/index.php'>Admin</a></li>
                        </ul>
                    </div>
                </div>
                <div id="content" class="white">
                    <?php include_once('inc/pages/'.$page.'.php');?>
                </div>
            </div>
            <div id="footer">
                &#169 2018 PHP MySQL
            </div>
        </div>
    </body>
</html>