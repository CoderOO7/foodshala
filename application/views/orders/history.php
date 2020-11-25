<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $title ?></h2>
            <hr />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Item Image</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Created Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
                    <?php foreach($orders as $item): ?>
                        <tr>
                            <td><?= $item['order_id']; ?></td>
                            <td><img class="order-item-img" src="https://storage.googleapis.com/<?= $bucket_name ?>/images/<?= $item['image'] ?>" 
                                onerror="this.onerror=null; this.src='<?= base_url('assets/images/noimage.jpg')?>'" alt=""></td>
                            <td><?= $item['name']; ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>Rs. <?= $item['price']; ?></td>
                            <td><?= date('d/m/y',strtotime($item['created_at'])); ?></td>
                            <td><?= $item['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>