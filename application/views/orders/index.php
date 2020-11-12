<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $title ?></h2>
            <hr />
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Customer name</th>
                        <th>Customer email</th>
                        <th>Billing Amount</th>
                        <th>Created At</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="detail_cart">
                    <?php foreach($data->result() as $row): ?>
                        <tr>
                            <td><?= $row->id; ?></td>
                            <td><?= $row->firstname.' '.$row->lastname; ?></td>
                            <td><?= $row->email; ?></td>
                            <td>Rs. <?= $row->total_amount; ?></td>
                            <td><?= date('d/m/y',strtotime($row->created_at)); ?></td>
                            <td><?= $row->city ?></td>
                            <td><a class="btn btn-success btn-sm" href='<?=site_url('orders/history/'.$row->user_id) ?>'>View</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>