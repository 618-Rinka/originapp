お問い合わせ内容を受け付けました。<br>
<br>
■メールアドレス<br>
{!! $inputs['email'] !!}<br>
<br>
■お名前<br>
{!! $inputs['name'] !!}<br>
<br>
■お問い合わせ内容<br>
<?php echo nl2br(htmlspecialchars($inputs['message'])); ?><br>