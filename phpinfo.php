<?php phpinfo();?>











<script src="https://static.filestackapi.com/v3/filestack.js"></script>
<script type="text/javascript">
  var fsClient = filestack.init('AUmmvPLyBR5KDO6n2Y7agz');
  function openPicker() {
    fsClient.pick({
      accept: 'image/*',
      minFiles: 1,
      maxFiles: 1,
      maxSize: (100 * 1024 * 1024)
    }).then(function(response) {
      // declare this function to handle response
      handleFilestack(response);
    });
  }
</script>