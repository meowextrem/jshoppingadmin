<?php $this->load->view('manage/main_head_view') ?>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">HealthSafe Developers Practical Task</h5>

                <p class="card-text">
                  Done by Julius Robert Javier
                </p>

                <p class="card-text">
                  <b>Objective</b>: Create a shopping cart CRUD application consisting of two standalone services.
                </p>

                <p class="card-text">
                  <b>Project overview</b>
                  <br>The solution should consist of two standalone applications. The first application is a backend API which listens for the calls from the second app. The second application - a frontend app which draws the UI using the data from the first application.

                  <br><br>

                  The solution must have a section to manage products (CRUD).
                  <ul>
                    <li>Users should be able to manage product name, price, image and quantity.</li>
                    <li>No login system is required.</li>
                  </ul>
                  <br>
                  Shopping cart (functional requirements)

                  <ul>
                    <li>The cart will need to keep its “state” during page loads / refreshes.</li>
                    <li>List Products – these should be listed at all times to allow adding of products.</li>
                    <li>Products should be listed in this format: product name, price, link to add product.</li>
                    <li>Must be able to add a product to the cart.</li>
                    <li>Must be able to view current products in the cart.</li>
                    <li>Must be able to remove a product from the cart.</li>
                    <li>Cart products should be listed in this format: product name, price, quantity, total, remove link</li>
                    <li>Product totals should be tallied to give an overall total.</li>
                    <li>Adding an existing product will only update existing cart product quantity and not add the
  same product as two separate items.</li>
                    <li>All prices should be displayed to 2 decimal places.</li>
                  </ul>
                </p>

                <p class="card-text">
                  <b>To start:</b> Please proceed on Products->List(to see the list of products) or Add (to add a product).
                </p>
              </div>
            </div>

            
          </div>
          <!-- /.col-md-6 -->
          
    <!-- /.row -->
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

<?php $this->load->view('manage/main_footer_view') ?>;