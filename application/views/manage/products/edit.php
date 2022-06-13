<?php $this->load->view('manage/main_head_view') ?>

<section class="content">

  <div class="container-fluid">
    <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Complete the required fields</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo site_url() . 'manage/'.$this->module_name.'/edit_data/'.$record['id']?>" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_image" id="id_image" value="<?php echo $record['id'] ?>">

                <div class="card-body">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter product name" name='thename' value="<?php echo $record['thename'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="number" min='0.01' max='9999999' step="0.01" class="form-control" placeholder="Enter Price" name='price' value="<?php echo $record['price'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No of Stocks Price</label>
                    <input type="number" min='1' max="99999" step="1" class="form-control" placeholder="Enter No. of Stocks" name='stock' value="<?php echo $record['stock'] ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Image</label>

                    <div class="form-group">
                      <img src="<?php echo base_url()?>/uploads/<?php echo $record['image']?>" alt="<?php $record['thename']?>" width="250px">
                    </div>

                    

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" name='media'>
                      <label class="custom-file-label" for="customFile">Change Image (Don't upload any image if you don't want to change)</label>
                    </div>
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

          </div>
          <!-- /.col -->
        </div>
  </div>
</section>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<?php $this->load->view('manage/main_footer_view') ?>;