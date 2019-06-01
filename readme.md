## listeractive a.k.a. interactive list - by CRG ( C.R.Games ) <cla.radu@crgames.elementfx.com>
This is an example demonstrating a user interactive ( configurable ) list of elements

> Warning: The code of this example is vulnerable to hacking so it should be used just for testing 
purposes, otherwise it will need some changes.

# License
Please read the license file to know the conditions in which you can use and/or modify this project.

# Using, thus requiring:
Apache 2.4.38+, Mariadb server 10.1.38+, Php 7.3.2+, Bootstrap 4

# Create table (sql):
```
CREATE TABLE users ( 
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(30) NOT NULL, 
	active INT(1) NOT NULL, 
	created TIMESTAMP 
);
```

http://crgames.elementfx.com

http://crgames.elementfx.com/extra

C.R.G. / C.R.S. @ 2019
