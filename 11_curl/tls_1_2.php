<?php
    // https://qiita.com/p_s_m_t/items/828d2876c628cfac9c42
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://security.yahoo.co.jp/news/tls12.html');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // php5.4はTLS1.2に対応していないので0が返ってくる
    echo $response;
    echo "\n";
    echo 'status code: ' . $statusCode;
    echo "\n";
?>