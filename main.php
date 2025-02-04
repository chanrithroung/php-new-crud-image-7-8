<?php include("db_connect.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrp Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Bootstrap Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Link Sweet alert from js.org -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Link Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>CRUD IMAGE</title>
</head>
<body class="bg-light">
    <?php
        if($_GET['status'] == 'success') {
    ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: "Success!",
                    text: "Product created successfully",
                    icon: "success",
                    button: "Done!",
                });
            })
        </script>

    <?php } ?>
    <?php
        if($_GET['status'] == 'updated') {
    ?>
        <script>
            $(document).ready(function() {
                swal({
                    title: "Success!",
                    text: "Product updated successfully",
                    icon: "success",
                    button: "Done!",
                });
            })
        </script>

    <?php } ?>
  

    <div class="container-fluid bg-dark text-white p-5 text-center">
        <h1>PHP CRUD IMAGE</h1>

        <!-- Button Trigger Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus-square-fill"></i> Add Product
        </button>
    </div>

    <div class="container mt-5 p-4 shadow bg-white">
        <h4>LIST ALL PRODUCTS</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>THUMBNAIL</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $query = "SELECT * FROM `products`";
                    $result = db_connect()->query($query);
                    while($row = mysqli_fetch_assoc($result)) {
                        $id        = $row['id'];
                        $name      = $row['name'];
                        $price     = $row['price'];
                        $quantity  = $row['quantity'];
                        $thumbnail = $row['thumbnail'];
                        

                        echo '<tr class="align-middle">
                                <td>'.$id.'</td>
                                <td>'.$name.'</td>
                                <td>USD $'.$price.'</td>
                                <td>'.$quantity.'</td>
                                <td>
                                    <img class="rounded-3" style="height: 120px;" src="http://localhost/myphp/crud_image/uploads/'.$thumbnail.'" alt="">
                                </td>
                                <td>
                                    <button class="btn btn-success shadow me-2 btn-edit" data-id="'.$id.'" data-name="'.$name.'" data-price="'.$price.'" data-quantity="'.$quantity.'" data-thumbnail="'.$thumbnail.'"  data-bs-toggle="modal" data-bs-target="#modal-update"> <i class="bi bi-pencil-square"></i> </button> 
                                    <button type="button" class="btn btn-danger shadow"> <i class="bi bi-trash3"></i> </button>
                                </td>
                            </tr>';
                    }
                ?>
            </tbody>
            
        </table>
    </div>
    
</body>
<script>
    $(document).ready(function(){
        $(document).on('click', '.btn-edit', function(){
            const id = $(this).data('id');
            const name = $(this).data('name');
            const price = $(this).data('price');
            const quantity = $(this).data('quantity');
            const thumbnail = $(this).data('thumbnail');

            console.log(id);
            console.log(name);
            console.log(price);
            console.log(quantity);
            console.log(thumbnail);


            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-quantity').val(quantity);
            $('#edit-price').val(price);
            // console.log($('#thumbnail'))
            $('#display-thumbnail').attr('src', "http://localhost/myphp/crud_image/uploads/"+thumbnail );
            $('#old-thumbnail').val(thumbnail);

        })
    });
</script>
</html>



<!-- Modal Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input id="name" name="name" class="form-control" type="text" placeholder="Product name..">
            </div>
            <div class="mb-3">
                <input id="price" name="price" class="form-control" type="text" placeholder="Product Price..">
            </div>
            <div class="mb-3">
                <input id="quantity" name="quantity" class="form-control" type="text" placeholder="Product quantity...">
            </div>
            <div class="mb-3">
                <label for="thumbnail">Product Thumbnail</label>
                <input id="thumbnail" name="thumbnail" class="form-control" type="file" placeholder="Product name..">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-download-fill"></i> Save Product</button>
            </div>
        </form>

      </div>

    </div>
  </div>
</div>



<!-- Modal Update -->
 <!-- Button trigger modal -->
  <!-- copy the data-bs-toggle and data-bs-target and path into a button update -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="modal-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">UPDATE PRODUCT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="update.php" method="post" enctype="multipart/form-data">
            <input id="edit-id" hidden name="edit-id" type="text">
            <div class="mb-3">
                <input id="edit-name" name="name" class="form-control" type="text" placeholder="Product name..">
            </div>
            <div class="mb-3">
                <input id="edit-price" name="price" class="form-control" type="text" placeholder="Product Price..">
            </div>
            <div class="mb-3">
                <input id="edit-quantity" name="quantity" class="form-control" type="text" placeholder="Product quantity...">
            </div>
            <div class="mb-3">
                <label for="thumbnail">Old Thumbnail</label>
                <input name="old-thumbnail" hidden id="old-thumbnail" type="text">
                <img class="d-block" width="200px" id="display-thumbnail" src="" alt="">
            </div>
            <div class="mb-3">
                <label for="thumbnail">Product Thumbnail</label>
            
                <input id="thumbnail" name="thumbnail" class="form-control" type="file" placeholder="Product name..">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-circle-fill"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-download-fill"></i> Save Product</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>