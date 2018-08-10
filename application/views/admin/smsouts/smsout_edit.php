<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Sms Out</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/smsouts'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Sms Out List</a>
                    <a href="<?= base_url('admin/smsouts/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Sms Out</a>
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

                    <?php echo form_open(base_url('admin/smsouts/edit/'.$smsout['id']), 'class="form-horizontal"' )?>

                    <div class="form-group">
                        <label for="sms_text" class="col-sm-2 control-label">SMS Text</label>

                        <div class="col-sm-9">
                            <input type="text" name="sms_text" value="<?= $smsout['sms_text']; ?>" class="form-control" id="sms_text" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="recipient_number" class="col-sm-2 control-label">Recipient Mumber</label>

                        <div class="col-sm-9">
                            <input type="text" name="recipient_number" value="<?= $smsout['recipient_number']; ?>" class="form-control" id="recipient_number" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="instance_name" class="col-sm-2 control-label">Instance Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="instance_name" value="<?= $smsout['instance_name']; ?>" class="form-control" id="instance_name" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="msg_status" class="col-sm-2 control-label">Message Status</label>

                        <div class="col-sm-9">
                            <select name="msg_status" class="form-control">
                                <option value="">Select Status</option>
                                <?php if($smsout['msg_status'] == '1') : ?>
                                    <option value="1" selected>1</option>
                                    <option value="0">0</option>
                                <?php else: ?>
                                    <option value="1">1</option>
                                    <option value="0" selected>0</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Update Sms Out" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>