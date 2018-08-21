<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-6">
                    <h4><i class="fa fa-list"></i> &nbsp; Bet List </h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="btn-group margin-bottom-20">
                        <a href="<?= base_url('admin/bets/create_bets_pdf'); ?>" class="btn btn-success">Export as PDF</a>
                        <a href="<?= base_url('admin/bets/export_csv'); ?>" class="btn btn-success">Export as CSV</a>
                    </div>
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
                    <th>ID</th>
                    <th>Bet Date</th>
                    <th>Bet Draw</th>
                    <th>Bet Amount</th>
                    <th>Bet Number</th>
                    <th>Mobile No.</th>
                    <th>Bet Code</th>
                    <th>Bet Text</th>
                    <th>Text Code</th>
                    <th>Agent</th>
                    <th style="width: 100px;" class="text-right">Option</th>
                </tr>
                </thead>
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

    var _CSRF_VAlUE = "<?= $this->security->get_csrf_hash()?>";

    var getCookie = function(name)
    {
        var re = new RegExp(name + "=([^;]+)");
        var value = re.exec(document.cookie);
        return (value != null) ? unescape(value[1]) : null;
    };

    $(function () {

        table = $('#example1').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.\
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/bets/bet_ajax_list')?>",
                "type": "POST",
                data: function(dtRequest) {
                    dtRequest[ 'csrf_test_name'] = _CSRF_VAlUE;
                    return dtRequest;
                },
                dataFilter:function(response) {
                    console.log(response);
                    return response;
                },
                error: function(err){
                    console.log(err);
                },
                complete: function (res) {
                    _CSRF_VAlUE = getCookie('csrf_cookie_name');
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": true, //set not orderable
                },
            ],

        });
    });
</script>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script>
    $("#view_bets").addClass('active');
</script>
