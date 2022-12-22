<?php
// //テスト
// $name = $_POST["name"];
// $age = $_POST["age"];
// $genre = $_POST["genre"];
// $title = $_POST["title"];
// $review = $_POST["review"];
// $date = $_POST["date"];

// // // ファイルに書き込み
// $file = fopen("data/data.txt","a");


// fwrite($file,
//         "<div class='write'>投稿者：".$name."\n"."年齢："
//         .$age."歳"."\n"."ジャンル：".$genre."\n"."作品名：".$title."\n"
//         ."評価：".$review."\n"."鑑賞日：".$date."</div>");

// fclose($file);
// //テストここまで

$test = "ジャンル：";

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//1. DB接続
try{
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', '');
} catch(PDOException $e){
    exit('DBConnectError' . $e->getMessage());
}

//2. データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM kadai1210");
$status = $stmt->execute();

//3. データ表示
$view = "";
if($status == false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //elseの中はSQLを実行成功した場合
    //selectデータの数だけ自動でループしてくれる
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .=
            // '<div class="test"><td class="result_td">'.h($result['genre']).'</td>'.
            // '<td class="result_td">'.h($result['title']).'</td>'.
            // '<td class="result_td">'.h($result['review']).'</td>'.
            // '<td class="result_td">'.h($result['coment']).'</td>'.
            // '<td class="result_td">'.h($result['date']).'</td></div>';

            // '<tr><th>名前:</th><th>'.h($result['name']).'</th></tr>'.
            // '<tr><th>年齢:</th><th>'.h($result['age']).'</th></tr>'.
            '<ul class="ac">' .
            '<li class="ac-parent">🎬 ' . h($result["title"]) . ' 🎬</li>' .
            '<li class="ac-child"><div class="ac-wrap"><div class="ac-hl">【ジャンル】</div>' .
            '<p>' . h($result["genre"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【スコア】</div>' .
            '<p>' . h($result["review"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【鑑賞日】</div>' .
            '<p>' . h($result["date"]) . '</p></div><hr>' .
            '<div class="ac-wrap"><div class="ac-hl">【レビュー】</div>' .
            '<p>' . h($result["coment"]) . '</p></div></li></ul>';

            


    }

}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>読み込み用</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="main_wrapper">
        <h1 class="main_title read_title">#徒然映画記</h1>
        <a href="input.php" class="entry">記録する</a>
    
    </header>
    <div class="write_wrapper">
        <?= $view ?>
        <!-- <table class="write_tb">
            <tr>
                <th class="ttt">ジャンル</th>
                <th class="ttt">作品名</th>
                <th class="ttt">スコア</th>
                <th class="ttt">レビュー</th>
                <th class="ttt">鑑賞日</th>
            </tr>
            <tr>
            </tr>
        </table> -->

        
        <!-- // //ファイルを開く
        // $openFile = fopen("./data/data.txt", "r");
        // //ファイル内容を1行ずつ読み込んで出力
        // while ($str = fgets($openFile)){
        //     echo nl2br($str);
        // }

        // fclose($openFile);
        
        // var_dump($view); -->
    
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="read.js"></script>
</body>

</html>