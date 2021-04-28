<script>
    $(document).ready(function () {
        console.log("sdsd");
        // $("#all-task").html("<img src='<?= base_url()?>assets/img/loading.gif'>");
        $.get(
            `<?= base_url()?>tasks/load_task_json`,
            function (response) {
                $(".loading-gif-container").hide();

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
                $(".task-list").html(html);

                let in_progress = ``;
                for (let i = 0; i < response.in_progress_task.length; i++) {
                    in_progress += `<li>`;
                    in_progress += `   <form action="<?= base_url(); ?>tasks/update_task_title" id="update-task-form" method="POST" class="col-md-8 d-flex align-items-center justify-content-between">`;
                    in_progress += `       <button class="edit-form btn btn-warning btn-sm text-white"  ${
                        response.in_progress_task[i].status == 1 ? "disabled" : ""
                    } type="button"><i class="fas fa-edit"></i></button>`;
                    in_progress += `       <button class="cancel-edit-btn btn btn-warning btn-sm text-white" type="button"><i class="fas fa-undo"></i></button>`;
                    in_progress += `       <input type="checkbox" ${response.in_progress_task[i].status == 1 ? "checked" : ""}  ${
                        response.in_progress_task[i].status == 1 ? "disabled" : ""
                    } name="done" class="done-checkbox" id="">`;
                    in_progress += `       <p ${response.in_progress_task[i].status == 1 ? 'style="text-decoration:line-through"' : ""}>${response.in_progress_task[i].name}</p>`;
                    in_progress += `       <input type="hidden" name="task_id" value="${response.in_progress_task[i].id}">`;
                    in_progress += `       <div class="form-group">`;
                    in_progress += `           <input type="text" class="form-control  edit-task" id="task" name="task" value="${response.in_progress_task[i].name}" aria-describedby="task">`;
                    in_progress += `       </div>`;
                    in_progress += `   </form>`;
                    in_progress += `</li>`;
                }

                $(".in-progress-task-list").html(in_progress);
            },
            "json"
        );

        $("form#add-task-form").submit(function () {
            // $("#all-task").html("<img src='<?= base_url()?>assets/img/loading.gif'>");
            $(".loading-gif-container").show();
            $(".task-list").hide();
            $.post(
                $(this).attr("action"),
                $(this).serialize(),
                function (response) {
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
                    $(".loading-gif-container").hide();
                    $("#liveToast").toast("show");
                    $(".toast-body").html(`Task has been added successfully`);
                    $(".task-list").show();
                    $(".task-list").html(html);
                },
                "json"
            );
            $(this).trigger("reset");
            return false;
        });


        $(document).on("submit", "form#update-task-form", function () {
            $(".loading-gif-container").show();
            $(".task-list").hide();
            $.post(
                $(this).attr("action"),
                $(this).serialize(),
                function (response) {
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
                    $(".loading-gif-container").hide();
                    $("#liveToast").toast("show");
                    $(".toast-body").html(`Task has been updated successfully`);
                    $(".task-list").show();
                    $(".task-list").html(html);
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
                $(".task-list").html(html);
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