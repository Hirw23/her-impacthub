# HerImpactHub

Welcome to HerImpactHub! This platform is dedicated to empowering women across Africa by providing resources, opportunities, and avenues to help them realize their potential and contribute to community and continental development. The website features a "Join Now" page for registration, as well as options to apply for mentorship and funding.

Features
Join Now: You can register and join the platform by submitting your details.
Apply for Mentorship: You can apply for mentorship from professionals in your field.
Apply for Funding: You can apply for funding to support your projects and initiatives.

Prerequisites
Before setting up the project, make sure you have the following installed:
PHP (version 7.4 or higher)
Mysql (for local database storage)
A web server like XAMPP or WAMP to run the PHP scripts locally.

Getting Started
Here’s how I  setted up HerImpactHub on my local machine:
1. Clone the Repository
First, clone the repository to your local machine:
git clone [https://github.com/your-username/HerImpactHub.git](https://github.com/Hirw23/her-impacthub.git)
cd HerImpactHub

3. Set Up the Database
Inside the database folder, create an mysql database file with 3 databases:
touch admin_db
touch funding_db
touch mentorship_db

Set up the necessary tables for the application. You can run the provided create_tables.sql script to create the database schema:
mysql herimpacthub.db < create_tables.member

4. Set Up the Web Server
If you’re using XAMPP or WAMP, move the project files to the htdocs (for XAMPP) or www (for WAMP) directory.

Start your web server (Apache) and ensure PHP is running.

5. Run the Website
Once the server is running, open your browser and navigate to:
http://localhost/admin-dashboard.php/
The website should now be live on your local machine!

6. Features Walkthrough
Join Now Page: Users can visit the website and register by filling out a form with their details. This information will be stored in the SQLite database.
Apply for Mentorship: Users can submit an application for mentorship directly through the website.
Apply for Funding: The funding application feature allows users to submit their details and funding needs, which will be saved in the database for review.

Contributing
I’d love for you to contribute to HerImpactHub! If you have ideas for new features or improvements, please feel free to fork the repository, create a new branch, make your changes, and submit a pull request.

License
HerImpactHub is licensed under the MIT License.

Support
If you run into any issues or need help with setting up the project, feel free to open an issue on GitHub or contact me at w.hirwa@alustudent.com .

