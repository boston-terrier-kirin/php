# xampp-1.8.1 の場合

### サービス起動している mysql を止めて、xampp の mysql を起動する。

### DB のパスワードを変える。

```php
define("DB_USER", "root");
define("DB_PASS", "");
```

# xampp-8.1.6 の場合

### xampp-1.8.1 の mysql を止めて、サービスの mysql を起動する。

### DB のパスワードを変える。

```php
define("DB_USER", "root");
define("DB_PASS", "root");
```
