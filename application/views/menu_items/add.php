<div class="container">
    <h2><?= $title; ?></h2>

    <?php echo validation_errors()?>

    <?php echo form_open_multipart('menu/add') ?>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control", name="name" placeholder="Enter food item name">
        </div>
        <div class="form-group">
            <label for="">Price</label>
            <input type="text" class="form-control", name="price" placeholder="Enter food item price">
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="number" class="form-control", name="quantity" min="1" max="999" placeholder="Enter food item quantiy">
        </div>
        <div class="form-group">
            <label for="">Upload Food Image</label>
            <input type="file" class="form-control-file", name="food-image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>