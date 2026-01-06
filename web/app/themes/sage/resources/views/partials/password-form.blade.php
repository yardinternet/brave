<form action="{{ site_url('wp-login.php?action=postpass', 'login_post') }}" method="post"
	class="my-20 !max-w-screen-sm bg-white p-4 shadow-lg md:p-6">
	<h2>Beschermd met wachtwoord</h2>
	<p>De inhoud van deze pagina is beveiligd met een wachtwoord. Vul het wachtwoord in om de
		pagina te kunnen bekijken.
	</p>
	<div class="flex w-full flex-col items-end gap-4 sm:flex-row">
		<div class="flex w-full flex-col">
			<label for="post-password">Wachtwoord:</label>
			<input name="post_password" id="post-password" type="password" size="20" maxlength="20" />
		</div>
		<div>
			<button type="submit" class="is-button whitespace-nowrap">Verzenden</button>
		</div>
	</div>
</form>
