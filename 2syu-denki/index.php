<?php

// configファイルを変数に代入
$config = include($_SERVER["DOCUMENT_ROOT"] . '/assets/config.php');
$pageInfo = 0;
if (!empty($_POST["file-xml"])) {
    $pageInfo = 1;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
	<head>
		<title>第二種電気工事士筆記試験対策 | 資格・検定対策サイト</title>
		<?php echo $html["common_head"]; ?>
		<style>
            table.siken {
                border: 1px solid #333;
                width: 100%;
            }

            td.siken {
                border: 1px solid #333;
            }

            tr.siken td.siken {
                text-align: center;
            }

            td.qs {
                width: 50%;
                border: 1px solid #333;
            }

            th.siken,
            tfoot.siken {
                background-color: #333;
                color: #fff;
            }
            .menu {
                padding-left: 30px;
            }
            .menu li {
                display: list-item;  /* 縦に並べる */
                text-transform: uppercase;
                list-style-type: katakana-iroha;
                display: inline-block;
                vertical-align: top;
            }

            .hide {
                visibility:hidden;
            }

            .circle{
                display: inline-block;
                width: 15px;
                height: 15px;
                text-align:center;
                line-height: 1px;
                border-radius: 50%;
                border: solid 1px red;
                margin-left: -15px;
                visibility:hidden;
            }

            .circle.is-active {
                visibility:visible;
            }


		</style>
	</head>
	<body>
		<?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/header.php"); ?>
		<div class="wrapper">
			<div class="contents">
				<div class="text_box">
					<!-- パンくずリスト始 -->
					<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope
							itemtype="https://schema.org/ListItem">
							<a itemprop="item" href="<?php echo $conf["url"]; ?>/">
								<span itemprop="name">ホーム</span>
							</a>
							<meta itemprop="position" content="1" />
						</li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemprop="item" href="<?php echo $conf["url"]; ?>/2syu-denki/">
								<span itemprop="name">第二種電気工事士</span>
							</a>
							<meta itemprop="position" content="2" />
						</li>
					</ol>
					<!-- パンくずリスト終 -->

					<!-- ↓↓↓↓↓ ここから本文 ↓↓↓↓↓ -->
                    <?php 
                        if ($pageInfo === 0):
                            $filehash = array(
                                "H29kamiki1-30.xml" => "平成29年度第二種電気工事士上期筆記試験",
                                "H31shimoki1-30.xml" => "2019年度第二種電気工事士下期筆記試験",
                                "H31kamiki1-30.xml" => "2019年度第二種電気工事士上期筆記試験",
                                "H30shimoki1-30.xml" => "平成30年度第二種電気工事士下期筆記試験",
                                "H29shimoki1-30.xml" => "平成29年度第二種電気工事士下期筆記試験",
                            );
                            $files = array_keys($filehash);
                            shuffle($files);
                            $file = array_values($files)[0];
                            $xml = $_SERVER["DOCUMENT_ROOT"] . "/assets/data/2syu-denki/" . $file;//ファイルを指定
                            echo $filehash[$file];
                    ?>

                    <form action="" method="POST">
                        <table class="siken">
                            <tbody class="siken">
                                <tr class="siken">
                                    <td colspan="2" class="siken">問い</td>
                                    <td class="siken">答え</td>
                                </tr>
                                <tr>
                                <?php //C:/xampp/htdocs/assets/data/2syu-denki/H31shimoki1-30.xml
                                    echo '<input class="hide" type="text" name="file-xml" value="' . $xml . '" readonly>';
                                    echo '<input class="hide" type="text" name="file-name" value="' . $filehash[$file] . '" readonly>';
                                    //echo $xml;
                                    //return
                                    $xmlData = simplexml_load_file($xml);//xmlを読み込む
                                    $i = 1;
                                    $order = array("\r\n", "\n", "\r", "\N");
                                    $replace = '<br>';
                                    foreach ($xmlData->item as $data) { 
                                        $n = 1;
                                        $list = array((String)$data->answer,(String)$data->answer1,(String)$data->answer2,(String)$data->answer3);
                                        shuffle($list);
                                        echo '<td class="siken">'.$i.'</td>';
                                        if (strpos((String) $data->question, "https://") !== false) {echo '<td class="qs"><a href="'.$data->question.'" data-lightbox="demo"><img src="'.$data->question.'"></img></a></td>';}
                                        else {echo '<td class="qs">'.$data->question.'</td>';}
                                        echo '<td class="siken"><ol class="menu">';
                                        foreach ($list as $item) {
                                            if ($n === 1) {$k = "イ";} 
                                            else if ($n === 2) {$k = "ロ";} 
                                            else if ($n === 3) {$k = "ハ";} 
                                            else {$k = "ニ";} 
                                            if (strpos($item, "https://") !== false) {
                                                if ($item === (String)$data->answer) {
                                                    if (!empty($_POST[$i])) {
                                                        echo '<span class="circle"></span>'.$k.'<input type="radio" name="'.$i.'" value="'.$item.'" class="ok" checked><li> <img width="100%" src="' . $item . '"></img></li><br>';
                                                    } else {
                                                        echo '<span class="circle"></span>'.$k.'<input type="radio" name="'.$i.'" value="'.$item.'" class="ok"><li> <img width="100%" src="' . $item . '"></img></li><br>';
                                                    }
                                                } else {
                                                    if (!empty($_POST[$i])) {
                                                        echo $k.'<input type="radio" name="'.$i.'" value="'.$item.'" checked><li> <img width="100%" src="' . $item . '"></img></li><br>';
                                                    } else {
                                                        echo $k.'<input type="radio" name="'.$i.'" value="'.$item.'"><li> <img width="100%" src="' . $item . '"></img></li><br>';
                                                    }
                                                }
                                            } 
                                            else {
                                                if ($item === (String)$data->answer) {
                                                    if (!empty($_POST[$i])) {
                                                        echo '<span class="circle"></span>'.$k.'<input type="radio" name="'.$i.'" value="'.$item.'" class="ok" checked><li> ' . mb_strtolower($item) . '</li><br>';
                                                    } else {
                                                        echo '<span class="circle"></span>'.$k.'<input type="radio" name="'.$i.'" value="'.$item.'" class="ok"><li> ' . mb_strtolower($item) . '</li><br>';
                                                    }
                                                } else {
                                                    if (!empty($_POST[$i])) {
                                                        echo $k.'<input type="radio" name="'.$i.'" value="'.$item.'" checked><li> ' . mb_strtolower($item) . '</li><br>';
                                                    } else {
                                                        echo $k.'<input type="radio" name="'.$i.'" value="'.$item.'"><li> ' . mb_strtolower($item) . '</li><br>';
                                                    }
                                                }
                                            }
                                            $n++;
                                        }
                                        echo '</ol></td></tr>';
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input type="submit" name="あ" value="答え合わせをする" class="button" onsubmit="doSomething();return false;">
                    </form>

                    <?php else: 
                        $fileName = (String)$_POST["file-name"];
                        echo $fileName;
                    ?>
                    <table class="siken">
                        <tbody class="siken">
                            <tr class="siken">
                                <td colspan="2" class="siken">問い</td>
                                <td class="siken">答え</td>
                            </tr>
                            <tr>
                    <?php 
                    
                    $answerLengh = 0;
                    $xml = (String)$_POST["file-xml"];//ファイルを指定
                    $xmlData = simplexml_load_file($xml);//xmlを読み込む
                    $i = 1;
                    foreach ($xmlData->item as $data) { 
                        echo '<td class="siken">' . $i . '</td>';
                        if (strpos((String) $data->question, "https://") !== false) {echo '<td class="siken"><a href="'.$data->question.'" data-lightbox="demo"><img width="100%" src="'.$data->question.'"></img></a></td>';}
                        else {echo '<td class="siken">'.$data->question.'</td>';}
                        echo '<td class="siken">';
                        if (!isset($_POST[$i])) {
                            echo '<div>あなたのこたえ</div>';
                            echo '無回答';
                            echo '<div>正解</div>';
                            if (strpos((String)$data->answer, "https://") !== false) {echo '<img width="100%" src="'.(String)$data->answer.'"></img>';}
                            else {echo "<p>".(String)$data->answer."</p>";};
                        } else {
                            $str1 = mb_convert_encoding($_POST[$i], 'EUC-JP', 'UTF-8');
                            $str1 = str_replace(" ", "", $str1);
                            $str1 = str_replace("\r", "", $str1);
                            $str2 = mb_convert_encoding((String)$data->answer, 'EUC-JP', 'UTF-8');
                            $str2 = str_replace(" ", "", $str2);
                            $str2 = str_replace("\r", "", $str2);
                            if (strpos(bin2hex($str1), bin2hex($str2)) !== false) {
                                echo '<div>あなたのこたえ</div>';
                                if (strpos((String) $_POST[$i], "https://") !== false) {echo '<img width="100%" src="'.$_POST[$i].'"></img>';}
                                else {echo "<p style='color: red;'>".$_POST[$i]."</p>";};
                                echo '<div>正解</div>';
                                if (strpos((String) (String)$data->answer, "https://") !== false) {echo '<img width="100%" src="'.(String)$data->answer.'"></img>';}
                                else {echo "<p>".(String)$data->answer."</p>";};
                                $answerLengh++;
                            }
                            else {
                                echo '<div>あなたのこたえ</div>';
                                if (strpos((String) $_POST[$i], "https://") !== false) {echo '<img width="100%" src="'.$_POST[$i].'"></img>';}
                                else {echo "<p style='color: blue;'>".$_POST[$i]."</p>";};
                                echo '<div>正解</div>';
                                if (strpos((String)$data->answer, "https://") !== false) {echo '<img width="100%" src="'.(String)$data->answer.'"></img>';}
                                else {echo "<p>".(String)$data->answer."</p>";};
                            }
                        }
                        echo "</td></tr>";
                        $i++;
                    }
                    $answerAllSize = $i - 1;
                    echo $answerLengh ."/". $answerAllSize;

                    ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
				</div>
			</div>
			<?php include( $_SERVER["DOCUMENT_ROOT"] . "/assets/include/footer.php"); ?>
		</div>
        <script>
            $(function(){
                $('.button').on('click', function(){
                    $('.circle').toggleClass('is-active');
                    $('.button').toggleClass('hide');
                    $('body,html').animate({ scrollTop: 0 }, 500);
                });
            }());
        </script>
		<?php echo $html["common_foot"]; ?>
	</body>
</html>