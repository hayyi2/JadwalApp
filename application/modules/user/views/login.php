        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="page-title mb-3">
                    <h2 class="text-center"><?php echo get_app_config('app_name'); ?></h2>
                </div>
                <?php get_message_flash() ?>
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Account Login</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?php url('user/login') ?>">
                            <?php if (isset($go)): ?>
                                <input type="hidden" name="go" value="<?php echo($go) ?>">
                            <?php endif ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input name="username" required="" type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" required="" type="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>