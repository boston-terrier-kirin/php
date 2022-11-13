# create

POST http://localhost:8090/task_api/tasks/

#### header

x-api-key: 6ad0ca8ac657f039e33f5a94c15dba98

#### body

{
"name": "TEST POST#1",
"priority": 1,
"is_completed":0
}

# update

PATCH http://localhost:8090/task_api/tasks/2

#### header

x-api-key: 6ad0ca8ac657f039e33f5a94c15dba98

#### body

{
"name": "TEST POST#1",
"priority": 1,
"is_completed":0
}

# get all

GET http://localhost:8090/task_api/tasks/

#### header

x-api-key: 6ad0ca8ac657f039e33f5a94c15dba98

# get

GET http://localhost:8090/task_api/tasks/7

#### header

x-api-key: 6ad0ca8ac657f039e33f5a94c15dba98

# delete

DELETE http://localhost:8090/task_api/tasks/7

#### header

x-api-key: 6ad0ca8ac657f039e33f5a94c15dba98
