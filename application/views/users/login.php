<div class="row">
    <div class="col-12 col-sm8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 pb-5 bg-white from-wrapper">
        <div class="container">
            <h3>Login</h3>
            <hr>
            <?php echo validation_errors()?>
            
            <form class="" action="<?php echo site_url()?>login" method="post">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email')?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                   <!--  <div class="col-12 col-sm-8 text-right">
                        <a href="<?php echo site_url()?>register">Don't have an account yet?</a>
                    </div> -->
                </div>
            </form>
        </div>
    </div>
</div>