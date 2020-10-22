<h2>Food Items</h2>
<hr />
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <?php foreach ($data->result() as $row) : ?>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img width="200" src="<?php echo base_url() . 'assets/images/' . $row->image; ?>">
                        <div class="caption">
                            <h4><?php echo $row->name; ?></h4>
                            <div class="row">
                                <div class="col-md-7">
                                    <h4><?php echo number_format($row->price); ?></h4>
                                </div>
                                <div class="col-md-5">
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
    <?php if($this->session->userdata('role') === "customer"): ?>
    <div class="col-md-4">
        <h4>Items in Cart</h4>
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
    <?php endif; ?>
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
                    url: "<?php echo base_url('menu_items/add_to_cart'); ?>",
                    method: "POST",
                    data: {
                        id: item_id,
                        name: item_name,
                        price: item_price,
                        quantity: quantity
                    },
                    success: function(data) {
                        // alert('Product Added into cart');
                        $('#detail_cart').html(data);
                    }
            });
            <?php else: ?>
                window.location ="<?php echo site_url(); ?>login"
            <?php endif; ?>
        });


        $('#detail_cart').load("<?php echo site_url('menu_items/load_cart'); ?>");


        $(document).on('click', '.romove_cart', function() {
            var row_id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url('menu_items/delete_cart'); ?>",
                method: "POST",
                data: {
                    row_id: row_id
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                }
            });
        });
    });
</script>