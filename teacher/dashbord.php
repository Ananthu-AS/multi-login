<?php require '../connection.php';
     if(!isset($_SESSION['email'])){
        header('location:../index.php');
    }
    else{
        $email=$_SESSION['email'];
        $sql_im='SELECT * FROM details WHERE email=:email';
        $statement=$connection->prepare($sql_im);
        $statement->execute([':email'=>$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
        session_destroy();

    }
    if(isset($_POST['pdf_submit'])){
        $batch=$_POST['batch'];
        $pdf=$_FILES['pdf']['name'];
        $temp=$_FILES['pdf']['tmp_name'];
        $target="../uploads/".basename($pdf);
        $sql='INSERT INTO pdf_files (files,batch) VALUES(:files,:batch)';
        $statement=$connection->prepare($sql);
        $statement->execute([':files'=>$pdf, ':batch'=>$batch ]);
        $move_pdf=move_uploaded_file($temp,$target);
    }
?> 
    
<?php require '../header.php' ?>
<div class="container-fluid bg-secondary-subtle ">
    <div class="container ">
        <div class="min-vh-100 row p-0 m-0 justify-content-center align-items-center">
           <!-- Button trigger modal -->
            <div class="text-end"> <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-right-from-bracket fs-1"></i>
            </button></div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a href="../index.php"> <button type="button" class="btn btn-primary">yes</button></a>
                    </div>
                </div>
            </div>
            </div>
               <div class="col-12 row p-0 m-0 justify-content-between align-items-center">
                    <div class="col-12 fs-1 text-center mb-5 fw-solid text-success">Teachers Login</div>
                    <div class="col-md-5 m-0 p-0">
                        <img src="../uploads/<?=$user['photo'] ?>" alt="" class="img-fluid">
                    </div>
                    
                    <div class="col-5 m-0 p-0 mt-5">
                        <form action=""  method="POST" enctype="multipart/form-data">
                            <div class="mb-3"><input type="file" class="form-control p-3" name="pdf" accept=".pdf"></div>
                            <div class="mb-3">
                                <select class="form-select p-3" aria-label="Default select example" name="batch">
                                    <option selected>Choose batch</option>
                                    <option value="computer science">computer science</option>
                                    <option value="mechanical">mechanical</option>
                                    <option value="electronics">electronics</option>
                                </select>
                            </div>
                            <div><input type="submit" class="form-control bg-success p-3" name="pdf_submit"></div>
                        </form>
                    </div>
                    <div class="col-md-5 m-0 p-0 mb-5">
                        <p class="fs-1 fw-bold mb-5"><?=$user['fname'].' '.$user['lname']?></p>
                        <p class="fs-1 fw-bold"><?=$user['email'] ?></p>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
<?php require '../footer.php' ?>