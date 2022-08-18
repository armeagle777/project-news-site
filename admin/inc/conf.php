<?php
session_start();
require_once('../../inc/connect.php');
require_once('simpleImage.php');
 if($_GET['cmd'] == 'edit_page'){
     $page=$_GET['page'];  
     $meta_d=trim(htmlspecialchars($_POST['meta_d']));
     $descr=trim(htmlspecialchars($_POST['descr']));
     
     
     $update=mysqli_query($con,"UPDATE `pages` SET `meta_d`= '$meta_d', `descr`= '$descr' WHERE `name`='$page'");
            if($update){
                header('location:../index.php?page='.$page.'$result=1');
            }else{
                 header('location:../index.php?page='.$page.'$result=0');
            }
                          exit;
  }

if($_GET['cmd'] == 'add_news'){
     $title=trim(htmlspecialchars($_POST['title']));
     $descr=trim(htmlspecialchars($_POST['descr']));
     $img= '';
     
     $add=mysqli_query($con, "INSERT INTO `news` (`title`,`descr`, `img`,`date`) VALUES ('$title','$descr','$img',now())");
     $id=mysqli_insert_id($con);
    if($_FILES['img']['size']>0){
        $img='n3.jpg';
        // $image= new SimpleImage();
        // $image->load($_FILES['img']['tmp_name']);
        // $image->crop(130,130);
        // $image->save('../../photos/news/thumbs/'.$img.'');
        // $image->load($_FILES['img']['tmp_name']);
        // $image->resizeToWidth(660);
        // $image->save('../../photos/news/larg/'.$img.'');
        mysqli_query($con,"UPDATE `news` SET `img` = '$img' WHERE `id` = '$id'");
        
    }
            if($add){
                header('location:../index.php?page=news&$result=1');
            }else{
                 header('location:../index.php?page=news&$result=0');
            }
                          exit;
  }
//Edit news
if($_GET['cmd'] == 'edit_news'){
     $title=trim(htmlspecialchars($_POST['title']));
     $id=$_GET['id'];
     $descr=trim(htmlspecialchars($_POST['descr']));
     
    
 
    if($_FILES['img']['size']>0){
        $img=$id.'.jpg';
        $image= new SimpleImage();
        $image->load($_FILES['img']['tmp_name']);
        $image->crop(130,130);
        $image->save('../../photos/news/thumbs/'.$img.'');
        $image->load($_FILES['img']['tmp_name']);
        $image->resizeToWidth(660);
        $image->save('../../photos/news/larg/'.$img.'');
        mysqli_query($con,"UPDATE `news` SET `img` = '$img' WHERE `id` = '$id'");
        
    }
     $update=mysqli_query($con,"UPDATE `news` SET `title` = '$title',`descr` = '$descr' WHERE `id` = '$id'");
            if($update){
                header('location:../index.php?page=news&$result=1');
            }else{
                 header('location:../index.php?page=news&$result=0');
            }
                          exit;
  }

//delete news
if($_GET['cmd'] == 'delete_news'){
    $img=$id.'.jpg';
     $id=$_GET['id'];
    $sql = mysqli_query($con,"SELECT `img` FROM `news` WHERE `id`='$id'");
    $row = mysqli_fetch_assoc($sql);
    if($row['img'] != ''){
        unlink('../../photos/news/larg/'.$img.'');
        unlink('../../photos/news/thumbs/'.$img.'');
    }
 
    
     $delete=mysqli_query($con,"DELETE FROM `news` WHERE `id` = '$id'");
            if($delete){
                header('location:../index.php?page=news&$result=1');
            }else{
                 header('location:../index.php?page=news&$result=0');
            }
                          exit;
  }
if($_GET['cmd']=='exit'){
    session_destroy();
    header('location:../admin.php');
    exit;   
}
?>