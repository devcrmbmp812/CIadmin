<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Distributor</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/distributors'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Distributors List</a>
                    <a href="<?= base_url('admin/distributors/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Distributor</a>
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

                    <?php echo form_open(base_url('admin/distributors/edit/'.$distributor['id']), 'class="form-horizontal"' )?>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Distributor Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="name" value="<?= $distributor['name']; ?>" class="form-control" id="name" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-9">
                            <input type="text" name="address" value="<?= $distributor['address']; ?>" class="form-control" id="address" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                        <div class="col-sm-9">
                            <input type="text" name="mobile_no" value="<?= $distributor['mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Update Distributor" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>