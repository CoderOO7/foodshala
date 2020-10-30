<div class="container-fluid">
    <h2>Food Items</h2>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <?php foreach ($data->result() as $row) : ?>
                    <div class="col-lg-3 col-md-2 col-sm-6 thumb">
                        <div class="thumbnail">
                            <img class="img-thumbnail" src="<?php echo base_url() . 'assets/images/' . $row->image; ?>">
                            <div class="caption">
                                <h4><?php echo $row->name; ?></h4>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <h4><?php echo number_format($row->price); ?></h4>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="number" name="quantity" id="<?php echo $row->id; ?>" value="1" class="quantity form-control">
                                    </div>
                                </div>
                                <?php if(! $this->session->userdata('isloggedin') || !$this->session->userdata('role') === "restaurant"): ?>
                                    <button class="add_cart btn btn-success btn-block" data-id="<?php echo $row->id; ?>" data-name="<?php echo $row->name; ?>" data-price="<?php echo $row->price; ?>">Add To Cart</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add_cart').click(function() {
                <?php if( $this->session->has_userdata('is_logged_in')): ?>
                    let item_id = $(this).data("id");
                    var item_name = $(this).data("name");
                    var item_price = $(this).data("price");
                    var quantity = $('#' + item_id).val();
                    $.ajax({
                        url: "<?php echo site_url('cart/add_to_cart'); ?>",
                        method: "POST",
                        data: {
                            id: item_id,
                            name: item_name,
                            price: item_price,
                            quantity: quantity
                        },
                        success: function(data) {
                            // alert('Product Added into cart');
                           // $('#detail_cart').html(data);
                        }
                });
                <?php else: ?>
                    window.location ="<?php echo site_url(); ?>login"
                <?php endif; ?>
            });
        });
    </script>
</div>