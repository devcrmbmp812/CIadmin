<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Bet</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/bets'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Bets List</a>
                    <a href="<?= base_url('admin/bets/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Bet</a>
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

                    <?php echo form_open(base_url('admin/bets/edit/'.$bet['id']), 'class="form-horizontal"' )?>

                    <div class="form-group">
                        <label for="bet_amt" class="col-sm-2 control-label">Bet Amount</label>

                        <div class="col-sm-9">
                            <input type="number" name="bet_amt" value="<?= $bet['bet_amt']; ?>" class="form-control" id="bet_amt" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bet_number" class="col-sm-2 control-label">Bet Number</label>

                        <div class="col-sm-9">
                            <input type="number" name="bet_number" value="<?= $bet['bet_number']; ?>" class="form-control" id="bet_number" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                        <div class="col-sm-9">
                            <input type="number" name="mobile_no" value="<?= $bet['mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bet_code" class="col-sm-2 control-label">Bet Code</label>

                        <div class="col-sm-9">
                            <input type="text" name="bet_code" value="<?= $bet['bet_code']?>" class="form-control" id="bet_code" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bet_text" class="col-sm-2 control-label">Bet Text</label>

                        <div class="col-sm-9">
                            <input type="text" name="bet_text" value="<?= $bet['bet_text']?>" class="form-control" id="bet_text" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="text_code" class="col-sm-2 control-label">Text Code</label>

                        <div class="col-sm-9">
                            <input type="text" name="text_code" value="<?= $bet['text_code']?>" class="form-control" id="text_code" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Select Agent</label>

                        <div class="col-sm-9">
                            <select name="agent" class="form-control">
                                <option value="">Select Agent</option>
                                <?php foreach($agent_groups as $group): ?>
                                    <?php if($group['id'] == $bet['agent_id']): ?>
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
                            <input type="submit" name="submit" value="Update Bet" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>