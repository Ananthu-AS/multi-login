<?php require 'connection.php';

$divshow=false;
if(isset($_POST['email'])&&isset($_POST['passcode'])){        
    $email=$_POST['email'];
    $passcode=($_POST['passcode']);
    $sql='SELECT * FROM details WHERE email=:email';
    $statement=$connection->prepare($sql);
    $statement->execute([':email'=>$email]);
    $user=$statement->fetch(PDO::FETCH_ASSOC);
    if($user){
        $email_check=$user['email'];
        $passcode_check=$user['passcode'];
        if($email==$email_check && $passcode==$passcode_check && $user['approve']==1){ 
            if($user['status']=='admin'){
                header('location:./admin/dashbord.php');
                // $_SESSION['admin']=$email;
            }
            elseif($user['status']=='student' ){
                header('location:./student/dashbord.php');
            }
            // $_SESSION['email']=$email;
            else{
                header('location:./teacher/dashbord.php');  
            }                           
        } else{
            $divshow=true;
        }
    }
    else{
        $divshow=true;
    }                
}

?> 
<?php require 'header.php' ?>
<div class="container-fluid bg-secondary-subtle">
    <div class="min-vh-100 row p-0 m-0 align-items-center justify-content-center">
        <div class="w-50 ">
            <p class="text-center fs-1 fw-semibold mb-3">login</p>
            <div class="alert alert-danger" role="alert" style= display:<?php if ($divshow==false){echo "none";}else{echo "block";} ?>>
            incorrect email or password.
        </div>
            <form action="" method="POST">
                <div class="mb-3">
                    <input type="email" name="email" placeholder="email" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="text" name="passcode" placeholder="password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary p-2 form-control">
                </div>
                <div class="row p-0 m-0">
                    <div class="col-sm-6 m-0">
                        <a href="./student/register.php" class="btn btn-primary p-2 form-control bg-success" target="_blank">Signup as Student</a>
                    </div>
                    <div class="col-sm-6 m-0">
                        <a href="./teacher/register.php" class="btn btn-primary p-2 form-control bg-success" target="_blank">Signup as Teacher</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>