<?php $this->load->view('manage/main_head_view') ?>

<section class="content">

  <div class="container-fluid">
    <a href="<?php echo site_url().'manage/'.$this->module_name?>/add" class="btn btn-link"><button type="submit" class="btn btn-primary">Add</button></a>
  </div>

  <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Lists</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Stock</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($records as $record) { ?>
                    <tr>
                        <td><?php echo $record['thename']?></td>
                        <td><?php echo $record['price']?></td>
                        <td><img src="<?php echo base_url()?>/uploads/<?php echo $record['image']?>" alt="<?php $record['thename']?>" width="150px"></td>
                        <td><?php echo $record['stock']?></td>
                        <td>
                          <a href="<?php echo site_url().'manage/'.$this->module_name?>/edit/<?php echo $record['id']?>" class="btn btn-link"><button type="submit" class="btn btn-info">Edit</button></a>
                          <button onclick="delete_modal(<?php echo $record['id']?>)" type="submit" class="btn btn-danger">Remove</button>
                        </td>
                      
                    </tr>
                    <?php } ?>

                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
  <div class="modal fade" id="myAlertDelete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p id="disable-message"></p>
            </div>
            <div class="modal-footer justify-content-between" id="disable-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</section>

<script>
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      "pageLength": 10,
    });
</script>

<script type="text/javascript">

    $(function() {
        $('#closeModal').on("click", function() {
            $('#myAlert').modal('hide');
        });
    });

    function delete_modal(id){

        $('#disable-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
          '<button onclick="deleteProduct('+id+')" type="button" class="btn btn-danger">Delete</button>');
        $('#disable-message').html('Are you sure you want to delete this product?');
        $('#myAlertDelete').modal('show');
    }

    function deleteProduct(id) {
        var deleteurl = "<?php echo site_url('manage/'.$this->module_name.'/delete') ?>/"+id;
        window.location.href = deleteurl;
    }

</script>

<?php $this->load->view('manage/main_footer_view') ?>;