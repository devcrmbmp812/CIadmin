<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-list"></i> &nbsp; Bet Top 10 Agents </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="box border-top-solid">
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table id="example1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Bet Date</th>
                    <th>Bet Draw</th>
                    <th>Amount</th>
                    <th>Mobile No.</th>
                    <th>Coordinator</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($bet_top10agents as $row): ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['bet_date']; ?></td>
                    <td><?= $row['bet_draw']; ?></td>
                    <td><?= $row['amount']; ?></td>
                    <td><?= $row['mobile']; ?></td>
                    <td><span class="btn bnt-primary btn-flat btn-xs bg-green"><?= getCoordinatorName($row['coordinator_id']); ?></span></td>
                </tr>
                <?php endforeach;?>
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
    var table;
    $(function () {
        table = $('#example1').DataTable();
        table
            .order( [ 3, 'desc' ] )
            .draw();
    });
</script>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

