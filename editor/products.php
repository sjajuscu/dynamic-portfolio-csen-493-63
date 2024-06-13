<?php
include("header.php");

// include("dbconfig.php");
$parents = array();
?>


<body>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <button class="btn btn-primary" data-toggle='modal' data-target='#modal_newentry' style="float: right;">Add New</button>
            </div>
        </section>
        
        <?php
        include("table.php");
        include("entrymodal.php");
        ?>

<div class="modal fade bd-example-modal-lg" id="modal_newentry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="padding-left: 30px;padding-top: 5px" id="modal_pagename"></h5>
                        <button type="button" style="padding-right: 40px" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="entry_type" value="0" id="entry_type">
                            <div class="title1">
                                <h6 id="titlelabel" style="float: left;">Product Name</h6>
                                <input type="text" class="form-control" id="title" placeholder="Enter Product Name" name="title" style="width: 100%;" autocomplete="off" />
                            </div>
                            <div id="" class="mt-3">
                                <!--<div name="richtext" id="summernote"></div>-->
                                <input type="hidden" name="code" value="">
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <label class="text-muted"> Product Image</label>
                                        <div class="custom-file">
                                            <input type="file" id="choose-file" name="attachment" class="custom-file-input">
                                            <label class="custom-file-label" id="filename" for="choose-file" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group mb-0">
                                            <label class="text-muted"> Enter Product Cost</label>
                                            <input type="text" class="form-control" name="url" id="cost" placeholder="₹" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" onclick="getcontents()" id="submit" name="newentry" class="btn btn-success mt-3" style="float: right;width:100%"><i class="fa fa-plus" style="margin-right: 5px;"></i>Add Product</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </html>