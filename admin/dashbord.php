<?php require '../connection.php';
    // $approve='NULL';
    $sql='SELECT * FROM details';
    $statement=$connection->prepare($sql);
    $statement->execute();
    $user=$statement->fetchAll(PDO::FETCH_OBJ);
    // if(isset($_SESSION['admin'])){
    //     $email=$_SESSION['admin'];
    //     // $name=$_SESSION['admin_name'];
    //     // $status=$_SESSION['admin_status'];
    //     $sql='SELECT * FROM details WHERE email=:email';
    //     $statement=$connection->prepare($sql);
    //     $statement->execute([':email'=>$email]);
    //     $user=$statement->fetchAll(PDO::FETCH_OBJ);
    //     unset($_SESSION['admin']);
        
    // }
    if(isset($_GET['accept'])){
        $email=$_GET['accept'];
        $approve=1;
        $sql='UPDATE details SET approve=:approve WHERE email=:email';
        $statement = $connection -> prepare($sql);
        $statement->execute([':email'=>$email,':approve'=>$approve]);        
    }
    elseif(isset($_GET['reject'])){
        $email=$_GET['reject'];
        $approve=2;
        $sql='UPDATE details SET approve=:approve WHERE email=:email' ;
        $statement = $connection -> prepare($sql);
        $statement->execute([':email'=>$email, ':approve'=>$approve]);
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
    <div class=" row p-0 m-0 justify-content-center align-items-center text-center ">
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
                <?php
                    endif; 
                    endforeach; 

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require '../footer.php' ?>