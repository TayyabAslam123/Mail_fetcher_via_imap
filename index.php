<html>
<body>
<!--
Change two settings in your gmail account
1_ Enable the imap in settings
2_ Update your sign in option 
-->

<h1 style="color:red;text-align:center;">Gmail Fetcher</h1>
<?php
    if (! function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
?>
<div class="container">
    <?php 
	/* IMAP Connection code with GMAIL IMAP */
	$imap_conn = imap_open('{imap.gmail.com:993/imap/ssl}INBOX','YOUR-EMAIL', 'YOUR-PASSWORD') or die('Cannot connect to Gmail: ' . imap_last_error());
 
	
	/* SET email subject filter criteria */
	$inbox = imap_search($imap_conn,'ALL');
	rsort($inbox);
    // var_dump($inbox);
	if (! empty($inbox)) {
	?>
    <table class="table table-striped">
	<?php
	foreach ($inbox as $email) {
		// Get email header information
		$overview = imap_fetch_overview($imap_conn, $email);
		// Get email body
		$message = $overview['0']->subject;;
        
		$date = date("d F, Y", strtotime($overview[0]->date));
	?>
	<tr>
		<td>
		<?php echo $overview[0]->from; ?>
		</td>
		<td>
		<?php echo $overview[0]->subject; ?> - <?php echo $message; ?>
		</td>
		<td>
		<?php echo $date; ?>
		</td>
	</tr>
	<?php
	} 
	?>
	</table>
<?php
 } 
 // Close imap connection
 imap_close($imap_conn);
}
?>
</div>
</body>
</html>