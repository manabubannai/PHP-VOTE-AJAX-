<?php
ob_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>投票機能の作成方法</title>
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
$(function() {

	// buttonがクリックされたときに実行
	$("button").click(function() {

		// buttonのIDを取得する
		var id = $(this).attr("id");

		// buttonのname（商品名）を取得する
		var product_name = $(this).attr("name");

		// POST用のデータ準備：id=をつけないと、vote.phpの$_POST['id']で取得できない
		var voteData = 'id='+ id;

		// span内の投票数を書き換える
		var thisButton = $(this).prev('span');

		$.ajax({

			 type: "POST",
			 url: "vote.php",
			 data: voteData,

			 success: function(data) {
			 	// 処理が成功したら、thisButton内部を書き換える
				thisButton.html(data);
			}

		});

		return false;
	});

});
</script>
</head>
<body>

<?php

$query = "SELECT * FROM products";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
	$id = $row['id'];
	$product_name = $row['product_name'];
	$product_vote = $row['product_vote'];
?>

<p>
	<?php echo $product_name; ?>：
	<span id="num"><?php echo $product_vote; ?></span>
	<button id="<?php echo $id; ?>" name="<?php echo $product_name; ?>">投票する</button>
</p>

<?php
} // End of while
?>

</body>
</html>