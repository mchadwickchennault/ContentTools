# Set up Courseware Database

## Checkout Source Code
* CD to `src` directory
* Run `git clone https://github.com/mchadwickchennault/cwdb.git`

## Import Test Data
* Create the neccessary databases (see [Docker readme](../readme.md))
* Using your favorite database editor, import `cwdb_bizint.sqz` into the `CWDB_BizInt` database
    * e.g. Run `gzip -dc cwdb_bizint.sqz | mysql CWDB_BizInt`
    * If you are using a desktop editor like MySql Workbench, you may need to expand `cwdb_bizint.sqz` first
* Using your favorite database editor, import `cwdb_courseData.sqz` into the `CWDB_CourseData` 

## Copy Constants
* Copy `constants.php` to `src/cwdb/lib/php/CourseData/`

## Create Login
* Using your favorite MySQL editor add a row to the `user` table with the following values:
    * `UserName`: { whatever you want your username to be }
    * `PasswordHash`: { a `sha512` hash of your password }
    * `Permission`: 9
    * `Email`: { an email you would like asscociated to the account ( for password resets ) } 

## You should now be able to log onto CWDB at `http://localhost:8080`


