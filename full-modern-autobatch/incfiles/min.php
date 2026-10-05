<?php ?>

$(document).ready(function(){
			$( "#namesearch, #phonesearch, #datesearch" ).keyup(function() {
				var datesearch = $('#datesearch').val();
				var namesearch = $('#namesearch').val();
				var phonesearch = $('#phonesearch').val();
				$.post("<?php echo base_url().'admin/ajaxgetcontent';?>",
					{ datesearch: $('#datesearch').val(), namesearch: $('#namesearch').val(), phonesearch: $('#phonesearch').val(), submit:true},
					function(data, textStatus, jqXHR)
					{
						$("#contentwrap").html(data);
					}).fail(function(jqXHR, textStatus, errorThrown)
					{
						alert('Something went wrong, please contact to admin via phone to quickly check 0909 535 622 (Mr. Hưng)');
				});
			});
		});

<?php ?>