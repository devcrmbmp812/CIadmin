<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-pencil"></i> &nbsp; Edit Agent</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= base_url('admin/agents'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Agents List</a>
                    <a href="<?= base_url('admin/agents/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Agent</a>
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

                    <?php echo form_open(base_url('admin/agents/edit/'.$agent['id']), 'class="form-horizontal"' )?>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Agent Name</label>

                        <div class="col-sm-9">
                            <input type="text" name="name" value="<?= $agent['name']; ?>" class="form-control" id="name" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-2 control-label">Address</label>

                        <div class="col-sm-9">
                            <input type="text" name="address" value="<?= $agent['address']; ?>" class="form-control" id="address" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile_no" class="col-sm-2 control-label">Mobile No</label>

                        <div class="col-sm-9">
                            <input type="text" name="mobile_no" value="<?= $agent['mobile']; ?>" class="form-control" id="mobile_no" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="limit" class="col-sm-2 control-label">Limit</label>

                        <div class="col-sm-9">
                            <input type="number" name="limit" value="<?= $agent['limit']?>" class="form-control" id="limit" placeholder="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Select Coordinator</label>

                        <div class="col-sm-9">
                            <select name="coordinator" class="form-control">
                                <option value="">Select Coordinator</option>
                                <?php foreach($coordinator_groups as $group): ?>
                                    <?php if($group['id'] == $agent['coordinator_id']): ?>
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
                            <input type="submit" name="submit" value="Update Agent" class="btn btn-info pull-right">
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

</section>