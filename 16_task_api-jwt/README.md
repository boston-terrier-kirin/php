# register

ここでユーザ登録する。
http://localhost:8090/task_api/register.php/

# get access token

ここで access token を GET する。
POST http://localhost:8090/task_api/login.php/

#### request body

```
{
    "username": "kohei",
    "password": "111111"
}
```

#### response

```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsIm5hbWUiOiJtYXdhbiIsImV4cCI6MTY2OTg0NjYyNH0.cvTaAB5kY56I6cUS0kgQtQfL3BSukGp9zy1Z2PZnXSI",
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsImV4cCI6MTY3MDI3ODAyNH0.FnNaMrjBmXV1DQbB0sNWU8oj-elVPRKR45Vi655K4DQ"
}
```

# create

POST http://localhost:8090/task_api/tasks/

#### request header

```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsIm5hbWUiOiJtYXdhbiIsImV4cCI6MTY2OTg0NjYyNH0.cvTaAB5kY56I6cUS0kgQtQfL3BSukGp9zy1Z2PZnXSI
```

#### request body

```
{
    "name": "TEST POST#1",
    "priority": 1,
    "is_completed":0
}
```

#### response

```
{
    "id": "9"
}
```

# refresh

POST http://localhost:8090/task_api/refresh.php

#### request body

login.php の refresh token を使う

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsImV4cCI6MTY3MDI3ODM3OX0.z9VqHFsOB35_tU0alVBjNzy26INo1Ow0IDAWyJOJfEQ"
}
```

#### response

```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsIm5hbWUiOiJtYXdhbiIsImV4cCI6MTY2OTg0NzA4M30.GQZdJbpGJwb36_bub8UNcmlhmdP953I8KeO90uVBCx0",
    "refresh_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsImV4cCI6MTY3MDI3ODQ4M30.vdypul5XVkXvomEAT5-x9qc_0PlToe-wuQmUNC6nfqI"
}
```

# get_all

GET http://localhost:8090/task_api/tasks/

#### request header

```
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjcsIm5hbWUiOiJtYXdhbiIsImV4cCI6MTY2OTg0NjYyNH0.cvTaAB5kY56I6cUS0kgQtQfL3BSukGp9zy1Z2PZnXSI
```

#### response

```
[
  {
    id: 7,
    name: 'TEST POST#1 - UPDATED!!',
    priority: 1,
    is_completed: 0,
    user_id: 5
  }
]
```
