# Comp2030_SMD

## Smart Manufacturing Dashboard (SMD)

A dashboard system for monitoring the operation of machines and jobs on the factory floor.

## Table of Contents
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [User PINs](#user-pins)

## Installation

1. **Install XAMPP:**
    - Ensure that [XAMPP](https://www.apachefriends.org/) is installed with Apache, MySQL, PHP, and phpMyAdmin. It is recommended to install XAMPP in the default location (C:/XAMPP).

2. **Clone the repository onto the local machine:**

    -  If not already present, create a new folder `www` in `htdocs` and navigate into it.
    ```bash
    mkdir C:\xampp\htdocs\www
    cd C:\xampp\htdocs\www
    ```
    - Clone the repository.
    ```bash
    git clone https://github.com/SamuelHeal/Comp2030_SMD.git
    ```

3. **Start the local server:**
    - Start the XAMPP Control Panel.
    - Start the Apache and MySQL modules.

## Database Setup

1. **Open phpMyAdmin:**
    - In a web browser (i.e. [Google Chrome](https://www.google.com/chrome/)), enter `http://localhost/phpmyadmin` to access the phpMyAdmin dashboard.

2. **Build the database:**
    - Navigate to the `SQL` tab .
    - Drag and drop the file `\sql\db.sql`, which will insert the SQL script into the window, or copy and paste the contents. 
    - Click `Go` in the bottom right to run the SQL script.

3. **Populate the database:**
    - Make sure the correct database `group18_SMD` is selected and then return to the `SQL` tab.
    - Drag and drop the file `\sql\inserts.sql`, which will insert the SQL script into the window, or copy and paste the contents. As there is a large number of lines for the factory log data insert statements, this may take some time. Attempting to drag and drop the file directly (outside of the `SQL` tab) may cause issues.
    - Click `Go` in the bottom right to run the SQL script.

## Usage

1. **Start the server:**
    - If not already, start the XAMPP control panel and start both the Apache and MySQL modules.

2. **Open the dashboard:**
    - In a web browser, go to `http://localhost/www/Comp2030_SMD/index.php`.

3. **Index.php:**
    - The file index.php allows you to select the environment context you wish to log in to. By entering `0`, you can access the office context (i.e. a desktop PC). By entering a number `1-10` you can access the factory floor context (i.e. touchscreen tablets associated with a machine).

4. **Login:**
    - You will be redirected to `/pages/login.php` or `/pages/login-desktop.php`. Here you can enter the PIN (listed [below](#user-pins)) of the user you wish to log in as. Upon successful login you will be redirected to the appropraite landing page.

## User PINs

### Administrator
| Name                 | PIN      |
|----------------------|----------|
| Richard Moore        | 2323     |

### Auditor
| Name                 | PIN      |
|----------------------|----------|
| Jack Dennis          | 1839     |

### Factory Manager
| Name                 | PIN      |
|----------------------|----------|
| Frank Colson         | 4545     |

### Production Operator
| Name                 | PIN      |
|----------------------|----------|
| Robert McKenna       | 9900     |
| Brian Moser          | 1224     |
| Timothy Newman       | 5651     |
