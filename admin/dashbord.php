<?php require '../connection.php';
    if(!isset($_SESSION['email'])){
        header('location:../index.php');
    }
    else{
        $sql='SELECT * FROM details';
        $statement=$connection->prepare($sql);
        $statement->execute();
        $user=$statement->fetchAll(PDO::FETCH_OBJ);
        session_destroy();
    }
    if(isset($_GET['accept'])){
        $email=$_GET['accept'];
        $approve=1;
        $sql='UPDATE details SET approve=:approve WHERE email=:email';
        $statement = $connection -> prepare($sql);
        $statement->execute([':email'=>$email,':approve'=>$approve]);
        header('location:./dashbord.php');        
    }
    elseif(isset($_GET['reject'])){
        $email=$_GET['reject'];
        $approve=2;
        $sql='UPDATE details SET approve=:approve WHERE email=:email' ;
        $statement = $connection -> prepare($sql);
        $statement->execute([':email'=>$email, ':approve'=>$approve]);
        header('location:./dashbord.php');
    }
    // else{
    //     $approve='NULL';
    //     $sql='UPDATE details SET approve=:approve WHERE email=:email';
    //     $statement = $connection -> prepare($sql);
    //     $statement->execute([':approve'=>$approve]);
    // }
?>
<?php require '../header.php' ?>
<div class="container">
    <div>
        <!-- Button trigger modal -->
        <div class="text-end"> <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-right-from-bracket fs-1"></i>
            </button>
        </div>
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
    <div class=" row p-0 m-0 justify-content-center align-items-center text-center ">
        <h1 class="text-center text-success mb-5">Admin Page</h1>
        <div class="w-50 bg-primary-subtle">
            
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan="2">Approval</th>                
                    </tr>
                </thead>
                <tbody>
                <?php
                    if($user):
                        foreach ($user as $detail): 
                            if($detail->approve==NULL):
                        ?>
                            <tr>
                                <td><?=$detail->fname; ?></td>
                                <td><?=$detail->lname; ?></td>
                                <td><?=$detail->email; ?></td>
                                <td><?=$detail->status; ?></td>
                                <td>
                                    <a href="./dashbord.php?accept=<?=$detail->email; ?>" class="btn btn-success">Accept</a>                              
                                </td>
                                <td>
                                    <a href="./dashbord.php?reject=<?=$detail->email; ?>" class="btn btn-danger" >Reject</a>
                                </td>                    
                            </tr>
                            <?php endif;  ?>
                        <?php  endforeach; ?>
                    <?php else:?>
                        <h1 class="text-success text-center"> NO Approval pending</h1>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require '../footer.php' ?>