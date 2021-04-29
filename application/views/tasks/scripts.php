<script>
    $(document).ready(function () {
        console.log("sdsd");
        // $("#all-task").html("<img src='<?= base_url()?>assets/img/loading.gif'>");
        function load_all_tasks(response){
            let html = ``;
            for (let i = 0; i < response.tasks.length; i++) {
                html += `<li>`;
                html += `   <form action="<?= base_url(); ?>tasks/update_task_title" id="update-task-form" method="POST" class="col-md-8 d-flex align-items-center justify-content-between">`;
                html += `       <button class="edit-form btn btn-warning btn-sm text-white"  ${
                    response.tasks[i].status == 1 ? "disabled" : ""
                } type="button"><i class="fas fa-edit"></i></button>`;
                html += `       <button class="cancel-edit-btn btn btn-warning btn-sm text-white" type="button"><i class="fas fa-undo"></i></button>`;
                html += `       <input type="checkbox" ${response.tasks[i].status == 1 ? "checked" : ""}  ${
                    response.tasks[i].status == 1 ? "disabled" : ""
                } name="done" class="done-checkbox" id="">`;
                html += `       <p ${response.tasks[i].status == 1 ? 'style="text-decoration:line-through"' : ""}>${response.tasks[i].name}</p>`;
                html += `       <input type="hidden" name="task_id" value="${response.tasks[i].id}">`;
                html += `       <div class="form-group">`;
                html += `           <input type="text" class="form-control  edit-task" id="task" name="task" value="${response.tasks[i].name}" aria-describedby="task">`;
                html += `       </div>`;
                html += `   </form>`;
                html += `</li>`;
            }

            return html;
        }

        function load_in_progress_tasks(response){
            let html = ``;
            for (let i = 0; i < response.in_progress_task.length; i++) {
                html += `<li>`;
                html += `   <form action="<?= base_url(); ?>tasks/update_task_title" id="update-task-form" method="POST" class="col-md-8 d-flex align-items-center justify-content-between">`;
                html += `       <button class="edit-form btn btn-warning btn-sm text-white"  ${
                    response.in_progress_task[i].status == 1 ? "disabled" : ""
                } type="button"><i class="fas fa-edit"></i></button>`;
                html += `       <button class="cancel-edit-btn btn btn-warning btn-sm text-white" type="button"><i class="fas fa-undo"></i></button>`;
                html += `       <input type="checkbox" ${response.in_progress_task[i].status == 1 ? "checked" : ""}  ${
                    response.in_progress_task[i].status == 1 ? "disabled" : ""
                } name="done" class="done-checkbox" id="">`;
                html += `       <p ${response.in_progress_task[i].status == 1 ? 'style="text-decoration:line-through"' : ""}>${response.in_progress_task[i].name}</p>`;
                html += `       <input type="hidden" name="task_id" value="${response.in_progress_task[i].id}">`;
                html += `       <div class="form-group">`;
                html += `           <input type="text" class="form-control  edit-task" id="task" name="task" value="${response.in_progress_task[i].name}" aria-describedby="task">`;
                html += `       </div>`;
                html += `   </form>`;
                html += `</li>`;
            }

            return html;
        }

        function load_done_tasks(response){
            let html = ``;
            for (let i = 0; i < response.done_task.length; i++) {
                html += `<li>`;
                html += `   <form action="<?= base_url(); ?>tasks/update_task_title" id="update-task-form" method="POST" class="col-md-8 d-flex align-items-center justify-content-between">`;
                html += `       <button class="edit-form btn btn-warning btn-sm text-white"  ${
                    response.done_task[i].status == 1 ? "disabled" : ""
                } type="button"><i class="fas fa-edit"></i></button>`;
                html += `       <button class="cancel-edit-btn btn btn-warning btn-sm text-white" type="button"><i class="fas fa-undo"></i></button>`;
                html += `       <input type="checkbox" ${response.done_task[i].status == 1 ? "checked" : ""}  ${
                    response.done_task[i].status == 1 ? "disabled" : ""
                } name="done" class="done-checkbox" id="">`;
                html += `       <p ${response.done_task[i].status == 1 ? 'style="text-decoration:line-through"' : ""}>${response.done_task[i].name}</p>`;
                html += `       <input type="hidden" name="task_id" value="${response.done_task[i].id}">`;
                html += `       <div class="form-group">`;
                html += `           <input type="text" class="form-control  edit-task" id="task" name="task" value="${response.done_task[i].name}" aria-describedby="task">`;
                html += `       </div>`;
                html += `   </form>`;
                html += `</li>`;
            }

            return html;
        }


        $.get(
            `<?= base_url()?>tasks/load_task_json`,
            function (response) {
                $(".loading-gif-container").hide();
                let all_tasks = load_all_tasks(response);
                $(".task-list").html(all_tasks);

                let in_progress_tasks = load_in_progress_tasks(response);
                $(".in-progress-task-list").html(in_progress_tasks);

                let done_tasks = load_done_tasks(response);
                $(".done-task-list").html(done_tasks);
            },
            "json"
        );

        $("form#add-task-form").submit(function () {
            // $("#all-task").html("<img src='<?= base_url()?>assets/img/loading.gif'>");
            $(".loading-gif-container").show();
            $(".task-list").hide();
            $(".in-progress-task-list").hide();
            $(".done-task-list").hide();
            $.post(
                $(this).attr("action"),
                $(this).serialize(),
                function (response) {
                    $(".loading-gif-container").hide();

                    let all_tasks = load_all_tasks(response);
                    $(".task-list").html(all_tasks);
                    
                    let in_progress_tasks = load_in_progress_tasks(response);
                    $(".in-progress-task-list").html(in_progress_tasks);

                    let done_tasks = load_done_tasks(response);
                    $(".done-task-list").html(done_tasks);

                    $(".task-list").show();
                    $(".in-progress-task-list").show();
                    $(".done-task-list").show();
                    $("#liveToast").toast("show");
                    $(".toast-body").html(`Task has been added successfully`);

                },
                "json"
            );
            $(this).trigger("reset");
            return false;
        });


        $(document).on("submit", "form#update-task-form", function () {
            $(".loading-gif-container").show();
            $(".task-list").hide();
            $(".in-progress-task-list").hide();
            $(".done-task-list").hide();
            $.post(
                $(this).attr("action"),
                $(this).serialize(),
                function (response) {
                    $(".loading-gif-container").hide();
                    let all_tasks = load_all_tasks(response);
                    $(".task-list").html(all_tasks);
                    
                    let in_progress_tasks = load_in_progress_tasks(response);
                    $(".in-progress-task-list").html(in_progress_tasks);

                    let done_tasks = load_done_tasks(response);
                    $(".done-task-list").html(done_tasks);
                   
                   
                    $(".task-list").show();
                    $(".in-progress-task-list").show();
                    $(".done-task-list").show();

                    $("#liveToast").toast("show");
                    $(".toast-body").html(`Task has been updated successfully`);


                },
                "json"
            );
            return false;
        });

        $(this).on("click", ".edit-form", function () {
            if ($(this).attr("type") == "submit") {
                // $(this).siblings("p").show();
                // $(this).siblings("div.form-group").children(".edit-task").hide();
                // $(this).attr("type","button");
                // $(this).siblings(".cancel-edit-btn").hide();
                // $(this).parent('form').addClass("col-md-8");
                // $(this).parent('form').removeClass("col-md-10");
            } else {
                $(this).attr("type", "submit");
                $(this).siblings(".cancel-edit-btn").show();
                $(this).siblings("p").hide();
                $(this).siblings("div.form-group").children(".edit-task").show();
                $(this).removeClass("edit-form");
                $(this).siblings(".done-checkbox").hide();
            }
            return false;
        });

        $(this).on("click", ".cancel-edit-btn", function () {
            $(this).siblings("p").show();
            $(this).siblings("div.form-group").children(".edit-task").hide();
            $(this).siblings("button").attr("type", "button");
            $(this).hide();
            $(this).addClass("edit-form");
            $(this).siblings(".done-checkbox").show();
            return false;
        });

        $(this).on("click", ".done-checkbox", function () {
            $(this).siblings("p").css("text-decoration", "line-through");
            $(this).siblings("button").attr("disabled", true);
            let form_data = $(this).parent().serialize();
            // console.log(form_data);
            $.post(`<?= base_url();?>tasks/update_task_status`,form_data,function (response) {
                let all_tasks = load_all_tasks(response);
                $(".task-list").html(all_tasks);
                
                let in_progress_tasks = load_in_progress_tasks(response);
                $(".in-progress-task-list").html(in_progress_tasks);

                let done_tasks = load_done_tasks(response);
                $(".done-task-list").html(done_tasks);


                $("#liveToast").toast("show");
                $(".toast-body").html(`This task has been done successfully`);
                $(".task-list").show();
            },"json");

            // if ($(this).is(":checked")) {
            //     $(this).siblings("p").css("text-decoration", "line-through");
            //     $(this).siblings("button").attr("disabled", true);
            // } else {
            //     $(this).siblings("p").css("text-decoration", "none");
            //     $(this).siblings("button").attr("disabled", false);
            // }
        });
    });

</script>