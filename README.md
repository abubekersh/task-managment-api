### Task Management System Backend Api

    This project is a backend restfull api build with laravel, the project is a simple task management api which simply handles task management.

### How to install and use the api

## clone the repo

```bash
git clone
```

## cd to the folder

```bash
cd task-management-api
```

## migrate the database

```bash
php artisan migrate
```

## run the server

```bash
php artisan serve
```

### Supported methods

now you can conume the api via curl or postman, on your local machine the path would be http://127.0.0.1:8000 if you used the default

## To Get All The Tasks

```
GET http://127.0.0.1:8000/api/tasks
```

## To Add new Task

```
POST http://127.0.0.1:8000/api/tasks
```

## To Mark Task as Completed

```
PUT http://127.0.0.1:8000/api/tasks/:id
```

## To Delete a Task

```
DELETE http://127.0.0.1:8000/api/tasks/:id
```
