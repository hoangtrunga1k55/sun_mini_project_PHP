<script>
    $(window).ready(function () {
        $("#target-content").load("/Sun_Mini_Project_login/controllers/UserController/pagination.php?page=1");

        $(".page-link").click(function () {
            var id = $(this).attr("data-id");
            var select_id = $(this).parent().attr("id");
            $.ajax({
                url: "/Sun_Mini_Project_login/controllers/UserController/pagination.php",
                type: "GET",
                data: {
                    page: id
                },
                cache: false,
                success: function (dataResult) {
                    $("#target-content").html(dataResult);
                    $(".pageitem").removeClass("active");
                    $("#" + select_id).addClass("active");
                }
            });
        });

        $(document).on('click', '.delete', function () {
            var checkstr = confirm('Bạn có chắc chắn muốn xóa');
            if (checkstr == true) {
                var id = $(this).data('id');
                $clicked_btn = $(this);
                $.ajax({
                    url: '/Sun_Mini_Project_login/controllers/UserController/delete.php',
                    type: 'GET',
                    data: {
                        'id': id,
                    },
                    success: function (response) {
                        $clicked_btn.parents("tr").remove();
                    }
                });
            } else {
                return false;
            }

        });

        $(document).on('click', '.btn-success.add', function () {
            $("section.content input").val('');
        })

        $(document).on('click', '.btn-primary.add', function () {
            var id = $("input[name=id]").val();
            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            var address = $("input[name=address]").val();
            var image = $("input[name=image]").prop('files')[0];
            var role = $("#role option:selected").val();
            $clicked_btn = $(this);
            var fd = new FormData();
            fd.append('id', id);
            fd.append('email', email);
            fd.append('password', password);
            fd.append('address', address);
            fd.append('role', role);
            fd.append('image', image);
            $.ajax({
                url: '/Sun_Mini_Project_login/controllers/UserController/add.php',
                type: 'POST',
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    var response = JSON.parse(response);
                    console.log(response);
                    if (response.status == 500) {
                        alert(JSON.stringify(response.error));
                    }
                    if (response.status == 200) {
                        alert('Thêm thành công');
                        $('.modal.fade.show').removeAttr('aria-modal');
                        $('.modal.fade.show').attr('aria-hidden', 'true');
                        $('.modal.fade.show').removeClass('show');
                        $("section.content input").val('');
                        $('body').removeClass('modal-open');
                        $('tbody').append("<tr id=\"row" + response.data[0] + "\"'> <td>" + response.data[1] + "</td><td>"+response.data[3]+"</td><td><img width='80px' height='80px' src='"+'/Sun_Mini_Project_login/'+response.data[4]+"' alt=''></td><td>" + response.data[5] + "</td><td><button type=\"button\" class=\"btn btn-default edit\" data-toggle=\"modal\" data-target=\"#modal-default\" data-id=\"6\">Sửa</button>|<button class=\"delete btn btn-default\" data-id=\"6\">Xóa</button></td> </tr>");
                    }

                    if (response.status == 300) {
                        alert('Sửa thành công');
                        $('.modal.fade.show').removeAttr('aria-modal');
                        $('.modal.fade.show').attr('aria-hidden', 'true');
                        $('.modal.fade.show').removeClass('show');
                        $("section.content input").val('');
                        $('body').removeClass('modal-open');
                        $("tbody #row"+response.data[0]).remove();
                        $('tbody').append("<tr id=\"row" + response.data[0] + "\"'> <td>" + response.data[1] + "</td><td>"+response.data[3]+"</td><td><img width='80px' height='80px' src='"+'/Sun_Mini_Project_login/'+response.data[4]+"' alt=''></td><td>" + response.data[5] + "</td><td><button type=\"button\" class=\"btn btn-default edit\" data-toggle=\"modal\" data-target=\"#modal-default\" data-id=\"6\">Sửa</button>|<button class=\"delete btn btn-default\" data-id=\"6\">Xóa</button></td> </tr>");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        });

        $(document).on('click', '.editUser', function () {
            var id = $(this).data('id');
            $clicked_btn = $(this);
            $.ajax({
                url: '/Sun_Mini_Project_login/controllers/UserController/edit.php',
                type: 'GET',
                data: {
                    'id': id,
                },
                success: function (response) {
                    var response = JSON.parse(response);
                    $("#modal-default input[name=id]").val(response.data[0]);
                    $("#modal-default input[name=email]").val(response.data[1]);
                    $("#modal-default input[name=password]").val(response.data[2]);
                    $("#modal-default input[name=address]").val(response.data[3]);
                    $("#modal-default select option").each(function (index){
                        if (index == response.data[5]){
                            $(this).attr('selected','selected');
                        } else{
                            $(this).removeAttr('selected');
                        }
                    });
                    $('.modal.fade.show').removeClass('show');
                    $('body').removeClass('modal-open');
                }
            });
        });
    })
</script>
