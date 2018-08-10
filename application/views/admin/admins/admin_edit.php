<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Admin</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/admins'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Admins List</a>
                    <a href="<?= base_url('admin/admins/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Admin</a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box border-top-solid">
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body my-form-body">
                    <?php if(isset($msg) || validation_errors() !== ''): ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                            <?= validation_errors();?>
                            <?= isset($msg)? $msg: ''; ?>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open(base_url('admin/admins/edit/'.$admin['id']), 'class="form-horizontal"' )?>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Admin Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="name" value="<?= $admin['name']; ?>" class="form-control" id="name" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-9">
                            <input type="text" name="address" value="<?= $admin['address']; ?>" class="form-control" id="address" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                        <div class="col-sm-9">
                            <input type="text" name="mobile_no" value="<?= $admin['mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Select Distributor</label>

                        <div class="col-sm-9">
                            <select name="distributor" class="form-control">
                                <option value="">Select Distributor</option>
                                <?php foreach($distributor_groups as $group): ?>
                                    <?php if($group['id'] == $admin['distributor_id']): ?>
                                        <option value="<?= $group['id']; ?>" selected><?= $group['name']; ?></option>
                                    <?php else: ?>
                                        <option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Update Admin" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>