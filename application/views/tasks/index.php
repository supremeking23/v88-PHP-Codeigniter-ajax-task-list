<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

   

    <title>Task Application</title>
    <style>
        body {
                background:#eee
        }

        .navbar {
            /* -webkit-box-shadow: 3px 6px 24px -1px rgba(42,42,42,1);
            -moz-box-shadow: 3px 6px 24px -1px rgba(42,42,42,1);
            box-shadow: 3px 6px 24px -1px rgba(42,42,42,1); */
        }

        .container {
            background:#fff;
            padding:20px;
            
        }

        form{
            /* margin:0 auto; */
           
        }

        .form-control {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #9e9e9e;
            border-radius: 0;
            outline: none;
            height: 3rem;
            width: 100%;
            font-size: 16px;
            margin: 0 0 8px 0;
            padding: 0;
        }

        .form-control:focus{
            border-bottom: 1px solid #ffc107;
            -webkit-box-shadow: 0 0 0 0 #ffc107;
            box-shadow: 0 0 0 0 #ffc107;

            
        }

        .task-text-input{
            width:530px;
            margin-right:1rem;
        }

        a {
            color:#ffc107;
        }

        a:hover {
            color:#ffc107;
        }

        ul li {
            list-style: none;
            margin-top:1rem;
        }

        input[type="checkbox"] {
			transform: scale(2);
        }

        .edit-task{
            display:none;
            width:320px;
            /* margin-left:1rem */
        }

        p {
            width:320px;
        }

        .cancel-edit-btn{
            display:none;
        }

        .toast button span {
            color: #fff;
        }

    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <?php $this->load->view("tasks/scripts")?>
  </head>
  <body>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-warning">
        <span class="navbar-brand mb-0 h1">Task Application </span>
    </nav>

    <div class="container mt-5">
        
        <div class="row">
            
            <form id="add-task-form" action="<?= base_url();?>tasks/add_task" method="POST" class="col-md-12 d-flex align-items-center justify-content-center">
                <div class="form-group">
                    <input type="text" class="form-control task-text-input" id="task" name="task" aria-describedby="task">
                </div>  
                <button type="submit" class=" btn btn-warning text-white"><i class="fas fa-plus-circle"></i></button>
            </form>
        </div>

        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="all-task-tab" data-toggle="tab" href="#all-task" role="tab" aria-controls="all-task" aria-selected="true">All Task</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="in-progress-tab" data-toggle="tab" href="#in-progress" role="tab" aria-controls="in-progress" aria-selected="false">In Progress</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="done-tab" data-toggle="tab" href="#done" role="tab" aria-controls="done" aria-selected="false">Done</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="all-task" role="tabpanel" aria-labelledby="all-task-tab">
                        
                        <div class="row loading-gif-container">
                            <div class="col-md-12 d-flex justify-content-center">
                                <img src='<?= base_url()?>assets/img/loading.gif'>
                            </div>
                        </div>


                        <ul class="task-list">
                        

                        </ul>
                    </div>
                    <div class="tab-pane fade" id="in-progress" role="tabpanel" aria-labelledby="in-progress-tab">
                        <ul class="in-progress-task-list">
                         

                        </ul>
                    </div>
                    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">Done</div>
                </div>

            </div>
        </div>



        <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                <div class="toast-header bg-success text-white">
                    <strong class="mr-auto ">Success!!</strong>
                    <!-- <small>11 mins ago</small> -->
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Task has been added successfully
                </div>
            </div>
        </div>
        
    </div>

  </body>
</html>


<?php 
// form_open(base_url()."tasks/add_task",array("class" => "col-md-12 d-flex align-items-center justify-content-center", "id" => "add-task-form"))
?>