<h2><?= $title ?></h2>
<h2>Shopping Cart Using Ajax and Codeigniter</h2>
    <hr/>
    <div class="row">
        <div class="col-md-8">
            <h4>Product</h4>
            <div class="row">
            <?php foreach ($data->result() as $row) : ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img width="200" src="<?php echo base_url().'assets/images/'.$row->product_image;?>">
                        <div class="caption">
                            <h4><?php echo $row->product_name;?></h4>
                            <div class="row">
                                <div class="col-md-7">
                                    <h4><?php echo number_format($row->product_price);?></h4>
                                </div>
                                <div class="col-md-5">
                                    <input type="number" name="quantity" id="<?php echo $row->product_id;?>" value="1" class="quantity form-control">
                                </div>
                            </div>
                            <button class="add_cart btn btn-success btn-block" data-productid="<?php echo $row->product_id;?>" data-productname="<?php echo $row->product_name;?>" data-productprice="<?php echo $row->product_price;?>">Add To Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
                 
            </div>
 
        </div>
        <div class="col-md-4">
            <h4>Shopping Cart</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
 
                </tbody>
                 
            </table>
        </div>
    </div>