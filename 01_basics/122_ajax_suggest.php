<?php
$players[] = "パトリック・ボールドウィン・ジュニア (Patrick Baldwin Jr.)";
$players[] = "ステフィン・カリー (Stephen Curry)";
$players[] = "ドンテ・ディビンチェンゾ (Donte DiVincenzo)";
$players[] = "ドレイモンド・グリーン (Draymond Green)";
$players[] = "ジャマイカル・グリーン (JaMychal Green)";
$players[] = "アンドレ・イグダーラ (Andre Iguodala)";
$players[] = "タイ・ジェローム (Ty Jerome)";
$players[] = "ジョナサン・クミンガ (Jonathan Kuminga)";
$players[] = "アンソニー・ラム (Anthony Lamb)";
$players[] = "ケヴォン・ルーニー (Kevon Looney)";
$players[] = "モーゼス・ムーディー (Moses Moody)";
$players[] = "ライアン・ローリンズ (Ryan Rollins)";
$players[] = "ジョーダン・プール (Jordan Poole)";
$players[] = "クレイ・トンプソン (Klay Thompson)";
$players[] = "アンドリュー・ウィギンス (Andrew Wiggins)";
$players[] = "ジェームズ・ワイズマン (James Wiseman)";

$q = $_REQUEST["q"];
$suggestion = [];

if ($q !== "") {
    $q = strtolower($q);
    $len = strlen($q);
    foreach ($players as $player) {
        if (stristr($q, substr($player, 0, $len))) {
            $suggestion[] = $player;
        }
    }
}
?>

<?= json_encode($suggestion); ?>