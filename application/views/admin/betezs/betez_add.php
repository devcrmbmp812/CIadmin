<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body with-border">
                <div class="col-md-6">
                    <h4><i class="fa fa-plus"></i> &nbsp; Add New Betez</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/betezs'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Betezs List</a>
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

                    <?php echo form_open(base_url('admin/betezs/add'), 'class="form-horizontal"');  ?>
                    <div class="form-group">
                        <label for="bet_amt" class="col-sm-2 control-label">Bet Amount</label>

                        <div class="col-sm-9">
                            <input type="number" name="bet_amt" class="form-control" id="bet_amt" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bet_number" class="col-sm-2 control-label">Bet Number</label>

                        <div class="col-sm-9">
                            <input type="number" name="bet_number" class="form-control" id="bet_number" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                        <div class="col-sm-9">
                            <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bet_code" class="col-sm-2 control-label">Bet Code</label>

                        <div class="col-sm-9">
                            <input type="text" name="bet_code" class="form-control" id="bet_code" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bet_text" class="col-sm-2 control-label">Bet Text</label>

                        <div class="col-sm-9">
                            <input type="text" name="bet_text" class="form-control" id="bet_text" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Select Agent</label>

                        <div class="col-sm-9">
                            <select name="agent" class="form-control">
                                <option value="">Select Agent</option>
                                <?php foreach($agent_groups as $group): ?>
                                    <option value="<?= $group['id']; ?>"><?= $group['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-11">
                            <input type="submit" name="submit" value="Add Betez" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close( ); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>