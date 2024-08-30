<?php include 'inc/header.php'; ?>

<?php require_once ('classes/Request.php'); ?>
<?php require_once ('classes/Validation.php'); ?>
<?php require_once ('classes/DataBase.php'); ?>
<div class="container my-5">

    <div class="row">

    <?php 
    $request = new Request;
    $id =  $request->GetData('id');
    $id = Validation::ValidateId($id)? $id:1;
    $p = DataBase::GetOneProduct($id);
    if ($p != null) {
    ?>
    <div class="col-lg-6">
        <img src="images/<?php echo $p->getImage() ?>" class="card-img-top">
    </div>
    <div class="col-lg-6">
        <h5 ><?php echo $p->getName()?></h5>
        <p class="text-muted">Price: <?php echo $p->getPrice()?> EGP</p>
        <p><?php echo $p->getDescription()?></p>
        <a href="index.php" class="btn btn-primary">Back</a>
        <a href="edit.php?id=<?php echo $p->getId()?>" class="btn btn-info">Edit</a>
        <a href="handlers/DeleteProduct.php?id=<?php echo $p->getId();?>" class="btn btn-danger">Delete</a>
    </div>
    <?php } ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>