<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



if(isset($_GET['del']))
      {
              mysqli_query($bd, "delete from students where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Usuario Deletado !!";
      }

     if(isset($_GET['pass']))
      {
        $password="12345";
        $newpass=md5($password);
              mysqli_query($bd, "update students set password='$newpass' where StudentRegno = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Senha resetada para 12345!";
      } 
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>INU - Institute National Underground</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
   
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
   
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Gerenciador de Usuarios  </h1>
                    </div>
                </div>
                <div class="row" >
                 
                <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gerenciador de Ususarios
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome de Usuario </th>
                                            <th>Nome do Estudante </th>
                                            <th> Codigo</th>
                                             <th>Data de Login</th>
                                             <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($bd, "select * from students");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['StudentRegno']);?></td>
                                            <td><?php echo htmlentities($row['studentName']);?></td>
                                            <td><?php echo htmlentities($row['pincode']);?></td>
                                            <td><?php echo htmlentities($row['creationdate']);?></td>
                                            <td>              
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&del=delete" onClick="return confirm('Você tem certeza que deseja excluir?')">
                                            <button class="btn btn-danger">Deletar</button>
</a>
<a href="manage-students.php?id=<?php echo $row['StudentRegno']?>&pass=update" onClick="return confirm('Tem certeza que deseja o reset de senha?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Resetar Senha</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>





        </div>
    </div>
    
  <?php include('includes/footer.php');?>
    
    <script src="assets/js/jquery-1.11.1.js"></script>
    
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
