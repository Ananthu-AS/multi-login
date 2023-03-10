<?php require '../connection.php';
    $val=FALSE;
    if(isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['passcode'])&&isset($_POST['con_passcode'])&&isset($_POST['trsubmit'])){
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $batch=$_POST['batch'];
            $status='teacher';
            $passcode=md5($_POST['passcode']);
            $con_passcode=md5($_POST['con_passcode']);
            // image
            $image=$_FILES['image']['name'];
            $temp=$_FILES['image']['tmp_name'];
            $target="../uploads/".basename($image);

            $sql='SELECT email FROM details WHERE email=:email';
            $statement=$connection->prepare($sql);
            $statement->execute([':email'=>$email]);
            $data=$statement->fetch(PDO::FETCH_ASSOC);
            if($data){
                $val=TRUE;
            }
            elseif($passcode!=$con_passcode){
                $_SESSION["message"]="password does not match.";
                $_SESSION["session_code"]="warning";
                $_SESSION["page"]="registration.php";
            }
            else{
                $sql='INSERT INTO details (fname,lname,email,passcode,status,photo,batch) VALUES(:fname, :lname,:email, :passcode, :status, :image, :batch)';
                $statement=$connection->prepare($sql);
                $statement->execute([':fname'=>$fname, ':lname'=>$lname, ':passcode'=>$passcode, ':email'=>$email, ':image'=>$image, ':status'=>$status, ':batch'=>$batch ]);
    
                $_SESSION["message"]="Data updated successfully.";
                $_SESSION["session_code"]="success";
                $_SESSION["page"]="../index.php";
                $move_pic=move_uploaded_file($temp,$target);                
            } 
        }
?> 
<?php require '../header.php' ?>
<div class="container-fluid bg-secondary-subtle">
    <div class="min-vh-100 row p-0 m-0 align-items-center justify-content-center">
        <div class="w-50 ">
            <p class="text-center fs-1 fw-semibold mb-3">Teacher Registration</p>
            <?php if($val){
                    echo "<div class='alert alert-danger' role='alert'>
                    Email alredy exists.
                  </div>";
                }  ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="fname" placeholder="First name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="lname" placeholder="Last name" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="email" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="password" name="passcode" placeholder="password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="password" name="con_passcode" placeholder="Confirm password" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="file" name="image" placeholder="" class="form-control">
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example" name="batch">
                        <option selected>Choose batch</option>
                        <option value="computer science">computer science</option>
                        <option value="mechanical">mechanical</option>
                        <option value="electronics">electronics</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary p-2 form-control" name="trsubmit">
                </div>
                <div class="mb-3">
                    <a href="../index.php" class="btn btn-success p-2 form-control">Already Registered.</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require '../footer.php' ?>