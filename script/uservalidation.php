<?php
if(isset($_POST['login_submission'])){
$email=$_POST['login_email'];
$password=$_POST['login_password'];

 echo  loginValidator($email, $password);
}

else if(isset($_POST['logon_submission'])){
$nome=$_POST['logon_firstname'];
$apelido=$_POST['logon_nickname'];
$email=$_POST['logon_email'];
$password=$_POST['logon_password'];
$tel=$_POST['logon_tel'];
$sexo=$_POST['logon_sexo'];
$data=$_POST['logon_data'];

    saveLogon($nome,$apelido,$email,$password,$tel,$sexo,$data);
}

function loginValidator($email,$password){
    $resposta="false";
    $arquivo="bd.txt";
    $reader=fopen($arquivo,"r");

    while(!feof($reader)){
        $linha=fgets($reader);
        if(strpos($linha,"@gmail.com")){
            $emailtry=trim($linha);
            $linha=fgets($reader);
            $passwordtry=trim($linha);
            
            if($email==$emailtry){
              
                if($password==$passwordtry){
                     $resposta=true;  
                              
                    break;
                }               
            }else{
                $resposta=false;
            }
        }
    }

    if($resposta==true){
        header("Location: ../view/user-page.html");
        exit;
    }else{
      
    
          echo "<h1 style='background-color: red;'>Email ou Senha errada</h1>";   
    }

    fclose($reader);
}


function saveLogon($nome,$apelido,$email,$password,$tel,$sexo,$data){
    $new_user=array($nome,$apelido,$email,$password,$tel,$sexo,$data);
    $arquivo="bd.txt";
    $writer=fopen($arquivo,'a');

    for($i=0;$i<sizeof($new_user);$i++){
    fwrite($writer,$new_user[$i]."\n");
    }
    fwrite($writer,"\n");
    fclose($writer);
}
?>
