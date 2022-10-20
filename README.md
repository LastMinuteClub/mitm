# mitm
## Man in the Middle application demonstration

KIT325 group 4 Cyber Security Project implementation.

## How to install
1. Install XAMPP
2. Clone this repository to `xampp\htdocs` (I'd recommend using Github Desktop)
3. Start up Apache and MySQL services in the XAMPP Control Panel (or manager-osx for macs)
4. In your browser go to `localhost/phpmyadmin`
5. In the left-hand column, click 'New' to create a new database. Name the database 'KIT325' and click create.
6. Navigate to the newly created database from the left-hand column.
7. Select the 'Import' button from the top menu, click 'Choose File', and the select `xampp\htdocs\mitm\notes.sql` (also in this repository).
8. Once that's done the application is set up!

## To use the application
In your browser navigate to `localhost/mitm/homepage.php`

## To intercept HTTP traffic
1. Download and install HTTP Toolkit from [here](https://httptoolkit.com "HTTP Toolkit's Homepage").
2. Launch the application and select 'Chrome' from the intercept tab. It's likely you need Google Chrome installed - but who doesn't?
3. In the new Chrome window that opens navigate to the application.
4. Back in HTTP Toolkit, select the 'Mock' tab and add a new rule.
5. In the 'Match' dropdown menu, select 'POST requests'. In the 'Then' dropdown menu, select 'Pause the request to manually edit it'. Once done, click the 'Save Changes' button at the top of the HTTP Toolkit application.
6. In the Chrome window opened by HTTP Toolkit, save a note. You will see the POST request automatically opened in the 'View' tab within HTTP Toolkit. You can change the message by editing the field in the box labeled 'POST REQUEST'. Once you've edited it, click 'Resume'. 
7. The edited note is saved (depending on the UC it may not be!).

### Notes: 
* New rules added in the 'Mock' tab will automatically be activated once created. To turn off a rule, simply hover over the rule you want to disable and click the switch icon that appears. This is also how you re-enable a rule once it is disabled. 
* After submitting a note, HTTP Toolkit might pickup other HTTP traffic in which case the POST request is no longer selected. Simply look in the 'View' tab to find the most recent POST request in order to resume/edit it.
