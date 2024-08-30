<?php include 'inc/header.php';

    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    if ($_SESSION['login'] != 'Success'){header('location:login.php');}
    require_once ('classes/DataBase.php');
    require_once ('classes/Session.php');
    $sess = new Session;
    $errors = $sess->get('errors');
?>
 ?>
<div class="container my-5">

    <div class="row">
    <div>
    <?php 
    if ($errors != null && is_array($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
        $sess->clear('errors');
    }
    ?>
    </div>
    <?php $products = DataBase::GetAllProducts(); ?>
    <?php foreach ($products as $p) { ?>
    <div class="col-lg-4 mb-3">

        
            <div class="card">
            <img src='images/<?php echo $p->getImage()?>' class="card-img-top">
            <div class="card-body">
            <h5 class="card-title"><?php echo $p->getName()?></h5>
            <p class="text-muted"><?php echo $p->getPrice()?> EGP</p>
            <p class="card-text"><?php echo $p->getDescription() ?></p>
            <a href="show.php?id=<?php echo $p->getId()?>" class="btn btn-primary">Show</a>

            <a href="edit.php?id=<?php echo $p->getId()?>" class="btn btn-info">Edit</a>
            <a href="handlers/DeleteProduct.php?id=<?php echo $p->getId();?>" class="btn btn-danger">Delete</a>

            </div>
        </div>
        
    </div>
    <?php } ?>
        
    </div>

</div>



<?php include 'inc/footer.php'; ?>