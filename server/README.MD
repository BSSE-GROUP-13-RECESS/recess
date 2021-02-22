````
Drop this folder to the home directory -You should be in Ubuntu OS
Dont rename the folder.
Make sure you have php installation, Mysql installation and GNU/GCC (the C/C++ compiler)
Make sure that the Mysql server is running

Open the cron.php file
on line: $servername = "localhost"; [change localhost to the name of your database server if its different]
on line: $username = "root"; [change root to the username you use in Mysql]
on line: $password = "o##e8ii4#?"; [change o##e8ii4#? to the password you use in Mysql] 
Save changes

Open the terminal (Ctrl+alt+T)
    -Type cd server
    -Press Enter
    
Installing server from server.c    
    gcc -o server server.c -lpthread
    Press Enter
Starting the server
    ./server
    Press Enter
You need a client to interact with the server. The client is found in the client directory.
Open the readme.MD file there and read through instructions.

The server writes files in the directory called enrollment_files according to districts as per the session.
To see the changes made / information you supplied, go to directory enrollment_files

When uploading files, use filezilla and submit them to directory submitted_files
The server will only read from submitted files in this directory.

The cron.php file reads the contents of files in directory enrollment files to the database.
The command to do the above is found in cron.txt. A database should first be created.

Create database where data will be inserted.
	-Type in the sql statement in the mysql terminal.
	create database casetool;
	Then navigate into the web application directory =>"Covid_casetool" using terminal and type.
	php artisan migrate

To start cron.php (which is supposed to run every five minutes), follow these steps.
    -Open the terminal by pressing Ctrl+alt+T
    -Type crontab -e
    -Press Enter
    -Navigate to the bottom of page that you have received (push cursor to the bottom).
    -Open cron.txt and copy that line of text into the terminal at the bottom 
    -Press Ctrl+X
    -Press y
    -Press Enter
