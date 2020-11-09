<div class="container">
    <h2><?= $title; ?></h2>

    <?php echo validation_errors()?>

    <?php echo form_open_multipart('menu/edit/'.$data['id']) ?>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control", name="name" value="<?php echo $data['name']; ?>" placeholder="Enter food item name">
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control", name="price" value="<?php echo $data['price']?>" placeholder="Enter food item price">
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" class="form-control", name="quantity" value="<?php echo $data['stock']?>" min="1" max="999" placeholder="Enter food item quantiy">
        </div>
        <div class="form-group">
            <label for="">Upload Food Image</label>
            <input type="file" class="form-control-file", name="food-image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>