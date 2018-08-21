<!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">
<!-- Datepicker style-->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/bootstrap-datepicker/css/datepicker.css">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-body">
                <div class="col-md-4">
                    <h4><i class="fa fa-list"></i> &nbsp; Generate Winners </h4>
                </div>
                <div class="col-md-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Draw Date</label>
                            <input class="datepicker" id="searchdate" value="<?= $today;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select class="form-control" id="searchtime">
                                <option>11AM</option>
                                <option>4PM</option>
                                <option>9PM</option>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-3">
                        <button class="btn btn-primary reporting-result" id="get_result">Get Result</button>
                    </div>
                    <div class="col-md-6">
                        <label class="reporting-result-label" id="label_result"></label>
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
                    <th>Bet Code</th>
                    <th>Agent Name</th>
                    <th>Bet Draw</th>
                    <th>Bet Date</th>
                    <th>Bet Number</th>
                    <th>Bet Amount</th>
                    <th>Mobile</th>
                    <th>Coordinator</th>
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
                "url": "<?php echo site_url('admin/reporting/get_winners_with_result_ajax')?>",
                "type": "POST",
                data: function(dtRequest) {
                    dtRequest[ 'csrf_test_name'] = _CSRF_VAlUE;
                    dtRequest['searchdate'] = $('#searchdate').val();
                    dtRequest['searchtime'] = $('#searchtime').val();
                    dtRequest['result'] = $('#label_result').html();
                    return dtRequest;
                },
                dataFilter:function(response) {
                    console.log(response);
                    return response;
                },
                error: function(err){
                    console.log("err is here",err);
                    console.log("err CSRF value", _CSRF_VAlUE);
                },
                complete: function (res) {
                    console.log("res is here", res);
                    _CSRF_VAlUE = getCookie('csrf_cookie_name');
                    console.log("CSRF_value", _CSRF_VAlUE);

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

        $('#get_result').click(function () {
            var searchdata = $.ajax({
                type: 'POST',
                url: "<?= site_url('admin/reporting/get_result_ajax') ?>",
                data: {
                    'csrf_test_name': getCookie('csrf_cookie_name'),
                    'searchdate': $('#searchdate').val(),
                    'searchtime' : $('#searchtime').find(":selected").text()
                },
                success: function(res) {
                    console.log(res);
                    if(res) {
                        var obj = jQuery.parseJSON(res);
                        $('#label_result').html(obj[0].result);
                        _CSRF_VAlUE = getCookie('csrf_cookie_name');
                        table.ajax.reload();
                    } else {
                        $('#label_result').html("No Result!");
                        _CSRF_VAlUE = getCookie('csrf_cookie_name');
                        table
                            .clear()
                            .draw();
                    }
                    _CSRF_VAlUE = getCookie('csrf_cookie_name');
                }
            });
            searchdata.error(function() { alert("Something went wrong"); });
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-3d'
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
