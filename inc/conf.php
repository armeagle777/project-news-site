<?php
 if($_GET['cmd'] == 'feedback'){
     
     $name=trim(htmlspecialchars($_POST['name']));
     $email=trim(htmlspecialchars($_POST['email']));
     $phone=trim(htmlspecialchars($_POST['phone']));
     $message=trim(htmlspecialchars($_POST['message']));
     
     $to='mail@mail.ru';
     $subject='Հետադարձ կապ';
     $body='
     <html>
        <body>
            <h2>Հետադարձ կապ</h2>
            <hr>
            <p>Անուն՝ '.$name.'</p>
            <p>Էլ. փոստ<br>'.$email.'</p>
            <p>Հեռախոս<br>'.$phone.'</p>
            <p>նամակ<br>'.$message.'</p>
        </body>
     </html>';
     $headers  = "From: My site <".$email.">\r\n"; 
     $headers .= "Reply-To: ".$email."\r\n";
     $headers .= "MIME-Version: 1.0\r\n";
     $headers .= "Content-type: text/html; charset=utf-8";
     $send=mail($to,$subject,$body,$headers);
     if($send){
         header('location:../index.php?page=feedback&result=1');
     }else{
         header('location:../index.php?page=feedback&result=0');
     }
 }
?>