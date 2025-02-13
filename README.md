# Laravel Project README

## Running the Project with Docker

To run this Laravel project using Docker, follow these steps:

1. Ensure you have Docker and Docker Compose installed on your machine.
2. Navigate to the project directory.
3. Run the following command to start the Docker containers:

    ```sh
    docker-compose up -d
    ```

4. Once the containers are up and running, execute the following commands to set up the database and Passport:

    ```sh
    docker-compose exec app php artisan migrate --force
    docker-compose exec app php artisan passport:install
    ```

### Instructions for Windows Users

1. Open Command Prompt or PowerShell.
2. Navigate to the project directory using the `cd` command.
3. Run the Docker commands as mentioned above.

### Instructions for Linux Users

1. Open a terminal.
2. Navigate to the project directory using the `cd` command.
3. Run the Docker commands as mentioned above.

## API Routes Documentation

### Postman Collection

You can use the provided Postman collection to test the API routes. Import the `REST API basics- CRUD, test & variable.postman_collection.json` file into Postman to get started quickly.

OR You can test the API routes using Postman with the Below available routes and their descriptions:

### Authentication Routes

- **Register User**
    - **URL:** `/api/register`
    - **Method:** `POST`
    - **Body:** 
        ```json
        {
            "name": "Your Name",
            "email": "your.email@example.com",
            "password": "yourpassword",
            "username": "your username",
            "mobile": "your mobile",
        }
        ```

- **Register Admin**
    - **URL:** `/api/admin/register`
    - **Method:** `POST`
    - **Body:** 
        ```json
        {
            "name": "Admin Name",
            "email": "admin.email@example.com",
            "password": "adminpassword",
            "username": "admin username",
            "mobile": "admin mobile",

        }
        ```

- **Login**
    - **URL:** `/api/login`
    - **Method:** `POST`
    - **Body:** 
        ```json
        {
            "identifier": "your.email@example.com",
            "password": "yourpassword"
        }
        ```

- **Resend OTP**
    - **URL:** `/api/resend-otp`
    - **Method:** `POST`
    - **Body:** 
        ```json
        {
            "email": "your.email@example.com"
        }
        ```

- **Verify OTP**
    - **URL:** `/api/verify-otp`
    - **Method:** `POST`
    - **Body:** 
        ```json
        {
            "email": "your.email@example.com",
            "otp": "otp receved by email"
        }
        ```

### Job Routes (Protected)

- **Add Job**
    - **URL:** `/api/addjob`
    - **Method:** `POST`
    - **Headers:** 
        ```json
        {
            "Authorization": "Bearer {access_token}"
        }
        ```
    - **Body:** 
        ```json
        "jobs": [
        {
            "title": " Engineer",
            "description": "Develop and maintain web applications.",
            "location": "New York",
            "salary": 50000
        },
        {
            "title": " Analyst 5",
            "description": "Analyze data trends and provide insights.",
            "location": "Los Angeles",
            "salary":20000
        }
        ]
        ```

- **Apply for Job**
    - **URL:** `/api/jobs/apply`
    - **Method:** `POST`
    - **Headers:** 
        ```json
        {
            "Authorization": "Bearer {access_token}"
        }
        ```
    - **Body:** 
        ```json
        {
            "file": "your uploaded file ",
            "availablejobs_id": job_id,
            "cover_letter": "Description"
        }
        ```

Make sure to replace `{access_token}` with the actual token received after authentication.


