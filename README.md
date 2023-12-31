Introduction: This installation guide will walk you through the process of setting up and running internship portal on your localhost using XAMPP. Please follow these steps carefully to ensure a successful installation. 
System Requirements: Before you start, make sure your system meets the following requirements: 
Operating systems: Windows or macOS 
XAMPP installed with Apache version 2.4.52 and PHP version 7.4.28. 
Installation Steps: 
1. Downloading the Project Files: 
Save the downloaded file to your local machine. 
2. Extracting Zip Files: 
Locate the downloaded zip file and extract it to your XAMPP htdocs directory. 
For Windows (MS), this directory is usually located at C:\xampp\htdocs\. 
For macOS, it's typically in /Applications/XAMPP/xamppfiles/htdocs/. 
3. Database Configuration: 
Open your web browser and go to http://localhost/phpmyadmin. 
Create a new database named "internship." 
Select the "internship" database and import the SQL file included in the "internship" folder. 
Modifying Email Configuration (send_email.php) 
To ensure that the email verification functionality works as intended, you must update the email configuration settings in the send_email.php file. This file is responsible for sending verification emails. Follow the steps below to modify the email configuration: 
Open the send_email.php file in your code editor. 
Locate the following section in the code: 
Php 
// Email Configuration 
$mail->isSMTP(); 
$mail->Host = 'smtp.gmail.com'; // Specify your SMTP server 
$mail->SMTPAuth = true; 
$mail->Username = 'your_email@gmail.com'; // SMTP username 
$mail->Password = 'your_password'; // SMTP password 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
$mail->Port = 587; 
  
// Sender and Recipient Information 
$mail->setFrom('your_email@gmail.com', 'Personallocalhost'); // Sender's email and name 
$mail->addAddress($recipientEmail); // Recipient's email 
$mail->addReplyTo('your_email@gmail.com', 'Personallocalhost'); // Reply-to email and name 
Replace 'your_email@gmail.com' with your actual email address that you want to use for sending verification emails. 
Replace 'your_password' with the corresponding email password. 
Save the send_email.php file. 
  
  
GENERATE PASSWORD STEPS: 
  
Sign into Google: Start by signing into your Google Account. 
Access Google Account Settings: 
Click on your profile picture in the upper-right corner. 
Select "Google Account." 
Navigate to Security: 
In the left sidebar, click on "Security." 
Two-Step Verification: 
Under the "Signing into Google" section, find "2-Step Verification" and click on it. 
Follow the prompts to enable two-step verification. This will provide an additional layer of security to your account. 
App Passwords: 
Scroll down to the "App passwords" section and click on "App passwords." 
Generate App Password: 
You'll be prompted to enter your Google account password for security. 
Next, click on the "Select app" dropdown menu to choose the application or service you want to generate an app password for. 
Then, click the "Select device" dropdown menu and choose the device or platform the app password is for. 
Click "Generate" to create the app password. 
Copy the App Password: 
Google will generate a unique app password for the application and device you selected. 
Copy this app password. 
Use the App Password in Your Code: 
In your code where you need to use the password (e.g., PHP code for sending emails), paste the app password you generated into the appropriate field. 
phpCopy code 
$mail->Password = 'your_generated_app_password';  
  
Secure the App Password: 
Treat the app password with the same level of security as your Google account password. Do not share it with others. 
  
  
 Web Server Configuration: 
Ensure that XAMPP is running. Start Apache and MySQL from the XAMPP Control Panel. 
Open your web browser and navigate to http://localhost/internship. 
 Testing the Installation: 
You should now see the internship portal homepage. 
Test the functionality to ensure there are no errors. 
Troubleshooting: If you encounter any issues during installation, please refer to the troubleshooting section in the full installation guide for solutions to common problems. 
Conclusion: Congratulations! You have successfully installed internship portal on your XAMPP localhost, which works on both Windows and macOS. If you have any questions or need further assistance, please don't hesitate to reach out. 
Admin Login Credentials: 

Username: admin 

Password: admin@123 

Candidate Login:  

Username: abc 

Password: 1Zabc@123 

Host Company Login: 

Username: veer 

Password: 1Zveer@123 
