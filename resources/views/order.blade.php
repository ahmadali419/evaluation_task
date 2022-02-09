<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
        .custom-btn {
            margin-top: 14px;
        }
        .error{
            color: red!important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-9 offset-col-5 mt-3">
                <h3>Create Order</h3>
                <hr>
                <form id="addForm">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" name="username" placeholder="Enter Name" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category">Category<span class="text-danger">*</span></label>
                                <select name="cat_id" id="" class="form-control cat_id">
                                    @if (!$categories->isEmpty())
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $catObj)
                                    <option value="{{ $catObj->id }}">{{ $catObj->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="product-html-wrapper" style="display: none">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="category">Product<span class="text-danger">*</span></label>
                                                    <select name="product_id[]" class="form-control product_id product-id" onchange="getPrice(0)" id="product_id_0">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="price">Qty<span class="text-danger">*</span></label>
                                                    <input type="number" name="qty[]" min="1" data-key="0" class="form-control order_qty" id="qty_0">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="price">Price<span class="text-danger">*</span></label>
                                                    <input type="number" name="price[]" class="form-control order_price" id="price_0" readonly>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="price">Total Price<span class="text-danger">*</span></label>
                                                    <input type="number" name="order_total_price[]" id="total_price_0" class="form-control order_total_price" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-3">
                                        <button type="button" class="btn btn-info custom-btn" onclick="addfield()">+</button>
                                    </div>
                                </div>

                            </div>

                            <div class="row total_qty_html" style="display: none;">
                                <div class="col-4">
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Total Qty</label>
                                        <input type="number" name="total_qty" readonly class="form-control total_qty">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Total Price</label>
                                        <input type="number" name="total_price" readonly class="form-control total_price">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="checkbox" id="note" name="note" >
                                <label for="note">Note</label><br>
                                <i>Please checked checkbox for any note</i>
                                <div id="note_input" style="display: none;">
                                    <textarea name="note" class="form-control" id="order_note" cols="30" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="button" class="btn btn-info" id="btn_save">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //form validations
       
        var validator = $("#addForm").validate({
                rules: {
                    username: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    cat_id: {
                        required: true
                    },


                },
                errorPlacement: function(error, element) {
                    var elem = $(element);
                    if (elem.hasClass("department_id")) {

                        error.appendTo(element.parent().after());
                        //error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            });



        //on chnage category get related products

        $(document).on('change', '.cat_id', function() {
            var cat_id = $(this).val();
            if (cat_id != '') {
                var form_data = new FormData();
                form_data.append('id', cat_id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('getProductByCat') }}", // your php file name
                    data: form_data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.statusCode == 200) {
                            var html = '<option value="">Select Product</option>';
                            $(res.products).each(function(index, item) {
                                html +=
                                    `<option name="product_id[]" value="${item.id}">${item.name}</option>`;
                            });
                            $('.product_id').html('');
                            $('.product_id').html(html);
                            $('.product-html-wrapper').show();
                            $('.total_qty_html').show();
                        } else {
                            $('.product-html-wrapper').hide();
                            $('.total_qty_html').hide();
                        }

                    },
                    error: function(errorString) {}
                });
            } else {
                $('.product-html-wrapper').hide();
                $('.total_qty_html').hide();
            }
        });


        //add Filed on click 
        var numbervar = 1;

        function addfield() {

            var cat_id = $('.cat_id option:selected').val();

            if (cat_id != '') {
                var product_wrapper_html = '';
                product_wrapper_html = `<div class="row" id="child_${numbervar}">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="category">Product<span
                                                        class="text-danger">*</span></label>
                                                        <div id="append_product_dropdown_${numbervar}">
                                                       
                                                        </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Qty<span class="text-danger">*</span></label>
                                                <input type="number" name="qty[]" data-key="${numbervar}" id="qty_${numbervar}" class="form-control order_qty" id="qty_${numbervar}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Price<span class="text-danger">*</span></label>
                                                <input type="number" name="price[]" data-price-id="price_${numbervar}" value=""  class="form-control order_price" id="price_${numbervar}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Total Price<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="order_total_price[]" class="form-control order_total_price" id="total_price_${numbervar}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    <button type="button" class="btn btn-danger custom-btn" onclick="removeField(${numbervar})">x</button>
                                </div>
                            </div>`;

                $('.product-html-wrapper').append(product_wrapper_html);
                cloneProductDropdown(numbervar);
                numbervar++;
            } else {
                toastr.warning('please choose Product first');
            }
        }


        //remove field

        function removeField(item) {
            $('#child_' + item).remove();
        }

        //clone productDropdown

        function cloneProductDropdown(numbervar) {
            var ddl = $(".product_id").clone();
            ddl.attr("id", 'product_id_' + numbervar);
            ddl.attr("name", "product_id[]");
            ddl.attr("data-product-id", numbervar);
            ddl.attr("class", "form-control product-id");
            $('#append_product_dropdown_' + numbervar).empty();
            $('#append_product_dropdown_' + numbervar).append(ddl);
            $('#product_id_' + numbervar).change(function() {
                getPrice(numbervar);
            });

        }

        //get product price on change
        function getPrice(id) {
            
            var product_id = $('#product_id_' + id).val();
            if (product_id != '') {
                var form_data = new FormData();
                form_data.append('id', product_id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('getProductPrice') }}", // your php file name
                    data: form_data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.statusCode == 200) {
                            $('#price_' + id).val('');
                            $('#price_' + id).val(res.productPrice.price);
                        } else {

                        }

                    },
                    error: function(errorString) {}
                });
            }

        }
        //on change qty update product price
        $(document).on('keyup', '.order_qty', function() {
            var key = $(this).attr('data-key');
            var product_id = $('#product_id_'+key).val();
            console.log(product_id);
            if(product_id != ''){
            var product_price = $('#price_' + key).val();    
            var qty = $(this).val();
            if (product_price && qty) {
                var total_price = Number(product_price) * Number(qty);
                $('#total_price_' + key).val(total_price);
            } else {
                $('#total_price_' + key).val('');
            }
            var order_qty = $('.order_qty').val();
            var total_qty = 0;
            $(".order_qty").each(function(){
              total_qty += Number($(this).val());
            });
            //set total qty
            if(total_qty){
                $('.total_qty').val(total_qty);
            }
            var total_price = 0;
           //set total price
            $(".order_total_price").each(function(){
              total_price += Number($(this).val());
            });
            if(total_price){
                $('.total_price').val(total_price);
            }
            }else{
                $(this).val('');
                toastr.warning('Please select product first');
            }
            
        })


        function additionalValidtion() {
            $('.product-id').each(function() {
                
                var id = $(this).attr('id');
               
                $('#' + id).rules("add", {
                    required: true
                });
            });

            $('.order_price').each(function() {
                var id = $(this).attr('id');
               

                $('#' + id).rules("add", {
                    required: true
                });
            });
            $('.order_qty').each(function() {
                var id = $(this).attr('id');
               

                $('#' + id).rules("add", {
                    required: true
                });
            });
        }


        //show textarea if note is checked
        $('#note').on('change', function() {
            this.value = this.checked ? 1 : 0;
            if (this.checked) {
                $('#note_input').show();
            } else {
                $('#note_input').hide();
            }
        });


        //save order
        $(document).on('click','#btn_save',function(){
           
            var validate = $('#addForm').valid();
            additionalValidtion();
            if(validate){
                var form = $('#addForm')[0];
                var form_data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "{{ route('order.create') }}", // your php file name
                    data: form_data,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res.statusCode == 200) {
                           toastr.success(res.message);
                           setTimeout(() => {
                            window.location.href = "{{route('order.success')}}";
                           }, 2000);
                        }if(res.statusCode == 422) {
                            toastr.warning(res.error);
                        }
                        if(res.statusCode == 400) {
                            toastr.warning('Something went wrong try again');
                        }
                    },
                    error: function(errorString) {}
                });
            }
        });

       

    </script>
</body>

</html>