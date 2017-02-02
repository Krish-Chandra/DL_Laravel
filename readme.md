#About Digital Library:

An online book store app that has two parts: back end and front end.

##Admin Area:

Is where the book store is administered

Admin Area Features:

    Add/update/delete Books, Authors, Publishers, Categories, Admin Users, Admin Roles
    View requests for books
    Issue/return of books

Books:

    Add/update/delete books
        Currently, a book can have only one author, category, and publisher

Authors, Publishers and Categories:

    Add/update/delete

Issues:

    View a list of books issued to the members
    Delete an issue by flagging it returned

Requests:

    View a list of requests for books from members
    Issue a book to the respective user thereby removing it from the request list

Admin Users:

    Are those that administer the system
    Belong to roles that can be defined by the master admin user (the omnipotent user of the system)
    Can carry out activities as per the access rights assigned to the roles they belong to 
        - Uses Zizaco/entrust package 

    The system automatically creates the folowing admin users: "admin@example.com" with the password: "password"
        The omnipotent user in the system
        Has access to the entire system

    "librarian@example.com" with the password: "password"
        This user has restricted access rights to the system

Members:

    Are the public users of the system

Roles:

    Roles determine the activities that can be performed by a user in the system

    The system comes with the following roles:
        admin
            Omnipotent
            admin@example.com user belongs to this role

        librarian
            Less powerful than admin
            Has restricted access to the backend
            librarian@example.com user belongs to this role

        member
            Public users of the system

##Front end:

Is the frontend of the application that will be used by members

    Members can:
        View the books catalog
        Add books to the request cart
        Checkout the books thereby sending a request to the backend
            Only registered users can send request for books

Installtion:

    Clone the project in a web-accessible folder(e.g., htdocs in XAMPP)
    Install the composer packages
      composer install
    Run the database migrations (the app uses mysql, by default)
      php artisan migrate
      
    Copy the .env.example file to .env and make appropriate changes
    
    Browse the app
      


