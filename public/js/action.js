$(document).ready(function () {
   
    $(function() {
       listUsers = $('#myTable').DataTable({
            dom: 'Bfrtip',   
            autoWidth: true,
            processing: true,
            serverSide: true,
            language: {
                processing: '<div id="loader">Đang load dữ liệu!</div>',
            },
            buttons: {
               buttons: [
                    {
                        extend:'excel', className:'btn btn-info btn-flat'
                    },
                    {
                        extend:'pdf', className:'btn btn-danger btn-flat'
                    },
                    {
                        extend:'copy', className:'btn btn-primary btn-flat'
                    },
                    
                ]
            },
            select: true,
            ajax: {
                url: route('users.create')
            },
            columns: [
                { data: 'id', name: 'users.id' , render: function(data) {
                   return data;
                }},
                { data: 'email', name: 'users.email' },
                { data: 'lastname', name: 'users.lastname' },
                { data: 'firstname', name: 'users.firstname' },
                
                { data: 'address', name: 'users.address' },
                { data: 'phone', name: 'users.phone', width: "15%" },
                { data: 'action', name: 'action', width: "15%" },
            ],
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).attr('class', 'filter');
                    $(input).attr('style', 'width: 100%');

                    // Gõ liệu cần nhập vào input của cột cần lọc nó sẽ lọc lại dữ liệu bảng
                    $(input).appendTo($(column.footer()).empty()).on('keyup change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
                // Ẩn input cột đầu tiên trong table
                $('#myTable > tfoot > tr > th:nth-child(1) > input').hide();
            },
            drawCallback: function () {
                console.log('DataTables has redrawn the table!');
            },
            order: [0,'asc'],
           
        });
    });
    
    $('#buttonPaginationListUsers').click(function () {
        var inputPage = parseInt($('#inputPaginationListUsers').val());
        var totalPages = listUsers.page.info().pages;
        if (!inputPage) {
            alert("Please input the number of page!");
            return false;
        } else if (inputPage > totalPages) {
            alert("Sorry, this page is unavailable!");
        } else {
            listUsers.page(inputPage - 1).draw(false);
        }
    });

    // Click vào nút create trên trang sẽ hiện thị modal - create.
    $(document).on('click', '#create', function(event) {
        $('#password').removeAttr('disabled');
        $('#repassword').removeAttr('disabled');
        $('#changePass').css('display', 'none');
        $('#form-signup')[0].reset();
        showModal('myModel');
    });

   
    // Bắt sự kiện khi người dùng bấm submit trong modal create/edit.
    $('#form-signup').on('submit', function(event) {
        event.preventDefault();
        // Chức năng khởi tạo user
        if ($('#action_button').val() == 'Sign up') {
            $.ajax({
                url: route('users.store'),
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(data, status) {
                    refreshValidate();
                    if (data.errors) {
                        checkValidate(data.errors);
                    } 
                    if (data.success) {
                        $('#form_result').html(data.success);
                        $('#form-signup')[0].reset();
                        $('#myTable').DataTable().ajax.reload();
                    } else {
                        $('#form_result').html('');
                    }
                }
            });
        }

        //Chức năng cập nhật
        if ($('#action_button').val() == 'Edit') {
            $.ajax({
                url: route('users.update', user_id),
                type: 'POST',
                headers: { 
                    "X-HTTP-Method-Override": "PUT" 
                },
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                   
                    if (data.errors) {
                        checkValidate(data.errors);
                    } 
                    if (data.success) {
                        $('#form_result').html(data.success);
                        $('#form-signup')[0].reset();
                        $('#myTable').DataTable().ajax.reload();
                    } else {
                        $('#form_result').html('');
                    }
                }
            });
        }
    });

    // Khi tắt modal create/edit sẽ refresh lại các validate đã bắt trước đó.
    $('#cancel, .close').on('click', function() {
        refreshValidate();
     });

    // Biến user_id dùng để truyền biến trong 1 route khi gọi trong url của ajax.
    var user_id;

     // Click vào nút delete để hiện thị modal thông báo việc xác nhận sẽ xóa 1 record.
     $(document).on('click', '.delete', function() {
       
        user_id = $(this).attr('id');
        $("#confirmModal").modal('show');
     });

    // Khi click vào nút OK trên modal thông báo nó sẽ dùng ajax để xử lý việc xóa 1 record.
     $("#button_ok").on('click', function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $(this).attr('data-token')
            }
        })

        $.ajax({
           url: route('users.destroy', user_id),
           type: 'DELETE',
           dataType: 'json',
           data: {
               'user_id': user_id
               
           },
           beforeSend: function() {
               $('#button_ok').text('Deleting....');
           },
           success: function(data){
               console.log(1);
               if (data.success) {
                   setTimeout(() => {
                    $('#button_ok').text('OK');
                    $("#confirmModal").modal('hide');
                    listUsers.draw();
                   }, 2000);
               }
           },
        });
     });
    
    // Sự kiện khi click vào nút Edit sẽ hiện thị modal edit cho người dùng sửa dữ liệu.
    $(document).on('click', '.edit', function(event) {
        $('#password').attr('disabled','disabled');
        $('#repassword').attr('disabled','disabled');
        $('#changePass').css('display', 'block');
        user_id = $(this).attr('id');
        $('form_result').html('');
        
        $.ajax({
            url: route('users.edit', user_id),
            dataType: 'json',
            success: function(data,status) {
                if (data) {
                    console.log(data.user);
                    $('#email').val(data.user.email)
                    $('#firstname').val(data.user.firstname)
                    $('#lastname').val(data.user.lastname);
                    $('#phone').val(data.user.phone);
                    $('#address').val(data.user.address);
                    $('#myModel .modal-title').html('Edit User');
                    $('#myModel .modal-body #action_button').html('Edit');
                    $('#myModel .modal-body #action_button').val('Edit');
                    showModal('myModel');
                }
            }

        });
    });

    //Xét trạng thái của checkbox trong form edit
    $(document).on('change', '#chkChange', function() {
        var isChecked = ($(this).is(':checked'));
        if (isChecked == true) {
             $('#password').removeAttr('disabled');
             $('#repassword').removeAttr('disabled');
        } else {
             $('#password').attr('disabled','disabled');
             $('#repassword').attr('disabled','disabled');
        }
     })
    
  
});

function checkValidate(arrayError) {
    var arr = [];
    
    for(var i in arrayError) {
       arr[i] = arrayError[i];
       
    }

   for (var item in arr) {
        if (arr[item] != '') {
            $('#'+item+'_error').html(arr[item]);
        } else {
            $('#'+item+'_error').html('');
        }
    }
}

function showModal(idModal) {
    refreshValidate();
    $('#' + idModal).modal('show');
}

function refreshValidate() {
    var span_error = $('.form-group label>span');
    for (var index = 0; index < span_error.length; index++) {
        span_error[index].innerHTML = '';
     }
}