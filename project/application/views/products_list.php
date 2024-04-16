<!DOCTYPE html>
<html lang="en">
<style>
    .product-details {
        display: flex;
        justify-content: space-between;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Products<button class="btn btn-success float-end" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Add</button></div>
                    <div class="card-body" id="product_data"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Cart List</div>
                    <div class="card-body" id="cart_data"></div>
                    <div class="card-footer" id="totalAmount"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Add Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="message"></div>
                    <form enctype="multipart/form-data" method="post" id="myForm">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary" id="add_pro">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            get_products()
            cart_data()
            $('#myForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '<?php echo base_url("submit_form"); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#message').html(response);
                        $("#myForm")[0].reset();
                        get_products()
                    }
                });
            });

            function get_products() {
                //get_products

                $.ajax({
                    url: '<?php echo base_url("get_products"); ?>',
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        var html = '';
                        for (var i = 0; i < response.length; i++) {
                            var image_url = "<?php echo base_url(); ?>" + "/uploads/" + response[i].image;
                            html += '<div class="col-md-4">';
                            html += '<div class="card">';
                            html += '<img src="' + image_url + '" class="card-img-top" alt="Product Image">';
                            html += '<div class="card-body">';
                            html += '<h5 class="card-title">' + response[i].product_name + '</h5>';
                            html += '<p class="card-text">Price: ' + response[i].price + '</p>';
                            html += '<button class="btn btn-primary" id="add_cart" data-id="' + response[i].product_id + '">Add Cart</button>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                        }
                        $('#product_data').html('<div class="row">' + html + '</div>');
                    }
                });
            }

            $(document).on('click', '#add_cart', function(e) {
                e.preventDefault
                var id = $(this).data('id')
                $.ajax({
                    url: "<?php echo base_url(); ?>add_cart",
                    data: {
                        id: id
                    },
                    method: "POST",
                    dataType: 'json',
                    success: function(response) {
                        alert(response)
                        cart_data()
                    }
                })
            })


            function cart_data() {
                $.ajax({
                    url: '<?php echo base_url("get_cart_data"); ?>',
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function(response) {
                        if (response.length > 0) {
                            var html = '';
                            var totalPrice = 0;

                            for (var i = 0; i < response.length; i++) {
                                var image_url = "<?php echo base_url(); ?>/uploads/" + response[i].image;
                                var productPrice = parseFloat(response[i].price);
                                totalPrice += productPrice;


                                html += '<div class="cart-item">';
                                html += '<img src="' + image_url + '" alt="Product Image" width="50px">';
                                html += '<div class="product-details">';
                                html += '<h5 class="product-name">' + response[i].product_name + '</h5>';
                                html += '<p class="product-price">Price: Rs ' + productPrice.toFixed(2) + '</p>';
                                html += '</div>';
                                html += '</div>';
                            }

                            if (response.length > 0) {
                                totalPrice += 30;
                                var totalHtml = '<div class="total-amount">Total Amount (including delivery charge): Rs ' + totalPrice.toFixed(2) + '</div>';
                            } else {
                                totalPrice += 0;
                            }



                            $('#cart_data').html(html);
                            $('#totalAmount').html(totalHtml);
                        } else {
                            $('#cart_data').text("No Data Found");
                        }
                    }
                });
            }
        })
    </script>
</body>

</html>