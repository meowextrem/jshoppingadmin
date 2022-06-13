</div>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="#">Julius Robert Javier</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script>
  $(function() { 
    var Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 10000
    });

    <?php if($this->session->flashdata('system_success')) { ?>
      Toast.fire({
        icon: 'success',
        text: "<?php echo $this->session->flashdata('system_success'); ?>"
      })
    <?php } ?>

    <?php if($this->session->flashdata('system_error')) { ?>
      Toast.fire({
        icon: 'error',
        text: "<?php echo $this->session->flashdata('system_error'); ?>"
      })
    <?php } ?>
    
  });
</script>

</body>
</html>
