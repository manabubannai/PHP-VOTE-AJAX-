<?php
include("config.php");

// POSTされたときに下記を実行
if( $_POST['id'] ) {

	$id = $_POST['id'];
	$id = $mysqli->real_escape_string($id);


	// クッキーで投票済かどうかを判断する
	if ( !isset($_COOKIE['voted_'.$id]) ) {

		// クッキーを付与
		setcookie("voted_".$id, "voted_".$id, time()+3600);  // 有効期限は一時間です

		// 投票数をアップデートする
		$sql = "UPDATE products SET product_vote = product_vote+1  WHERE id='$id'";
		$mysqli->query( $sql);

	}

	// 投票数を取得する
	$result = $mysqli->query("SELECT product_vote FROM products WHERE id='$id'");
	$row=$result->fetch_assoc();

	$vote_value=$row['product_vote'];
	echo $vote_value;

}