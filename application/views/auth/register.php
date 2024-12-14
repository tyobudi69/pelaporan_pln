<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="<?= base_url('backend/'); ?>css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-info">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form class="user" method="POST" action="<?= site_url('auth/register'); ?>">
                                            <div class="form-floating mb-md-3">
                                                
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name = "username" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Username</label>
                                                        <?= form_error('username', '<span class="text-danger ml-3">', '</span>'); ?>
                                                    </div>
                                                
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name = "email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                                <?= form_error('email', '<span class="text-danger ml-3">', '</span>'); ?>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name = "password1" id="inputPassword" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                        <?= form_error('password1', '<span class="text-danger ml-3">', '</span>'); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name = "password2" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                        <?= form_error('password2', '<span class="text-danger ml-3">', '</span>'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="mt-4 mb-0"> -->
                                            <button type="submit"class="btn btn-primary btn-user btn-block">
                                                Register Akun
                                            </button>
                                            <!-- </div> -->
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="<?= base_url('auth') ?>">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('backend/'); ?>js/scripts.js"></script>
    </body>
</html>
