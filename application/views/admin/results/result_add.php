<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body with-border">
                <div class="col-md-6">
                    <h4><i class="fa fa-plus"></i> &nbsp; Add New Result</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/results'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Results List</a>
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

                    <?php echo form_open(base_url('admin/results/add'), 'class="form-horizontal"');  ?>
                    <div class="form-group">
                        <label for="drawtime" class="col-sm-2 control-label">Draw Time</label>

                        <div class="col-sm-9">
                            <input type="text" name="drawtime" class="form-control" id="drawtime" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="drawdate" class="col-sm-2 control-label">Draw Date</label>

                        <div class="col-sm-9">
                            <input type="date" name="drawdate" class="form-control" id="drawdate" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="result" class="col-sm-2 control-label">Result</label>

                        <div class="col-sm-9">
                            <input type="number" name="result" class="form-control" id="result" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Add Result" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close( ); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>