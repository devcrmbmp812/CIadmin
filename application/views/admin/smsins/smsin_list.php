<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-list"></i> &nbsp; SMS In List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group margin-bottom-20">
                        <a href="<?= base_url('admin/smsins/create_smsins_pdf'); ?>" class="btn btn-success">Export as PDF</a>
                        <a href="<?= base_url('admin/smsins/export_csv'); ?>" class="btn btn-success">Export as CSV</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box border-top-solid">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>Gateway</th>
                    <th>Originator</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th style="width: 100px;" class="text-right">Option</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($all_smsins as $row): ?>
                    <tr>
                        <td><?= $row['gateway']; ?></td>
                        <td><?= $row['originator']; ?></td>
                        <td><?= $row['message']; ?></td>
                        <td><?= $row['status']?></td>
                        <td class="text-right"><a href="<?= base_url('admin/smsins/edit/'.$row['id']); ?>" class="btn btn-info btn-flat btn-xs">Edit</a>
                            <a data-href="<?= base_url('admin/smsins/del/'.$row['id']); ?>" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="#confirm-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>


<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Dialog</h4>
            </div>
            <div class="modal-body">
                <p>As you sure you want to delete.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a class="btn btn-danger btn-ok">Yes</a>
            </div>
        </div>

    </div>
</div>


<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
    });
</script>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script>
    $("#view_smsins").addClass('active');
</script>
