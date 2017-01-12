## Navigatio - An online tour guide web application

Navigatio is a web based portal application used to display some of the most popular tourist destinations around the world. 

#### Major features

* Some of the most popular **tourist cities** are listed.


* Various types of attractions (**sight-seeing, restaurants and recreational places**) are listed for these cities.


* Details about these attractions in the form of embedded youtube **videos** and exact geolacation enabled through the use of google **maps** API provide a better user experience for the application user.


* A brief **history** of the city, the various modes of **transportation** avaialble to reach the location and a quick glance of the various **seasons** pertaining to the location are also provided.


* A **responsive** design of the website allows users to access the application from various other devices (other than a desktop/laptop) and see the device optimized view.  

#### Technology Stack

* Application front end is designed using **Bootstrap**, **jQuery**, **AJAX**.


* **PHP** is used for building the backend.


* **Apache HTTP server** used to host the web application.


* **MySQL** is used as the database.


* **Google Maps** and **YouTube** API are used to render maps and videos.


* **Selenium** was used for performing basic functional testing of the website where as **JMeter** was used to test the system performance. 

#### Architecture

The web application was deployed on AWS for better scalability and for a fast infrastructure set up. Shown below is a high level architecture of the infrastructure setup.

![System architecture](https://github.com/vishnu45/Navigatio/blob/master/img/architecture.png)

Here the web server code is hosted on **Amazon EC2** instances which are managed within an Auto Scalling Group. Based on the network tracffic rule setup for scalling, the auto scalling group adds/removes instances. **Amazon Elastic Load Balancer** distributes the traffic over the available instances. **Amazon Route 53** helps the DNS to connect the provided url to the web application exposed out through the load balancer. **Amazon S3** provides a scalable storage infrastructure to store much of the static content such as the very many images used in the application. **Amazon RDS** is used to set up the MySQL database backend of the application. 

#### Responsive Design layouts

![Various responsive layouts](https://github.com/vishnu45/Navigatio/blob/master/img/navigatio.png)