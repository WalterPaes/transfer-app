# Transfer App
<h5>Is an App to do monetary transaction between people</h5>

## Initial Config
- Build and run container
```
make build-and-run
```

- Install dependencies
```
make install-dependencies
```

- Set <em>.env</em> file
```
APP_NAME=MyApp
APP_ENV=local
APP_KEY=12345678910
APP_DEBUG=false
APP_URL=http://localhost
APP_TIMEZONE=UTC

DB_CONNECTION=mysql
DB_HOST=172.0.0.1
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=root

AUTHORIZER_ENDPOINT=https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6
NOTIFIER_ENDPOINT=https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04

JWT_KEY=mykey
```

- Run migrations
```
make migrate
```

## API Endpoints
When the docker container is up, the access url is `http://localhost:8000`

### POST
`Login` [/login](#login) <br/>
`User Store` [/users](#users) <br/>
`Transaction Store` [/transaction](#transaction) <br/>

#### /login
Do user authentication, if be a success, a access token gonna be returned.

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `email` | required | string  | User email. Should be unique.                                                                     |
|     `password` | required | string  | Access app password.                                                                 

**Response**
```
SUCCESS 200
BAD REQUEST 400
UNAUTHORIZED 401
ERROR 500
```
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InVzZXJAZW1haWwuY29tIn0.Ts81GNosnduw3Rzxsb_nnqgKM87FfMY77HwOhWm57Z0"
}
```

#### /users
Do user authentication, if be a success, a access token gonna be returned.

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `name` | required | string  | The user name.                                                                     |
|     `cpf` | required | string  | User document. Should be unique.                                                                     |
|     `email` | required | string  | User email. Should be unique.                                                                     |
|     `category` | required | string  | User role in app. <br/><br/> Supported values: `user` or `shopman`                                                                     |
|     `password` | required | string  | Access app password.                                                                 

**Response**
```
SUCCESS 201
BAD REQUEST 400
UNAUTHORIZED 401
ERROR 500
```

#### /transaction
Do user authentication, if be a success, a access token gonna be returned.

**Parameters**

|          Name | Required |  Type   | Description                                                                                                                                                           |
| -------------:|:--------:|:-------:| --------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|     `value` | required | float  | The transaction money value.                                                                     |
|     `payee` | required | int  | Represents a Common user id.                                                                     |
|     `payer` | required | int  | Represents a Common user or Shopman user id.                                                                     |                                                                 

**Response**
```
SUCCESS 201
BAD REQUEST 400
UNAUTHORIZED 401
ERROR 500
```

## APP Architecture
![architecture](./architecture.png)
<p>The app is based on Clean Architecture and Hexagonal Architecture.</p>
<p>I understand that architecture is the best to isolate business logic, domain and infrastructure.</p>
<p>I think this way, this structure is good because allow modulate the application and reused parts of this app in another applications.</p>
<p>I choose the Lumen framework because is the most familiar framework to me and allow me do RESTFul apis.</p>

## Data Model
![data_model](./er.png)

## Tests
```
make run-tests
```
