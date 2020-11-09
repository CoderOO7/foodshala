<div class="row">
    <div class="col-12 col-sm8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 pb-5 bg-white from-wrapper">
        <div class="container">
            <h3><?= $title ?></h3>
            <hr>
            <form class="" action="<?php echo base_url()?>register-customer" method="post">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname')?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname')?>" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email')?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="password_confirm">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="vegen">Are You Vegetarian ?</label>
                            <select class="form-control" name="vegen" id="vegan">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- Hidden input for setting the role to customer -->
		            <input type="hidden" value="customer" name="role">
                    
                    <!-- Show validation errors if any occur -->
                    <?php if (validation_errors()) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($error)) : ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

               
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-12 col-sm-8 text-right">
                        <a href="<?php echo site_url()?>login">Already have an account?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>