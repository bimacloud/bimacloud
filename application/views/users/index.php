<div class="container mt-5">
    <div class="row">
        <div class="col-xl-12 col-lg-12 mb-4">
            <div class="card user-card-full">
                <div class="row m-l-0 m-r-0">
                    <!-- Profile Section -->
                    <div class="col-sm-4 bg-gradient-primary user-profile d-flex justify-content-center align-items-center p-4">
                        <div class="card-block text-center text-white">
                            <div class="m-b-25">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=1525304704" 
                                     class="img-profile rounded-circle" width="100" alt="User-Profile-Image">
                            </div>
                            <h6 class="f-w-600">Eri Febrianto</h6>
                            <small>@erinet</small>
                        </div>
                    </div>

                    <!-- Information Section -->
                    <div class="col-sm-8 p-3">
                        <div class="card-block">
                            <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <p class="m-b-10 f-w-600"><i class="far fa-envelope" aria-hidden="true"></i> Email</p>
                                    <h6 class="text-muted f-w-400"><?php echo $email; ?></h6>
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <p class="m-b-10 f-w-600"><i class="fas fa-coins fa-sm" aria-hidden="true"></i> Tunnel Coin</p>
                                    <h6 class="text-muted f-w-400">₵ 0</h6>
                                </div>
                            </div>

                            <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">More Information</h6>
                            <hr class="sidebar-divider">
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <p class="m-b-10 f-w-600"><i class="fas fa-user-plus" aria-hidden="true"></i> Registered Date</p>
                                    <h6 class="text-muted f-w-400">            <?php echo isset($created_at) ? date('M d, Y H:i', strtotime($created_at)) : 'Tanggal tidak ditemukan'; ?>
                                    </h6>
                                </div>
                                <div class="col-sm-6 mb-1">
                                    <p class="m-b-10 f-w-600"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> Last Login</p>
                                    <h6 class="text-muted f-w-400">Nov 16, 2024, 12:47 am</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    

        <!-- Edit Account Section -->
        <div class="row">
            <div class="col-xl-8 order-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-fw fa-user-cog" style="font-size:13px;" aria-hidden="true"></i> Edit Account
                        </h6>
                    </div>
                    <div class="collapse show" id="account">
                        <div class="card-body">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>

                            <form id="UpdateAccount" method="post" action="<?php echo site_url('User/index'); ?>">

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="firstname"><i class="fas fa-user fa-fw" style="font-size:13px;" aria-hidden="true"></i> Firstname:</label>
                                        <input type="text" id="firstname" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo isset($first_name) ? $first_name : 'first_name tidak ditemukan'; ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastname"><i class="fas fa-user fa-fw" style="font-size:13px;" aria-hidden="true"></i> Lastname:</label>
                                        <input type="text" id="lastname" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo isset($last_name) ? $last_name : 'last_name tidak ditemukan'; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope fa-fw" style="font-size:13px;" aria-hidden="true"></i> Email:</label>
                                    <input type="text" id="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : 'Email tidak ditemukan'; ?>" readonly>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="newpass"><i class="fas fa-lock fa-fw" style="font-size:13px;" aria-hidden="true"></i> New Password:</label>
                                        <input type="password" id="newpass" class="form-control" name="newpass" placeholder="********">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="conf_newpass"><i class="fas fa-sync fa-fw" style="font-size:13px;" aria-hidden="true"></i> Confirm New Password:</label>
                                        <input type="password" id="conf_newpass" class="form-control" name="conf_newpass" placeholder="********">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-sm-12 col-md-6 mb-4" id="result" role="alert"></div>

                                <input type="hidden" name="form_submission" value="edit_user">
                                <input type="hidden" name="username" value="erinet">
                                <input type="hidden" name="usertoedit" value="erinet">
                                <input type="hidden" id="edit-user" name="edit-user" value="748138db15d46b5259b26a7d8c4467e3">

                                <br>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-undo" style="font-size:13px" aria-hidden="true"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-sm btn-primary" id="action">
                                        <i class="fas fa-paper-plane" style="font-size:13px" aria-hidden="true"></i> Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Section -->
            <div class="col-xl-4 order-xl-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-fw fa-exclamation-circle" style="font-size:13px;" aria-hidden="true"></i> Informasi
                        </h6>
                    </div>
                    <div class="collapse show" id="informasivpn">
                        <div class="card-body">
                            <small><i class="fas fa-dot-circle fa-fw" style="font-size:10px;" aria-hidden="true"></i>
                                <b>Untuk mengubah informasi akun tanpa mengubah password, silahkan kosongkan password nya.</b>
                            </small><br>
                            <small><i class="fas fa-dot-circle fa-fw" style="font-size:10px;" aria-hidden="true"></i>
                                <b>Harap hati-hati dalam mengubah password!</b>
                            </small><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
