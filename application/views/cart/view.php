<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Items in Cart</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Items</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $('#detail_cart').load("<?php echo site_url('cart/load_cart'); ?>");
        
        $(document).on('click', '.romove_cart', function() {
            let rowId = $(this).attr("id");
            let cartCount = <?php echo $_SESSION['cart_items_count'];?>;
            $.ajax({
                url: "<?php echo site_url('cart/delete_cart_item'); ?>",
                method: "POST",
                data: {
                    row_id: rowId
                },
                success: function(data) {
                    $('#detail_cart').html(data);
                    const cartCounter = $('.cart-counter');
                    cartCounter.text(--cartCount);
                }
            });
        });
    </script>
</div>