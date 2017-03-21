<?php
session_start();
require 'library/core.php';
require 'db.php';
$db = new DB();
require 'library/security.php';
require 'library/helper.php';
$title = "Create Job";
require("layout/header.php");

//เนื้อหา
$options = array(
  "table" => "SCGUser",
  "fields" => "*"
);
$query = $db->select($options);
$row_count = $db->rows($query);

//ทดสอบ
$options_test = array(
  "table" => "TEST"
);
$query_test = $db->select($options_test);
?>
<!--เรียกไฟล์ validate form-->
<link rel="stylesheet" href="<?php echo base_url() . "/media/css/valid.css"; ?>">
<script src="<?php echo base_url() . "/media/js/jquery.form-validator.min.js"; ?>"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . "/media/css/datepicker3.css"; ?>">
<!-- bootstrap datepicker -->
<script src="<?php echo base_url() . "/media/js/bootstrap-datepicker.js"; ?>"></script>
<!--Data table-->
<link rel="stylesheet" href="<?php echo base_url() . "/media/css/dataTables.bootstrap.css"; ?>">
<script src="<?php echo base_url() . "/media/js/jquery.dataTables.min.js"; ?>"></script>
<script src="<?php echo base_url() . "/media/js/dataTables.bootstrap.min.js"; ?>"></script>

<!--Multiple Select into Textbox-->
<link rel="stylesheet" href="<?php echo base_url() . "/media/select2/select2.min.css"; ?>">
<script src="<?php echo base_url() . "/media/select2/select2.full.min.js"; ?>"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    เพิ่มข้อมูล
    <small>Job</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
    <li><a href="#"><i class="fa fa-dashboard"></i> รายการ</a></li>
    <li class="active">เพิ่มข้อมูล</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
      <?php echo set_alert_success('ข้อความจากสุดหล่อ @_@'); ?>
      <form class="form-horizontal" id="input-form" method="post" action="<?php echo base_url() . "/testform.php"; ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="Subject" class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="Jobsubject" placeholder="JobSubject" name="JobSubject" data-validation="required">
          </div>
        </div>
        <div class="form-group">
          <label for="country" class="col-sm-2 control-label">Country</label>
          <div class="col-sm-10">
            <select class="js-example-basic-multiple form-control" multiple="multiple" id="country" name="country[]">
              <option value="sanook">sanook.com</option>
              <option value="kapook">kapook.com</option>
              <option value="google">google.com</option>
              <option value="thailand">thailand.com</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="Response" class="col-sm-2 control-label">Response</label>
          <div class="col-sm-10">
            <select class="form-control" id="Response" name="Response" data-validation="required" >
              <option selected="selected"> </option>
              <?php
              while ($rs = $db->get($query)) {
                ?>
                <option><?php echo $rs['Fullname'] . ' ' . $rs['Department']; ?></option>

                <?php
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="Duedate" class="col-sm-2 control-label">Duedate</label>
          <div class="col-sm-10">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="Duedate" name="Duedate" data-validation="required">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="popup">Pop Up</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div>
                <input type="text" class="form-control" name="popup" id="popup" data-validation="required">
              </div>
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#myModal">Go!</button>
              </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="Subject" class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="Price" placeholder="Price" name="Price" data-validation="required">
          </div>
        </div>
        <div class="form-group">
          <label for="Description" class="col-sm-2 control-label">Description</label>

          <div class="col-sm-10">
            <textarea class="form-control" rows="3" placeholder="Enter ..." name="Description" id="Description"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-fw fa-floppy-o"></i>
              บันทึกข้อมูล</button>
              <a class="btn btn-danger" href="<?php echo base_url() . "/home.php"; ?>" role="button">
                <i class="fa fa-fw fa-close"></i>
                ยกเลิก</a>
              </div>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <table id="example" class="display table table-bordered table-responsive table-striped" cellspacing="0" width="100%"  style="background-color: #FFFFFF;">
            <thead>
              <tr>
                <th>JobID</th>
                <th>Description</th>
                <th>Price</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Pop up</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 col-md-offset-6">
                <input type="text" name="search" id="search" class="form-control" placeholder="Description">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <table class="table" id="tbpopup">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($rs = $db->get($query_test)) { ?>
                      <tr class="trline">
                        <td>
                          <input type="hidden" class="hDesc<?php echo $rs['JobID']; ?>" value="<?php echo $rs['Description']; ?>">
                          <?php echo $rs['JobID']; ?>
                        </td>
                        <td><?php echo $rs['Description']; ?></td>
                        <td><?php echo $rs['Price']; ?></td>
                        <td><button class="btn btn-primary btn-sm getid" name="<?php echo $rs['JobID']; ?>" data-dismiss="modal">เลือก</button></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="loader"><img src="<?php echo base_url() . '/media/img/loading.gif'; ?>" border="0" alt="loader"></div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      $(document).ready(function () {
        $(".js-example-basic-multiple").select2();

        $('#example').dataTable({
          "processing":true,
          "serverSide": true,
          "ajax": {
            "url": "<?php echo base_url() . '/ajax/table_test.php' ?>",
            "type": "POST"
          },
          "columns": [
            {"data": "JobIDx"},
            {"data": "Description"},
            {"data": "Price"}
          ]
        });
        $.validate({
          borderColorOnError: '#FF0000',
          addValidClassOnAll: true
        });
        //Date picker
        $('#Duedate').datepicker({
          autoclose: true,
          format: 'dd/mm/yyyy'
        }).on('changeDate', function () {
          $('#Duedate').focus();
          $('#Price').focus();
        });
        $('#tbpopup').on('click', '.getid', function (e) {
          e.preventDefault();
          $('#popup').val($(this).attr('name'));
          $('#Description').val($('.hDesc' + $(this).attr('name')).val());
          $.ajax({
            url: "<?php echo base_url() . '/ajax/search_price.php' ?>",
            type: 'POST',
            data: {JobID: $(this).attr('name')},
            dataType: 'JSON',
            success: function (y) {
              //หลาย record
              //for (i = 0; $i < y.length; $i++) {
              //$('#Price').val(y[i].Price);
              //}
              $('#Price').val(y[0].Price);
            }
          });
        });
        $('#search').on('keypress', function (e) {
          var code = e.keyCode || e.which;
          if (code === 13) {
            $('.trline').remove();
            $.ajax({
              url: "<?php echo base_url() . '/ajax/search_test.php' ?>",
              type: 'POST',
              data: {search: $('#search').val()},
              beforeSend: function () {
                $('.loader').show();
              },
              complete: function () {
                $('.loader').hide();
              },
              success: function (x) {
                $('#tbpopup').append(x);
              }
            });
          }
        });
      }
    );
    </script>
    <?php
    // แทรกส่วนท้าย
    include("layout/footer.php");
