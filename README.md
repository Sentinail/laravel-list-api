# List API Documentation

This API provides basic CRUD (Create, Read, Update, Delete) operations for managing user lists in a Laravel application.

## Endpoints

### Get All Lists
- **Endpoint**: `/lists`
- **Method**: `GET`
- **Description**: Retrieve a list of all user lists.
- **Response**: 
    - Status Code: `200`
    - Body: A JSON array containing user lists.

### Get User Lists
- **Endpoint**: `/user/lists`
- **Method**: `GET`
- **Description**: Retrieve lists owned by the authenticated user.
- **Response**:
    - Status Code: `200`
    - Body: A JSON object with a "lists" key containing an array of user lists.

### Create List
- **Endpoint**: `/lists`
- **Method**: `POST`
- **Description**: Create a new user list.
- **Request Body**: JSON object with "title" and "content" fields.
- **Response**:
    - Status Code: `200`
    - Body: A JSON object representing the newly created list.

### Update List Title
- **Endpoint**: `/lists/update-title`
- **Method**: `PUT`
- **Description**: Update the title of a user list.
- **Request Body**: JSON object with "list_id" and "title" fields.
- **Response**:
    - Status Code: `200` if the list is found and updated successfully.
    - Status Code: `404` if the list is not found.
    
### Update List Content
- **Endpoint**: `/lists/update-content`
- **Method**: `PUT`
- **Description**: Update the content of a user list.
- **Request Body**: JSON object with "list_id" and "content" fields.
- **Response**:
    - Status Code: `200` if the list is found and content is updated successfully.
    - Status Code: `404` if the list is not found.
    
### Delete List
- **Endpoint**: `/lists/delete`
- **Method**: `DELETE`
- **Description**: Delete a user list.
- **Request Body**: JSON object with "list_id" field.
- **Response**:
    - Status Code: `200` if the list is found and deleted successfully.
    - Status Code: `404` if the list is not found.

### Error Responses
- Status Code: `400` for invalid request format.
- Status Code: `404` for list not found or failed updates/deletions.

## Sample Usage

### Get All Lists
```http
GET /lists
```

### Get User Lists
```http
GET /user/lists
```

### Create List
```http
POST /lists
Content-Type: application/json

{
    "title": "My New List",
    "content": "List content goes here."
}
```

### Update List Title
```http
PUT /lists/update-title
Content-Type: application/json

{
    "list_id": 1,
    "title": "Updated Title"
}
```

### Update List Content
```http
PUT /lists/update-content
Content-Type: application/json

{
    "list_id": 1,
    "content": "Updated content goes here."
}
```

### Delete List
```http
DELETE /lists/delete
Content-Type: application/json

{
    "list_id": 1
}
```

This documentation covers the basic functionality of your Laravel List API. You can use tools like Postman or cURL to interact with the API endpoints.
