<?php include 'inc/header.php'; ?>

<?php require_once ('classes/Request.php');?>
<?php require_once ('classes/Validation.php');?>
<?php require_once ('classes/DataBase.php');?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
        <?php 
        $request = new Request;
        $id =  $request->GetData('id');
        
        $id = Validation::ValidateId($id)? $id:null;
        $p = DataBase::GetOneProduct($id);
        if ($p != null && $id != null) {
        ?>
            <form action="handlers/EditProduct.php" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" id="id" name="id" value="<?php echo $p->getId();?>">
                <input type="hidden" id="old_image" name="old_image" value="<?php echo $p->getImage();?>">

                <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name = "name" value="<?php echo $p->getName()?>">
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $p->getPrice()?>" min="0">
                </div>

                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "desc"><?php echo $p->getDescription();?></textarea>
                </div>

                <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input class="form-control" type="file" id="formFile" name="img">
                </div>

                <div class="col-lg-3">
                        <img src="images/<?php echo $p->getImage();?>" class="card-img-top">
                        </div>
                <center><button on type="submit" class="btn btn-primary" name="submit">Add</button></center>
            </form>
            <?php } else header("location:index.php"); ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>