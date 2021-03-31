<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // POSTでのアクセスでない場合
    $company_name = '';
    $department_name = '';
    $name = '';
    $furigana_name = '';
    $email = '';
    $subject = '';
    $message = '';
    $err_msg = '';
    $complete_msg = '';

} else {
    // フォームがサブミットされた場合（POST処理）
    // 入力された値を取得する
    $company_name = $_POST['company_name'];
    $department_name = $_POST['department_name'];
    $name = $_POST['name'];
    $furigana_name = $_POST['furigana_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // エラーメッセージ・完了メッセージの用意
    $err_msg = '';
    $complete_msg = '';

    // 空チェック
    if ($name == '' || $email == '' || $subject == '' || $message == '') {
        $err_msg = '全ての項目を入力してください。';
    }

    // エラーなし（全ての項目が入力されている）
    if ($err_msg == '') {
        $to = 'admin@test.com'; // 管理者のメールアドレスなど送信先を指定
        $headers = "From: " . $email . "\r\n";

        // 本文の最後に名前を追加
        $message .= "\r\n\r\n" . $name;

        // メール送信
        mb_send_mail($to, $subject, $message, $headers);

        // 完了メッセージ
        $complete_msg = '送信されました！';

        // 全てクリア
        $name = '';
        $email = '';
        $subject = '';
        $message = '';
    }

}
?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">
    <style>
        body {
            background: #f3f3f3;
        }
        .container {
            font-family: "Noto Sans JP";
            margin-top: 60px;
        }
        h1 {
            margin-bottom: 50px;
            text-align: center;
        }
        button {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-offset-4 col-xs-4">
            <h1>お問い合わせ</h1>

            <?php if ($err_msg != ''): ?>
                <div class="alert alert-danger">
                    <?php echo $err_msg; ?>
                </div>
            <?php endif; ?>

            <?php if ($complete_msg != ''): ?>
                <div class="alert alert-success">
                    <?php echo $complete_msg; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="company name" placeholder="会社名" value="<?php echo $company_name; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="department name" placeholder="部署名" value="<?php echo $department_name; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="お名前" value="<?php echo $name; ?>">
                </div>
                 <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="ふりがな" value="<?php echo $name_furigana; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="メールアドレス" value="<?php echo $email; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="件名" value="<?php echo $subject; ?>">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="本文"><?php echo $message; ?></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-block">送信</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>