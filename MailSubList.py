#HiddenGEM Mailing List
#Imports================================================
from datetime import datetime,timedelta, timezone #-- dateime convert timestamp to datetime and back

#Email Verification
import sys
import os
from email.message import EmailMessage
import ssl
import smtplib

#Database Connection
import mysql.connector
import requests
import configparser

import random


#Beautiful Soup
from bs4 import BeautifulSoup
#============================================================
api_key = ' AIzaSyB7DnPPhgFTF2C8dCl6xkYVAQ_B-URwegc'
cx = '70b45a26f8c244c96'
#Fetch articles
def fetch_articles_with_api(api_key, cx, keyword, location='New Jersey', count=10, days_ago=7):
    base_url = 'https://www.googleapis.com/customsearch/v1'

    # Concatenate the keyword and location in the 'q' parameter
    query = f'''{keyword} in {location} after:{(datetime.now() - timedelta(days=days_ago)).strftime("%Y-%m-%d")}'''
    # Calculate the date from which to fetch recent articles


    params = {
        'key': api_key,
        'cx': cx,
        'q': query,
        'sort': 'date:r',  # Sort by date in reverse order
    }

    response = requests.get(base_url, params=params)

    if response.status_code == 200:
        data = response.json()
        items = data.get('items', [])

        articles = []
        for item in items:
            link = item.get('link')
            title = item.get('title')
            snippet = item.get('snippet')
            author = item.get('pagemap', {}).get('metatags', [{}])[0].get('author', '')
            date = item.get('pagemap', {}).get('metatags', [{}])[0].get('article:published_time', '')

            
            articles.append({
                'title': title,
                'link': link,
                'snippet': snippet,
                #'author': author,
                #'date': date
            })


            if len(articles) == count:
                break

        return articles
    else:
        print(f'Error: {response.status_code}, {response.text}')
        return None



#Send email
def send_sub_email(email_receiver, article_links):
    # Email Sender credentials
    email_sender = "hiddengemofficialteam2@gmail.com"
    email_password = 'uxqj cbfb zvln jetk'

    # Subject of the email
    subject = 'Hidden GEM Email Subscriber News!'

    # Body content of the email
    body = f"""
    Welcome to Hidden GEM Email Subscriber News!

    We are glad to have you in our community! Eat, drink, and explore New Jersey!
    Here are some articles we think you might be interested in:

   {''.join([f"{i + 1}. Title: {article['title']}\n   Link: {article['link']}\n   Snippet: {article['snippet']}\n\n" for i, article in enumerate(article_links)])}
    """


    # Email message object
    em = EmailMessage()
    em['From'] = email_sender
    em['To'] = email_receiver
    em['Subject'] = subject
    em.set_content(body)

    # Create SSL context
    context = ssl.create_default_context()

    # Login into Gmail and send the email
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())




#articles1 = fetch_articles_with_api(api_key, cx,'pizza')
#articles2 = fetch_articles_with_api(api_key, cx, 'hiking')

#random1 = random.sample(articles1, 5)
#random2 = random.sample(articles2, 5)

#articles = random1+random2

#print(articles)
#send_sub_email('sanchem1@kean.edu', articles)




#++++++++Database Implementation+++++++++++++++++
#Config parser and import dbconfig.ini
config = configparser.ConfigParser()
config.read('dbconfig.ini')
mydb = mysql.connector.connect(
  host = config.get('database','host'),
   database = config.get('database', 'database'),
   username = config.get('database', 'username'),
   password = config.get('database', 'password')
   )

mycursor = mydb.cursor()
'''uid, fname, lname, username, 
	email, dob, pword, role, hobby, 
	favorite_food, profile_picture, 
	verification_token, is_verified, 
	brandname, mailSub
'''

# Define the SQL query to fetch data
sql = '''
    SELECT email, username, favorite_food, hobby
    FROM hg_users
    WHERE mailSub = 1
'''

mycursor.execute(sql)

# Fetch all the results
results = mycursor.fetchall()

# Process the results and create a list of dictionaries
user_list = []
keywords_set = set()

for result in results:
    email, username, favorite_food, hobby = result
    user_dict = {
        'email': email,
        'username': username,
        'favorite_food': favorite_food,
        'hobby': hobby
    }
    user_list.append(user_dict)

    # Add favorite_food and hobby to the keywords_set
    keywords_set.add(favorite_food)
    keywords_set.add(hobby)

# Remove duplicate keywords
keywords_list = list(keywords_set)

# Print the list of dictionaries and the keywords list
print("List of Users:")
for user in user_list:
    print(user)

print("\nList of Keywords:")
print(keywords_list)

# Dictionary to store articles lists with keywords as keys
articles_dict = {}

# Loop through each unique keyword
for keyword in keywords_list:
    # Call the fetch_articles_with_api function and store the result in the dictionary
    articles_list = fetch_articles_with_api(api_key, cx, keyword)
    #[keyword+'1', keyword+'2', keyword+'3']#
    
    # Link each array to a key named after the keyword
    articles_dict[keyword] = articles_list

# Print or further process the articles_dict
for keyword, articles_list in articles_dict.items():
    print(f"Keyword: {keyword}")
    print("Articles List:", articles_list)



# Process users and send emails
for user in user_list:
    email = user['email']
    favorite_food = user['favorite_food']
    hobby = user['hobby']

    # Get the articles lists for favorite_food and hobby from articles_dict
    favorite_food_articles = articles_dict.get(favorite_food, [])
    hobby_articles = articles_dict.get(hobby, [])

    random_foods = random.sample(favorite_food_articles, 5)
    random_hobby = random.sample(hobby_articles, 5)

    # Combine the two lists into one
    combined_articles = random_foods + random_hobby

    # Send the combined_articles to the user's email
    print(email, combined_articles)
    send_sub_email(email, combined_articles)


# Process Complete: Close connection
mycursor.close()
mydb.close()