#Michael Sanchez
#Email Verification
import sys
import os
from email.message import EmailMessage
import ssl
import smtplib

#Email Sender our account and password for it
email_sender = "hiddengemofficialteam@gmail.com"
email_password = 'hgeh imjw bthk tmyw '
#Email receiver this will need to be an input
email_receiver = sys.argv[1]
#verify_link = "https://localhost/HiddenGEM/verify.php?token="+sys.argv[2]
verify_link ="https://hiddengem.azurewebsites.net/verify.php?token="+sys.argv[2]
#verify_link = "https://obi.kean.edu/~sanchem1/GameSolaris/verify.php?token="+sys.argv[2]
#verify_link= "https://localhost/GameSolaris/verify.php?token="+verify_token

#subject of the email
subject = 'Hidden GEM Verification Email'

#Body content of the email
body= f"""
Welcome to Hidden GEM!
We are glad to have you join our community! Eat, drink, and explore New Jersey! Verfiy your account today!
Please click the link below to verify your account: 
{verify_link}
"""

#email message object
em = EmailMessage()
em['From'] = email_sender
em['To'] = email_receiver
em['Subject'] = subject
em.set_content(body)

context = ssl.create_default_context()

#login into the gmail and then send email
with smtplib.SMTP_SSL('smtp.gmail.com',465, context = context) as smtp:
	smtp.login(email_sender, email_password)
	smtp.sendmail(email_sender, email_receiver, em.as_string())