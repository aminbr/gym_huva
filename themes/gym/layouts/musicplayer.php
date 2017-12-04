<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>HTML5 Music Player</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <?= $this->head(); ?>
</head>
<?php $this->beginBody() ?>
<body>

<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>