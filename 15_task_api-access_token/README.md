# register

ここでユーザ登録する。
http://localhost:8090/task_api/register.php/

# get access token

ここで access token を GET する。
POST http://localhost:8090/task_api/login.php/

#### body

{
"username": "kohei",
"password": "111111"
}

# create

POST http://localhost:8090/task_api/tasks/

#### header

Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0=

#### body

{
"name": "TEST POST#1",
"priority": 1,
"is_completed":0
}

# update

PATCH http://localhost:8090/task_api/tasks/2

#### header

Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0=

#### body

{
"name": "TEST POST#1",
"priority": 1,
"is_completed":0
}

# get all

GET http://localhost:8090/task_api/tasks/

#### header

Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0=

# get

GET http://localhost:8090/task_api/tasks/7

#### header

Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0=

# delete

DELETE http://localhost:8090/task_api/tasks/7

#### header

Authorization: Bearer eyJpZCI6NSwibmFtZSI6ImtvaGVpIn0=
