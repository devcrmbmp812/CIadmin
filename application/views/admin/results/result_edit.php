<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Result</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/results'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Results List</a>
                    <a href="<?= base_url('admin/results/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Result</a>
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

                    <?php echo form_open(base_url('admin/results/edit/'.$result['id']), 'class="form-horizontal"' )?>

                    <div class="form-group">
                        <label for="drawtime" class="col-sm-2 control-label">Draw Time</label>

                        <div class="col-sm-9">
                            <input type="text" name="drawtime" value="<?= $result['drawtime']; ?>" class="form-control" id="drawtime" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="drawdate" class="col-sm-2 control-label">Draw Date</label>

                        <div class="col-sm-9">
                            <input type="date" name="drawdate" value="<?= $result['drawdate']; ?>" class="form-control" id="drawdate" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="result" class="col-sm-2 control-label">Result</label>

                        <div class="col-sm-9">
                            <input type="number" name="result" value="<?= $result['result']; ?>" class="form-control" id="result" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Update Result" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>