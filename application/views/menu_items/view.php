<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h2>Food Items</h2>
        <?php if ($_SESSION['is_logged_in'] AND $_SESSION['role'] === "restaurant"):?>
            <a href="<?php echo site_url('menu/add')?>" class="btn btn-primary">Add Items</a>
        <?php endif; ?>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($data->result())) : ?>
                    <?php foreach ($data->result() as $row) : ?>
                        <div class="col-lg-3 col-md-2 col-sm-6 menu-item">
                            <div class="thumbnail">
                                <img class="menu-item-thumb" src="<?php echo base_url( 'assets/images/foods/'.$row->image ); ?>"
                                    onerror="this.onerror=null; this.src='<?php echo base_url('assets/images/noimage.jpg') ;?>'"/>
                                <div class="caption">
                                    <h4><?php echo $row->name; ?></h4>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <h4>Rs. <?php echo number_format($row->price); ?></h4>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="hidden" name="quantity" id="<?php echo $row->id; ?>" value="1" class="quantity form-control">
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="d-flex justify-content-between">
                                        <!-- validation to allow only customers to order the item -->
                                        <?php if ($_SESSION['is_logged_in'] AND $_SESSION['role'] === "restaurant") : ?>
                                            <a class="menu-item-btn btn btn-success" href="<?php echo site_url('menu/edit/'.$row->id); ?>">Edit</a> 
                                            <a class="menu-item-btn btn btn-dark" href="<?php echo site_url('menu/delete/'.$row->id); ?>">Delete</a> 
                                        <?php else: ?>
                                            <button class="menu-item-btn btn btn-success add-cart" data-id="<?php echo $row->id; ?>" data-name="<?php echo $row->name; ?>" data-price="<?php echo $row->price; ?>">Add To Cart</button>
                                            <button class="menu-item-btn btn btn-warning" data-id="<?php echo $row->id; ?>" data-name="<?php echo $row->name; ?>" data-price="<?php echo $row->price; ?>">Buy Now</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No food items are available in stock.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            let cartCount = <?php echo isset($_SESSION['cart_items_count']) ? $_SESSION['cart_items_count'] : 0; ?>;
            $('.add-cart').click(function(event) {
                let target = $(this);
                <?php if ($_SESSION['is_logged_in']) : ?>
                    let item_id = $(this).data("id");
                    let quantity = $('#' + item_id).val();
                    $.ajax({
                        url: "<?php echo site_url('cart/add_to_cart'); ?>",
                        method: "POST",
                        data: {
                            food_id: item_id,
                        },
                        success: function(data) {
                            const cartCounter = $('.cart-counter');
                            cartCounter.text(++cartCount);
                            target.prop('disabled',true);
                        }
                    });
                <?php else : ?>
                    window.location = "<?php echo site_url('login'); ?>"
                <?php endif; ?>
            });
        });
    </script>
</div>