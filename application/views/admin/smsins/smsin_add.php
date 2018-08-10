<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body with-border">
                <div class="col-md-6">
                    <h4><i class="fa fa-plus"></i> &nbsp; Add New Sms In</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/smsins'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Sms In List</a>
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

                    <?php echo form_open(base_url('admin/smsins/add'), 'class="form-horizontal"');  ?>
                    <div class="form-group">
                        <label for="gateway" class="col-sm-2 control-label">Gateway</label>

                        <div class="col-sm-9">
                            <input type="text" name="gateway" class="form-control" id="gateway" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="originator" class="col-sm-2 control-label">Originator</label>

                        <div class="col-sm-9">
                            <input type="text" name="originator" class="form-control" id="originator" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-2 control-label">Message</label>

                        <div class="col-sm-9">
                            <input type="text" name="message" class="form-control" id="message" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Add Sms In" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close( ); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>