<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .custom-btn {
            margin-top: 14px;
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
                                <input type="text" name="username" placeholder="Enter Name" class="form-control"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" placeholder="Enter Email" class="form-control"
                                    autocomplete="off">
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
                        <div class="col-12 product-html-wrapper" style="display: none">
                            <div class="row">
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="category">Product<span
                                                        class="text-danger">*</span></label>
                                                <select name="product_id" class="form-control product_id" id="">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Qty<span class="text-danger">*</span></label>
                                                <input type="number" name="qty[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Price<span class="text-danger">*</span></label>
                                                <input type="number" name="price[]" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Total Price<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_price[]" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 mt-3">
                                    <button type="button" class="btn btn-info custom-btn"
                                        onclick="addfield()">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        //form validations
        (function() {
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
                        } else {
                            $('.product-html-wrapper').hide();
                        }

                    },
                    error: function(errorString) {}
                });
            } else {
                $('.product-html-wrapper').hide();
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
                                                <input type="number" name="qty[]" id="qty_${numbervar}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Price<span class="text-danger">*</span></label>
                                                <input type="number" name="price[]"  class="form-control" id="price_${numbervar}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="price">Total Price<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" name="total_price[]" class="form-control" id="total_price_${numbervar}" readonly>
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
            ddl.attr("class", "form-control");
            $('#append_product_dropdown__' + numbervar).empty();
            $('#append_product_dropdown_' + numbervar).append(ddl);

        }

        //get product price on change
        $(document).on('change','.product_id',function(){
            
        })
    </script>
</body>

</html>
