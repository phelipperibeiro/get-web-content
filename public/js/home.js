$(document).ready(function () {

    //https://speed.hetzner.de/100MB.bin

    deleteFile = function (value) {
        $.ajax({
            type: "DELETE",
            url: '/delete-file',
            data: {file: value},
            success: function (msg) {
                //alert('to aqui mano (deleteFile)');
                loadFiles();
            }
        });

    }

    loadFiles = function () {

        $.ajax({
            type: "GET",
            url: '/load-files',
            success: function (arrayFiles) {

                $("#file-tables-tbody tr").remove();

                $.each(arrayFiles, function (index, value) {

                    var filePath = value ;
                    filePath = filePath.split(".", 1);
                    
                    var element = "<tr>\n\
                                        <th scope='row'>" + index + "</th>\n\
                                        <td colspan='3' >" + value + "</td>\n\
                                        <td>\n\
                                            <a href=\"\/download-file\/"+filePath+"\" target='_blank' class='btn btn-primary'>Download</a>&nbsp&nbsp&nbsp\n\
                                            <button type='button' value='" + value + "' onload=\"deleteFile('" + value + "')\" class='btn btn-danger'>Delete</button>\n\
                                        </td>\n\
                                    </tr>";

                    $("#file-tables-tbody").append(element);
                });
            }
        });
    }

    loadFiles();

    $('#file-tables-tbody').on('click', '.btn-danger', function (event) {
        
        event.preventDefault();

        var file = $(this).val();

        deleteFile(file);

    });

    $("#download").click(function () {

        var fileName = $("#file-name").val();
        var link = $("#link").val();

        $.ajax({
            type: "POST",
            url: '/save-file',
            data: {fileName: fileName, link: link},
            success: function (msg) {
                //alert(msg);
                loadFiles();
            }
        });
    });

});
