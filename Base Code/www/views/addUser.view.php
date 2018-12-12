<div class="card card-register mx-auto mt-5">
    <div class="card-header">Register an Account</div>
    <div class="card-body">
        
        <?php $this->addModal('form', $form) ?>

        <div class="text-center">
        <a class="d-block small mt-3" href="<?php echo Routing::getSlug('UsersController', 'loginAction') ?>">Login Page</a>
        <a class="d-block small" href="<?php echo Routing::getSlug('UsersController', 'forgetPasswordAction') ?>">Forgot Password?</a>
        </div>
    </div>
</div>