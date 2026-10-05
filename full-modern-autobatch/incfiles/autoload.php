<?php ?>
<script type="text/javascript" src="/jquery-vina4u.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      refreshTable();
    });
    function refreshTable(){
        $('#autoload-notice').load('<?php echo"/jquerynotice"; ?>', 
           function(){
           setTimeout(refreshTable, 5000);
        });
    }
</script>
<?php?>