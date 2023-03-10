<?php require 'connection.php';
    $divshow=FALSE;
    if(isset($_POST['email'])&&isset($_POST['reset'])){
        $email=$_POST['email'];
        $sql='SELECT * FROM details WHERE email=:email';
        $statement=$connection->prepare($sql);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
        if($user){
            $email=$user['email'];
            $tocken=md5(rand());
        }
        else{
            $divshow=TRUE;
        }
    }
?>
<?php require 'header.php' ?>
<div class="container min-vh-100">
    <div class="row p-0 m-0 justify-content-center ">
        <div class="w-50 text-center mt-5 py-5  bg-primary-subtle rounded-4">
            <div class="mt-3">password reset</div>
            <div class="alert alert-danger" role="alert" style= display:<?php if ($divshow==FALSE){echo "none";}else{echo "block";} ?>>
            incorrect email Id.
            </div>
            <form action="" method="POST">
                <div class="mt-3"><input type="email" name="email" class="form-control p-3" placeholder="email"></div>
                <div class="mt-3"><input type="submit" name="reset" class="form-control bg-primary p-3" value="reset password"></div>
            </form>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>