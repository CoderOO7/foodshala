<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2></h2>
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
                    <?php foreach($items as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price']);?></td>
                        <td><?= $item['qty'];?></td>
                        <td><?= number_format($item['subtotal']);?></td>
                        <td><button type="button" id="<?= $item['rowid']?>" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
    
            </table>
        </div>
    </div>
    <script>
    $('#detail_cart').load("<?php echo site_url('cart/load_cart'); ?>");
    
    
    $(document).on('click', '.romove_cart', function() {
        var row_id = $(this).attr("id");
        $.ajax({
            url: "<?php echo site_url('cart/delete_cart'); ?>",
            method: "POST",
            data: {
                row_id: row_id
            },
            success: function(data) {
                $('#detail_cart').html(data);
            }
        });
    });</script>
</div>