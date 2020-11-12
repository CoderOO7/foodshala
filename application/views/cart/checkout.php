<div class="container">
    <div class="py-5 text-center">
        <h2><?= $title; ?></h2>
    </div>

    <div class="row">
        <div class="col-md-8 p-0">
            <h4 class="mb-3">Billing Address</h4>
        </div>

        <?= validation_errors() ?>

        <?= form_open() ?>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname', $_SESSION['first_name']) ?>" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname',$_SESSION['last_name']) ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= set_value('address') ?>" placeholder="1234 Main Street" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <label for="address_e">Alternate Address</label>
                    <input type="text" class="form-control" id="address_e" name="address_e" value="<?= set_value('address_e') ?>" placeholder="XYZ Loaction" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="state">State</label>
                        <select name="state" id="state" class="custom-select d-block w-100" required>
                            <option value="">Choose...</option>
                            <?php foreach($states as $state):?>
                                <option value="<?=$state['code']?>"><?=$state['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-group">
                        <label for="pincode">PIN code</label>
                        <input type="text" class="form-control" id="pincode" name="pincode"
                            maxlength="6" placeholder="6 digits [0-9]" required>
                    </div>
                </div>
            </div>

            <hr class="mb-4"/>

            <h4 class="mb-3">Payment</h4>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="cash" name="paymentmethod" value="cash" required>
                    <label for="cash" class="custom-control-label">Cash on delivery</label>
                </div>
            </div>

            <hr class="mb-4"/>

            <button class="btn btn-primary btn-lg btn-block" type="submit">Confirm</button>
        <?= form_close() ?>

    </div>
</div>