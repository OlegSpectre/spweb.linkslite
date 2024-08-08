<?
use Bitrix\Main\Localization\Loc;
if (! check_bitrix_sessid()){ return; }
?>

<form action="<?=$APPLICATION->GetCurPage()?>">

	<?=bitrix_sessid_post()?>
	<input type="hidden" name="lang" value="<?=LANG?>">
	<input type="hidden" name="id" value="spweb.linkslite">
	<input type="hidden" name="uninstall" value="Y">
	<input type="hidden" name="step" value="2">

	<table cellpadding="3" cellspacing="0" border="0">
		<tr>
			<td>
				<input type="checkbox" name="DEL_DEMO_DATA" value="Y" checked id="DEL_DEMO_DATA">
			</td>
			<td>
				<p>
					<label for="DEL_DEMO_DATA"><?=Loc::getMessage('linkslite_install_save_hl')?></label>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<input type="checkbox" name="DEL_FILES" value="Y" checked id="DEL_FILES">
			</td>
			<td>
				<p>
					<label for="DEL_FILES"><?=Loc::getMessage('linkslite_install_save_files')?></label>
				</p>
			</td>
		</tr>
	</table>

	<br>
	<input type="submit" name="" value="<?=Loc::getMessage('MOD_DELETE')?>">

</form>