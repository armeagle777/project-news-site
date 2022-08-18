<?php
session_start();
//check login & password
if(isset($_SESSION['login']) && isset($_SESSION['password'])){
    if($_SESSION['login']!='log' && $_SESSION['password']!='pass'){
       header('location:admin.php');
    exit; 
    }
}else{
   header('location:admin.php');
    exit;
}

require_once('../inc/connect.php');
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
$descr=$row['descr'];
}else{
    $id= $_GET['id'];
    $sql = mysqli_query($con,"SELECT * FROM `news` WHERE `id`='$id'");
    if(mysqli_num_rows($sql)>0){
    $row = mysqli_fetch_assoc($sql);
    
    $title=$row['title'];
    $meta_d=mb_substr($row['descr'],0,140);
    $descr=$row['descr'];
    if($row['img']==''){
        $img = 'n2.jpg';
    }else{
        $img=$row['img'];
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
        <title>Control panel</title>
        <link rel="stylesheet" href="css/main.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/main.js"></script>
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
                            <li><a href="?page=add_news" <?php if($page=='add_news'){ ?> class='active'<?php } ?>>Ավելացնել նորություններ</a></li>
                            <li><a href="?page=about" <?php if($page=='about'){ ?> class='active'<?php } ?>>Մեր մասին</a></li>
                            <li><a href="?page=feedback" <?php if($page=='feedback'){ ?> class='active'<?php } ?>>Հետադարձ կապ</a></li>
                            <li><a href="inc/conf.php?cmd=exit" style="color:#CD000D">Դուրս գալ</a></li>
                        </ul>
                    </div>
                </div>
                <div id="content" class="white">
                    <?php include_once('inc/pages/'.$page.'.php');?>
                </div>
            </div>
           
        </div>
    </body>
</html>