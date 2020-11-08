<div class="container-fluid">
    <h2>Food Items</h2>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php if (!empty($data->result())) : ?>
                    <?php foreach ($data->result() as $row) : ?>
                        <div class="col-lg-3 col-md-2 col-sm-6 thumb">
                            <div class="thumbnail">
                                <img class="img-thumbnail" src="<?php echo base_url( 'assets/images/foods/'.$row->image ); ?>"
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
                                    <?php if (!$this->session->userdata('isloggedin') || !$this->session->userdata('role') === "restaurant") : ?>
                                        <button class="add_cart btn btn-success btn-block" data-id="<?php echo $row->id; ?>" data-name="<?php echo $row->name; ?>" data-price="<?php echo $row->price; ?>">Add To Cart</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No Food is available in stock.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            let cartCount = <?php echo isset($_SESSION['cart_items_count']) == true ? $_SESSION['cart_items_count'] : 0; ?>;
            $('.add_cart').click(function(event) {
                let target = $(this);
                <?php if ($this->session->has_userdata('is_logged_in')) : ?>
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