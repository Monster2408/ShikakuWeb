<?php

// configファイルを変数に代入
$config = include($_SERVER["DOCUMENT_ROOT"] . '/assets/config.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
	<head>
		<title>資格・検定対策サイト | トップページ</title>
		<?php echo $html["common_head"]; ?>
		<style>

		</style>
	</head>
	<body>
		<?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/header.php"); ?>
        <div class="wrapper">
            <div class="mainBox">
				<div class="contents">
					<!-- パンくずリスト始 -->
					<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope
							itemtype="https://schema.org/ListItem">
							<a itemprop="item" href="<?php echo $conf["url"]; ?>/">
								<span itemprop="name">ホーム</span>
							</a>
							<meta itemprop="position" content="1" />
						</li>
					</ol>
					<!-- パンくずリスト終 -->

					<!-- ↓↓↓↓↓ ここから本文 ↓↓↓↓↓ -->
					<h1 class="design">資格・検定対策サイト</h1>	
					<h2 class="design">サービス</h2>
					<p><a href="<?php echo $conf["url"]; ?>/2syu-denki/">第二種電気工事士筆記試験対策ページ</a></p>
					<h2>新着情報</h2>
					<div class="read-more"><a href="<?php echo $conf["url"]; ?>/about/news">すべて見る</a></div>
					<?php
						$xml = $_SERVER["DOCUMENT_ROOT"] . "/assets/data/news.xml";//ファイルを指定
						$xmlData = simplexml_load_file($xml);
						$_i = 0;
						foreach ($xmlData->blog->item as $data) { 
					?>
					<?php

						if ($_i === 3) {
							break;
						}

					?>
					<a href="<?php echo $data->link; ?>" <?php  
						if (strpos($data->link,'www.shikaku-net.xyz') === false) {
							echo 'target="_blank"';
						}
					?> class="news-ca">
						<div class="card">
							<div class="textbox">
								<div class="date">
									<?php 
										$_i++;
										$text = (string)$data->date;
										if (isNearDate($text)) {
											$text = "<span class='blinking'><span style='color: red;'>New</span></span>" . $text;
										}
										echo $text; 
									?>
								</div>
								<div class="text"><?php echo $data->title;?></div>
							</div>
						</div>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/footer.php"); ?>
		</div>
		<?php echo $html["common_foot"]; ?>
	</body>
</html>