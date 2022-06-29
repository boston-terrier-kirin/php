<?php

    $articles = ["First post", "Second post", "Third post"];
    var_dump($articles);
    echo "<br />-----<br/>";
    
    // インデックス100から始まる
    $articles = [100=>"First post", "Second post", "Third post"];
    var_dump($articles);
    echo "<br />-----<br/>";

    // これでMapになる
    $articles = ["post-1"=>"First post", "post-2"=>"Second post", "post-3"=>"Third post"];
    var_dump($articles);
    echo "<br />";
    echo $articles["post-1"];
    echo "<br />-----<br/>";

    $values = [
        "message" => "Hello World!",
        "valid" => true,
        "result" => null,
        "projects" => ["std-pj", "ajustment-pj"]
    ];
    var_dump($values);
    echo "<br />-----<br/>";

    $users = [
        [
            "name" => "John",
            "age" => 24
        ],
        [
            "name" => "Jane",
            "age" => 24
        ]
    ];
    // インデックスが不要な場合
    foreach($users as $user) {
        var_dump($user);
        echo "<br />";
    }
    echo "<br />-----<br/>";
    // インデックスが必要な場合
    foreach($users as $index => $user) {
        echo $index . ": ";
        var_dump($user);
        echo "<br />";
    }

?>