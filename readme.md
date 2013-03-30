PHPMath
=======
PHPMath is a project to run Mathematica® functions throught PHP.

Requirements
============
This project aims *nix systems, but with few adaptions could run on other systems too.

Install
=======
<!---
- Database:
    - Creation:
        - Create a database (for example, phpmath);
        - Create a user (for example, phpmathroot) with permission to manage this 
        database.
    - Configuration:
        - Change the file `config/constant/database.default.php` to 
            `config/constant/database.php`;
        - Edit `config/constant/database.php` with the credentials of the
            created database.
-->
- Mathematica License:
    - Copy your Mathematica® license to the PHP home folder (for example, 
        `/var/www`).
        - The license usually is on a hidden folder inside the licensed user
            home (for example, `/home/user/.Mathematica`).
        - In other words, for this example, the folder `.Mathematica` inside 
            `/home/user` should be copied to `/var/www`.
- Starting:
    - Run the url of your project (for example, `http://localhost/phpmath`).

Troubleshooting
===============
- Be sure the folder `lib/core/Backend/Model/Mathematica/compiled` is writable
    by the PHP user.