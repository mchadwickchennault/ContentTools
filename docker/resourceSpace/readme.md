# ResourceSpace Setup
## Checkout the ResouceSpace code
* CD to the `src` directory
* run `svn co http://svn.resourcespace.com/svn/rs/releases/8.2 ./`
## Run installation
* Start the Docker containers (see [Docker readme](../readme.md))
* Navigate to <http://localhost:8888>
* Set `MySQL server` to `ct_mysql`
* Set `MySQL username` to `root`
* Set `MySQL database` to `ResourceSpace`
* Fill out the Admin info in `General Settings`
* Set `Email from address` to `resourcespace@alchemysystems.com`
* Leave the rest as default values
* After you run the installation, add the following to `/src/include/config.php`
    ```
    # Base URL of the installation
    $baseurl = 'http://localhost:8888';
    ```
## You should now be able to log into ResourceSpace at `http://localhost:888`
## Set up meatadata
* Login as admin
* Got to Admin->System->Manage metadata fields
* Enter 'Keywords' into the 'Create meatadata field called...' field
* Click 'Create'
* Check 'Index this field'
* Enter 'keywords' in 'Exiftool field'
* Click `Save` at the bottom of the page