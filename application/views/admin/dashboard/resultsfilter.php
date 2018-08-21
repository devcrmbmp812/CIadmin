<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
<!-- Datepicker style-->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-datepicker/css/datepicker.css">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-4">
                    <h4><i class="fa fa-list"></i> &nbsp; Result Date Filter </h4>
                </div>
                <div class="col-md-4">
                    <i class="fa fa-search"></i> &nbsp;&nbsp;<input class="datepicker" id="searchdate" value="">

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
                    <th>Draw Time</th>
                    <th>Draw Date</th>
                    <th>Result</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Datepicker -->
<script src="<?= base_url() ?>public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
                "url": "<?php echo site_url('admin/results/result_filter_ajax_list')?>",
                "type": "POST",
                data: function(dtRequest) {
                    dtRequest[ 'csrf_test_name'] = _CSRF_VAlUE;
                    dtRequest['searchdate'] = $('#searchdate').val();
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

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        }).on('changeDate', function(e) {
            console.log($('#searchdate').val());
            table.ajax.reload();
        });

    });
</script>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script>
    $("#view_results").addClass('active');
</script>
