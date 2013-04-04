<div>
	<form action="{$smarty.const.KERNEL_PKG_URI}admin/index.php?page=spamurai" method="POST">
		<input type="hidden" name="page" value="{$smarty.request.page}" />
			<div class="control-group">
			<div class="formlabel"> Spamurai API Key </div>
			<div class="forminput"><input type="textbox" name="spamurai_api_key" value="{$apiKey}"/> </div>
			</div>
		 <input type="submit" class="btn" value="Submit" />
	</form>
</div>
