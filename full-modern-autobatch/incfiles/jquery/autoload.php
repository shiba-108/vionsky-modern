<?php $autonotice = ($datauser['thongbaocanhan'] == 0 ? '' : '<span class="mitemCount">'.$datauser['thongbaocanhan'].'</b></span>'); ?>
<script type="text/javascript" src="<?php echo $home; ?>/jquery-vina4u.js"></script>
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){refreshTable();});
function refreshTable(){$('#notice').load('/jqrnotice', function(){setTimeout(refreshTable, 10000);});
$('#mail').load('/jqrmail', function(){setTimeout(refreshTable, 10000);});}
</script>